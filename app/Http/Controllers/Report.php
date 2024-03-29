<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ReportTrait;


class Report extends Controller
{
   use ReportTrait; 
 	public $title = 'Report';

    function index(){
        $data['title'] = $this->title;
    	$data['branches'] = $this->getBranches();
        $data['items'] = $this->getItems();
        $data['paymenttypes'] = $this->getPymentType();
    	return view('admin.report.index', $data);
    }

    function corporateSale(Request $request){
    	//print_r($request->all());
    	//die();
        $data['config'] = $this->getConfig();  
        $multiple = floatval($data['config']->corporate_multiply);


    	$validatedData = $request->validate([ 
            'fromDate' =>'required',
            'toDate' =>'required',
            'branch'=>'required'
            ]);
    	$from = $request->fromDate;
    	$to = $request->toDate;    	 
        $branch = $this->getBranchById($request->branch);
        $branch_name = $branch? $branch->title : '';
        $data['from_to'] = $request->fromDate.' / '.$request->toDate.' / '.$branch_name;   
        $result = [];	
    	$sales = $this->getSaleCorporate($request->branch,$request->fromDate,$request->toDate); 
        
        if(count($sales)){
            foreach($sales as $sale){
                $profit = 0;
                foreach($sale->saleitems as $item){
                    $item_profit = floatval($item->unit_price) - floatval($item->cost_price);
                   
                    $profit += $item_profit * $multiple;
                }

                $date = date('d-m-y', strtotime($sale->created_at));
                $subtotal = floatval($sale->subtotal) * $multiple;
                $tax = floatval($sale->total_tax) * $multiple;
                $total = $subtotal +  $tax ;

                if(isset($result[$date])){
                    $result[$date]['subtotal'] +=  $subtotal;
                    $result[$date]['tax'] +=    $tax ;
                    $result[$date]['total'] +=   $total;
                    $result[$date]['profit'] +=   $profit;
                }else{
                    $result[$date] = ['subtotal' => $subtotal, 'tax'=>  $tax ,'total' =>  $total ,'profit'=> $profit];
                }
            }
        }
        
       

        $data['sales'] = $result;
      
    	return view('admin.report.sale.corporate', $data);
    }
    
    function saleDetails(Request $request){
    	//print_r($request->all());
    	//die();
    	$validatedData = $request->validate([ 
            'fromDate' =>'required',
            'toDate' =>'required',
            'branch'=>'required'
            ]);
    	$from = $request->fromDate;
    	$to = $request->toDate;
    	$data['from_to'] = $request->fromDate.' / '.$request->toDate;    	
    	$data['sales'] = $this->getDetailsSale($request->branch,$request->fromDate,$request->toDate); 
    	$data['summary'] = $this->getSummaryOfDetails($request->branch,$request->fromDate,$request->toDate);
        $data['config'] = $this->getConfig();  
    	return view('admin.report.sale.details', $data);
    }

    function saleSummary(Request $request){
    	$validatedData = $request->validate([ 
            'fromDate' =>'required',
            'toDate' =>'required'
            ]);
    	$from = $request->fromDate;
    	$to = $request->toDate;
    	$data['from_to'] = $from.' / '.$to;    	
    	$data['sales'] = $this->getSummarySale($request->branch,$from,$to);
        $data['config'] = $this->getConfig();      	
    	return view('admin.report.sale.summary', $data);
		
	}

    function todaySale(){
    	$date = Date('Y-m-d');
    	$data['from_to'] = $date.' / '.$date;    	
    	$data['sales'] = $this->getSummarySale('',$date,$date);
        $data['config'] = $this->getConfig();  
    	return view('admin.report.sale.summary', $data);
    }

    function distributeToday(){        
        $date = Date('Y-m-d');
        $data['from_to'] = $date.' / '.$date;
        $data['from_to_branch'] = '';       
        $data['transfers'] = $this->getTransfers($date,$date);
        
        $branches = $this->getBranchesRows();
        $qty = 0;
        $total = 0;        
        foreach($data['transfers'] as $key=>$val){

            foreach($branches as $branch){
                if($val->from_branch == $branch->id){
                    $data['transfers'][$key]->from_branch = $branch->name;
                }
                if($val->to_branch == $branch->id){
                    $data['transfers'][$key]->to_branch = $branch->name;
                }
            }
             $qty += intval($val->qty);
            $total += intval($val->qty) * floatval($val->unit_price);
        }
        $data['totQty'] = $qty;
        $data['totTotal'] = $total;
        $data['config'] = $this->getConfig();        
        return view('admin.report.transfer.details', $data);
    } 

