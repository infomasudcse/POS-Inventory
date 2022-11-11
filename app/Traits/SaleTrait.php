<?php

namespace App\Traits;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Salepayments;

use App\Models\Inventory;

use App\Models\Customer;

use Cart;

trait SaleTrait {
  

    public function getBranchInfo($id){

         $branch = DB::table('branches')->find($id);            

        return $branch;

    }

    public function getPaymentType(){
        return DB::table('paymenttypes')->get();
    }

    public function getSalePayments($sale_id){
        return DB::table('salepayments')->where('sale_id', $sale_id)->join('paymenttypes', 'salepayments.payment_type', '=', 'paymenttypes.id')->get();
    }


    public function getConfig(){

        $config = DB::table('configs')->first();

        return $config;

    }

    public function deleteSaleInfo(){

         Cart::destroy();

        //empty payments               

        session()->forget('payment');

        session()->forget('discount');

        session()->forget('customer');

    }

    public function cancelSale(){

        $this->deleteSaleInfo();

        return redirect('/sales');

    }



    public function removeFromCart($rowId){

        Cart::remove($rowId);

        return redirect('/sales');

    }

    public function updateQtyToCart(Request $request){
        $data = $request->validate([
            'qty' => 'required|max:9|min:0',
            'rowid'=> 'required'
        ]);
        
        Cart::update($data['rowid'], $data['qty']);

        return redirect('/sales');

    }





    public function deletePayment(Request $request){

    	$request->session()->forget('payment');

    	return redirect('/sales');

    }



    public function getInventory($sku, $branch){

    	 $inventroy = DB::table('inventories')
            ->where('sku', $sku)
            ->where('branch_id', $branch)
            ->where('qty','>',0)
            ->where('deleted', 0)
            ->get()->first();

            return $inventroy; 

    }

    public function getInventoryAnyBranch($sku){

         $inventroy = Inventory::with('branch')
            ->where('sku', $sku)
            ->where('qty','>',0)
            ->where('deleted', 0)
            ->get();

            return $inventroy; 

    }

    public function getItem($id){

    	$item = DB::table('items')
            ->where('items.id', $id)
            ->select('items.name')
            ->get()->first();

            return $item; 

    }



    public function addPayment(Request $request) {        

        //use session

        $validatedData = $request->validate([          

            'amount' => 'required|min:0|numeric',

            'payment_type' => 'required'

        ]);     

        $payment = ['payment_type'=>$validatedData['payment_type'],'amount'=>$validatedData['amount']];

        $request->session()->push('payment', $payment);

        return redirect('/sales');

    }



    public function addDiscount(Request $request){

         //use session

        $validatedData = $request->validate([          

            'amount' => 'required|min:0|numeric',

            'discount_type' => 'required'

        ]);     

        $discount = ['type'=>$validatedData['discount_type'],'amount'=>$validatedData['amount']];

        $request->session()->put('discount', $discount);       

        return redirect('/sales');

    }



    public function savePayments($saleId){

        $payments = session('payment');

         if($payments){

            foreach($payments as $paid){

                    $salePayment = new Salepayments;

                    $salePayment->sale_id = $saleId;

                    $salePayment->payment_type = $paid['payment_type'] ;

                    $salePayment->amount = $paid['amount'] ;

                    $salePayment->save();

            }

        }

    }



    

    public function getTotalPayment(){

    	 $payments = session('payment');

    	 $totalPaid = 0.00;

    	 if($payments){

    	 	foreach($payments as $paid){

    	 		$totalPaid += floatval($paid['amount']);

    	 	}

    	 }

    	 return $totalPaid;

    }





    public function getDue(){

         $due = $this->getCartTotal() - $this->getTotalPayment();

         return $due;

    }

    public function setCartTax($rowId){
        $taxCode = $this->getConfig()->default_tax;
        Cart::setTax($rowId, $taxCode);

    }

