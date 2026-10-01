<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\SaleTrait;
use App\Models\Sale;
use App\Models\Saleitems;
use App\Models\Inventory;
use App\Traits\InventoryTrait;
use App\Helper\Helper;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller {

	use SaleTrait;
	use InventoryTrait;

	public $title = 'Sale';

	function index() {
		$data['branchInfo'] = $this->getBranchInfo(Auth()->user()->branch_id);
		$data['total'] = $this->getCartTotal();
		$data['subtotal'] = $this->getCartSubtotal();
		$data['counts'] = $this->getCartCount();
		$data['cartContent'] = $this->getCartContent();
		$data['tax'] = $this->getCartTax();
		$data['discount'] = $this->getTotalDiscount();
		$data['payment'] = $this->getTotalPayment();
		$data['due'] = $this->getDue();
		$data['customer'] = $this->getSaleCustomer();
		$data['salesman'] = $this->getSalesman();
		$data['paymentType'] = $this->getPaymentType();

		return view('branch.index',$data);
	}

	function addToCart(Request $request) {
		//validate
		$validatedData = $request->validate([
				'sku' => 'required|numeric',
				'mode' => 'required'
		]);
		//set variable
		$qty = 0;
		$status='';
		//get mode and set variable
		$mode = $validatedData['mode'];
		switch ($mode) {
				case 'sale':
					$qty = 1; $mode = 'sale'; break;
				case 'return':
					$qty = -1; $mode = 'return'; break;
				default:
					$qty = 0;
		}
		//quantity not set can not sale
		if ($qty === 0) {
				$status .= ' Sale or return ??';
		} else {
				//get logged branch
				$branchId = auth()->user()->branch_id;
				//search inventory
				// Need to look for item anywhere event qty - 0 for return , if found add to cart for return
				if ($qty < 0) {
						// return I guesss so just check if did exists this sku regardless branch
						$itemInventory = $this->checkInventory($validatedData['sku']);
				}else {
						$itemInventory = $this->getInventory($validatedData['sku'], $branchId);
				}

				if (!$itemInventory) {
						//item not found in this branch
						$status = ' Item Not Found in this branch. ';
						//search inventory to other branch
						$anyBranchInventory = $this->getInventoryAnyBranch($validatedData['sku']);
						if ( count($anyBranchInventory) > 0 ) {
								foreach ($anyBranchInventory as $otherBranchInventory) {
										$status .='Found '.$otherBranchInventory->qty.'pcs in '.$otherBranchInventory->branch->title.', ';
								}
						} else {
								$status .= 'Not found any of branch or unable to sale ! ';
						}
				} else {
						//item found in this branch
						$item = $this->getItem($itemInventory->item_id);
						//add to cart
						$cart = $this->addItemToCart($itemInventory->sku, $item->name, $qty, $itemInventory->unit_price, 0, $itemInventory->id, $mode, $itemInventory->qty);
						// $sku,$name,$qty,$price,$weight,$optionId,$mode,$stock
						//$this->setCartTax($cart->rowId);
				}
		}

		return redirect('/sales')->with('status', $status);
	}


	function doSale(Request $request) {

		$cartTotal = $this->getCartTotal();
		$hasReturnItem = $this->isThisSaleHasOneReturn();
		$cartCount = $this->getCartCount();
		$cartTotPayment =  $this->getTotalPayment();
		$changeAmount  = $cartTotal - $cartTotPayment;

		if (!$hasReturnItem && $cartTotal == 0) {
			return redirect('/sales/index')->with('status', 'Check Total to Pay !');
		}

		$data['cartContent'] = $this->getCartContent();
		$data['salesman'] = $this->getSalesman();
		$data['customer'] = $this->getSaleCustomer();
		$data['manager'] = auth()->user()->name;
		$cartTax = $this->getCartTax();
		$saleData = [
			'total_item' =>  $cartCount,
			'subtotal' => $this->getCartSubtotal(),
			'total_sale' => $cartTotal,
			'totalWTax' =>$cartTotal + $cartTax,
			'changeamount'=> $changeAmount,
			'total_payment' => $cartTotPayment,
			'total_tax'=> $cartTax,
			'total_discount' => $this->getTotalDiscount(),
			'discount_code' => session('discount') ? session('discount')['discount_code'] : 0,
			'user_id' =>  auth()->user()->id,
			'branch_id' =>  auth()->user()->branch_id,
			'customer_id' => $data['customer']? $data['customer']['id'] : 0,
			'salesman_id' => $data['salesman']? $data['salesman']['id'] : 0,
		];

		DB::transaction(function () use (&$data, $saleData) {
			//save sale and get instance
			$data['sale'] = Sale::create($saleData);

			foreach ($data['cartContent'] as $cartItem) {
				$inventory =  Inventory::find($cartItem->options->inv_id);
				$saleitem = new Saleitems;
				$saleitem->sale_id = $data['sale']->id;
				$saleitem->inventory_id = $inventory->id;
				$saleitem->item_id = $inventory->item_id;
				$saleitem->sku = $cartItem->id;
				$saleitem->qty = $cartItem->qty;
				$saleitem->cost_price = $inventory->cost_price;
				$saleitem->unit_price = $cartItem->price;
				$saleitem->tax_code =  $this->getConfig()->default_tax; //$cartItem->taxRate;
				$saleitem->tax_amount =$this->getItemTax($cartItem->price);
				$saleitem->save();
				$mode = $cartItem->options->mode;
				if ($mode == 'sale' && $cartItem->qty > 0) {
					$remain_qty =   intval($inventory->qty) -  intval($cartItem->qty);
					//update inventory for sale
					$inventory->qty = $remain_qty ;
					$inventory->save();
				} else if ($mode == 'return' && $cartItem->qty < 0) {
					//update qty for return
					$new_qty =   intval($inventory->qty) + ( -1 * intval($cartItem->qty));
					$inventory->qty = $new_qty ;
					$inventory->save();
				}

				//in all case Track Entry
				$tracQty = -1 * $cartItem->qty;
				$viewSaleId = Helper::viewSaleId($data['sale']->id);
				$this->SaveTrackInventory($inventory->id, $inventory->item_id, $data['sale']->user_id, $data['sale']->branch_id, $cartItem->id, $tracQty, $viewSaleId);
			}
			//save payments
			$this->savePayments($data['sale']->id);
		});

		//create receipt
		$data['discount_info'] = session('discount');
		$data['branchinfo'] = $this->getBranchInfo($data['sale']->branch_id);
		$data['config'] = $this->getConfig();
		$data['title'] = $this->title;

		//send sms
		if (SmsController::mode_live) {
				SmsController::sendSaleReceipt($cartTotPayment, $data['customer'], $data['config']->business_name);
		}
		//remove sales info
		$this->deleteSaleInfo();
		$data['payments'] = $this->getSalePayments($data['sale']->id);

		return view('branch.receipt',$data);
	}
//end
}