    function distributeHistory(Request $request){ 
        $validatedData = $request->validate([ 
            'fromDate' =>'required',
            'toDate' =>'required',
            'frombranch'=>'required',
            'tobranch'=>'required'
            ]);
        $from = Date('Y-m-d', strtotime($request->fromDate));
        $to = Date('Y-m-d', strtotime($request->toDate));

        $data['from_to'] = $from.' / '.$to;
        $fromBranch = $request->frombranch;
        $toBranch = $request->tobranch;
        
            
        $data['transfers'] = $this->getTransfers($from,$to,$fromBranch,$toBranch);
       
        $branches = $this->getBranchesRows();
        foreach($branches as $branch){
                if($fromBranch == $branch->id){ $fromBranch = $branch->name;}
                if($toBranch == $branch->id){ $toBranch = $branch->name; }
        }         
        $data['from_to_branch'] = $fromBranch.' -->  '.$toBranch; 
        $qty = 0;
        $total = 0;      
        foreach($data['transfers'] as $key=>$val){
            $data['transfers'][$key]->from_branch = $fromBranch;
            $data['transfers'][$key]->to_branch = $toBranch;
            $qty += intval($val->qty);
            $total += intval($val->qty) * floatval($val->unit_price);
        }
        $data['totQty'] = $qty;
        $data['totTotal'] = $total;
        $data['config'] = $this->getConfig();
      
        return view('admin.report.transfer.details', $data);
    } 

    function presentInventory(Request $request){
        
        $vdata = $request->validate([ 
            'branch' =>'required',
            'item' =>'required'
            ]);
        $data['inventories'] = $this->getCurrentInventory($vdata['branch'],$vdata['item']);
        $data['summary'] = $this->getCurrentSummary($vdata['branch'],$vdata['item']);
        $data['config'] = $this->getConfig();

        return view('admin.report.inventory.details',$data);
    }

    function todayInventory(Request $request){
        $vdata = $request->validate([ 
            'branch' =>'required'
            ]);
        $to = Date('Y-m-d').' 23:59:59';
        $from = Date('Y-m-d').' 00:00:01';    
        $data['inventories'] = $this->getInventory($from, $to, $vdata['branch']);
        $data['summary'] = $this->getSummary($from, $to, $vdata['branch']);
        $data['config'] = $this->getConfig();

        return view('admin.report.inventory.details',$data);
    }

    function itemStatus(Request $request){
        $vdata = $request->validate([ 
            'sku' =>'required'
            ]);
        $data['number'] = $vdata['sku']; 
        $data['sales'] = $this->getItemSale($vdata['sku']);;
        $data['inventory'] = $this->getItemInventory($vdata['sku']);
        $transfers = $this->getItemTransfers($vdata['sku']);
        $distribution=[];
        $branches = $this->getBranchesRows();
        foreach($transfers as $key => $trans){
            $distribution[] =[ 'date' => $trans->created_at,
                            'sku' =>$trans->sku,
                            'qty'=>$trans->qty,
                            'from' => $this->getBranchName($branches, $trans->from_branch),
                            'to' =>  $this->getBranchName($branches, $trans->to_branch)];
        }
        $data['distribution'] = $distribution;
        $data['tracks'] = $this->getItemTracks($vdata['sku']);

        return view('admin.report.item_status', $data);    
    }

    function todayVat(){
        $date = Date('Y-m-d');
        $data['vats'] = $this->getSummaryVat('', $date, $date);
        $data['from_to'] = $date.' / '.$date;
        $data['config'] = $this->getConfig();  
    	return view('admin.report.vat.summary', $data);
    }