    public function addItemToCart($sku,$name,$qty,$price,$weight,$optionId,$mode,$stock){

        $cart = Cart::add($sku, $name, $qty, $price, $weight, ['inv_id' => $optionId, 'mode' => $mode,'stock'=>$stock]);

        return $cart;

    }





    public function getTotalDiscount(){

        $amount = 0.00;

        $disq = session('discount');

        if($disq){

           $value = floatval($disq['amount']);

            if($disq['type']=='percent'){

                $amount = ($this->getCartSubtotal() * $value) /100;

            }else{

                $amount = $value;

            }

        }

        return $amount;

    }



    public function getCartSubtotal(){

       $cartContent = $this->getCartContent();

         $subtotal =0.00;

         if($cartContent){

             foreach($cartContent as $cart){

                $subtotal +=  $cart->qty * $cart->price;

            }

        }

        return floatval($subtotal); 

    }



    public function getCartTotal(){

        $total = 0.00;

        $subtot = $this->getCartSubtotal();

        $tax = $this->getCartTax();

        $disq = $this->getTotalDiscount();

        $total = $subtot+$tax-$disq;

        return $total;

    }



    public function getCartContent(){

        return Cart::content();

    }

    public function getCartCount(){

        $cartContent = $this->getCartContent();

         $count =0.00;

         if($cartContent){

             foreach($cartContent as $cart){

                $count +=  abs($cart->qty);
            }
        }

        return $count;

    }

    public function getCartTax(){

        $saleTax = 0.00;

        $returnTax = 0.00;

        $sale_tot = 0;

        $return_tot = 0;

        $cartContent = $this->getCartContent();

        foreach($cartContent as $cart){

            if($cart->qty > 0 && $cart->options->mode =='sale'){ //sale
                $sale_tot += $cart->price * $cart->qty; 
                //$item_tax = $this->getItemTax($cart->price);

                //$saleTax += $cart->qty * $item_tax ;  

            }else if($cart->qty < 0 && $cart->options->mode =='return'){ //return
                $return_tot += $cart->price * abs($cart->qty);
               // $item_tax = $this->getItemTax($cart->price);

               // $returnTax += abs($cart->qty) * $item_tax ;

             }

        }
        $disq = $this->getTotalDiscount();
        $sale_tot = $sale_tot - $disq;
        $saleTax  = $this->getItemTax($sale_tot);

        $returnTax = $this->getItemTax($return_tot);
        //var_dump($saleTax);

       // var_dump($returnTax);

        $tax = $saleTax - $returnTax; 

        return $tax; 

    }

    public function getItemTax($price){
        $rate = $this->getConfig()->default_tax;
        $amount = ($price * $rate) / 100 ;

        return $amount;

    }

    public function addCustomer(Request $request){
        //use session
        $customer_id =  $request->input('customer_id');
        if($customer_id){

            $customer = Customer::where('id', $customer_id)->get()->first();
            $new_customer = ['id'=>$customer->id,'name'=>$customer->name, 'mobile'=>$customer->mobile];

        }else{
            $validatedData = $request->validate([ 
                'name' => 'required|min:3',
                'mobile' => 'required|min:10|unique:customers'
            ]);       
     
            $customer = Customer::create([
                         'name' => $validatedData['name'],
                         'mobile' =>  $validatedData['mobile'],
                         'branch_id' => Auth()->user()->branch_id,
                     ]);
            $new_customer = ['id'=>$customer['id'],'name'=>$customer['name'], 'mobile'=>$customer['mobile']];
        }
       
       
       
        $request->session()->put('customer', $new_customer);       

        return redirect('/sales');

    }

    public function getSaleCustomer(){

        $return = [];
        $customer = session('customer');
        if($customer){
           $return = $customer;
        }

        return $return;
    }

    public function removeCustomer(){
        session()->forget('customer');

    	return redirect('/sales');
    }





//end of file 

}