    function vatDetails(Request $request){
        $validatedData = $request->validate([ 
            'fromDate' =>'required',
            'toDate' =>'required'
            ]);
    	$from = $request->fromDate;
    	$to = $request->toDate;
    	$data['from_to'] = $from.' / '.$to;    	
    	$data['vats'] = $this->getSummaryVat($request->branch,$from,$to);
        $data['config'] = $this->getConfig();      	
    	return view('admin.report.vat.summary', $data);
    }

    function todayPayment(){
        $data['from_to'] = 'Today';         
    	$data['payments'] = $this->getSalesPayment();
        $data['config'] = $this->getConfig();      	
    	return view('admin.report.payment.today', $data);
    }

    function historyPayment(Request $request){
        $validatedData = $request->validate([ 
            'fromDate' =>'required',
            'toDate' =>'required'
            ]);
    	$from = $request->fromDate;
    	$to = $request->toDate;
        $branch = $request->branch;
        $type = $request->type;
    	$data['from_to'] = $from.' / '.$to;         
    	$data['payments'] = $this->getPaymentHistory($from, $to, $branch, $type);
        $data['config'] = $this->getConfig();      	
    	return view('admin.report.payment.summary', $data);

    }

    function todayExpense(){
        $date = Date('Y-m-d');
        $data['expenses'] = $this->getEspenses('', $date, $date);
        $data['from_to'] = $date.' / '.$date;
        $data['config'] = $this->getConfig();
        $data['history'] = false;   
    	return view('admin.report.expense.summary', $data);
    }

    function expenseDetails(Request $request){
        $validatedData = $request->validate([ 
            'fromDate' =>'required',
            'toDate' =>'required',
            'branch' =>'required'
            ]);
    	$from = $request->fromDate;
    	$to = $request->toDate;
    	$data['from_to'] = $from.' / '.$to;  
            	
    	$data['expenses'] = $this->getEspenses($request->branch, $from, $to);
        $data['config'] = $this->getConfig();
        $data['history'] = true;  
        	
    	return view('admin.report.expense.history', $data);


    }

    function todayProfit(){
        $date = Date('Y-m-d');
        $profits = $this->getSummaryProfit();
        $data['profits'] = [];

        $branches = $this->getBranches();

        if($profits){
            foreach($profits as $key=>$val){
                        $profit = floatval($val->unit) - floatval($val->cost);

                    foreach($branches as $branch){
                        if($val->id == $branch->id){
                            if(isset($data['profits'][$branch->id])){
                                $data['profits'][$branch->id]['profit'] =  $profit + $data['profits'][$branch->id]['profit'];
                            }else{
                                $data['profits'][$branch->id] = ['profit' => $profit, 'branch'=> $branch->title];
                            }
                        }
                    }                   
                }
        }

       

        $data['from_to'] = $date.' / '.$date;
        $data['config'] = $this->getConfig();  
    	return view('admin.report.profit.summary', $data);
    }

    function profitDetails(Request $request){
        $validatedData = $request->validate([ 
            'fromDate' =>'required',
            'toDate' =>'required',
            'branch'=>'required'
            ]);
    	$from = $request->fromDate;
    	$to = $request->toDate;
    	$data['from_to'] = $from.' / '.$to;    	
    	$profits = $this->getProfit($request->branch,$from,$to);
       
        $data['profits'] = [];
        $offBranch = '';
        if(count($profits)){
            foreach($profits as $key=>$val){
                $unit = floatval($val->unit);
                $cost = floatval($val->cost);
                $profit =  $unit - $cost; 
                $date = date('d-m-y', strtotime($val->created_at));
                    
                
                if(isset($data['profits'][$date])){
                    $data['profits'][$date]['profit'] +=  $profit;
                    $data['profits'][$date]['cost'] +=  $cost;
                    $data['profits'][$date]['unit'] +=  $unit;
                }else{
                    $data['profits'][$date] = ['profit' => $profit, 'cost'=> $cost, 'unit'=> $unit, 'branch'=> $val->title];
                    $offBranch = '';
                }

                if(!$offBranch){
                    $offBranch = $val->title;
                }
                        
                                     
            }
        }


        $data['from_to'] .= ' / '. $offBranch;
        $data['config'] = $this->getConfig();      	
    	return view('admin.report.profit.history', $data);
    }


    //end
}
?>