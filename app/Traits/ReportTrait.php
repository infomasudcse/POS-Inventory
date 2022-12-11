<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

use App\Models\Sale;

use App\Models\Branch;

use Carbon\Carbon;

trait ReportTrait{

	function getItems(){
		$items = DB::table('items')->get();
		return $items;
	}

	function getSystemStatus(){
		$status = DB::table('systemstatus')->first();
		return $status;
	}

	function getPymentType(){
		return DB::table('paymenttypes')->get();
	}

	function getBranches(){

		$branches =  Branch::all();

		return $branches;
	}

	function getBranchById($id){
		return Branch::where('id', $id)->get()->first();
	}

	function getConfig(){
		return DB::table('configs')->first();
	}

	function getBranchesRows(){

		$branches =  DB::table('branches')->get();

		return $branches;

	}

	function getBranchName($allBranch, $id){
		$return = '';
		foreach($allBranch as $branch){
			if($branch->id == $id){
				$return = $branch->title;
				continue;
			}
		}

		return $return;
	}

	function getSaleCorporate($branch,$from,$to){

		$to = $to.' 23:59:59';

		$from = $from.' 00:00:01';

		// $sale = DB::table('sales')
		// 		->select('subtotal', 'total_tax', 'created_at' )            	

        //      	->where('created_at', '>',$from)

        //      	->where('created_at', '<',$to)

        //      	->where('branch_id',$branch)          	

        //      	->get();  
				

		$sale = Sale::with('saleitems')            	

             	->where('sales.created_at', '>',$from)

             	->where('sales.created_at', '<',$to)

             	->where('sales.branch_id',$branch)             	

             	->get();   

		return $sale;	        	

	}

	function getDetailsSale($branch,$from,$to){

		$to = $to.' 23:59:59';

		$from = $from.' 00:00:01';

		$sale = Sale::with('saleitems')            	

             	->where('sales.created_at', '>',$from)

             	->where('sales.created_at', '<',$to)

             	->where('sales.branch_id',$branch)             	

             	->get();        

		return $sale;	        	

	}

	function getSummaryOfDetails($branch,$from,$to){

		$to = $to.' 23:59:59';

		$from = $from.' 00:00:01';

		$sale = DB::table('sales')					

             	->select(DB::raw('sum(subtotal) as subtotal,sum(total_sale) as totals, sum(total_item) as items, sum(total_tax) as taxs, sum(total_discount) as discounts'))

             	->where('created_at', '>',$from)

             	->where('created_at', '<',$to)

             	->where('branch_id',$branch)->get();

        return $sale;
	}

	function getSummarySale($branch='',$from='',$to=''){

		$to = $to.' 23:59:59';

		$from = $from.' 00:00:01';

		if($branch ==''){

			$sale = DB::table('sales')					

             	->select('branch_id',DB::raw('sum(total_sale) as total'))

             	->where('created_at', '>',$from)

             	->where('created_at', '<',$to)

             	->groupBy('branch_id');

            $data = DB::table('branches')

			    ->joinSub($sale, 'sales', function ($join) {

			            $join->on('branches.id', '=', 'sales.branch_id');

			    })->get(); 

		}else{

			$sale = DB::table('sales')					

             	->select('branch_id',DB::raw('sum(total_sale) as total'))

             	->where('created_at', '>',$from)

             	->where('created_at', '<',$to)

             	->where('branch_id',$branch)

             	->groupBy('branch_id');

            $data = DB::table('branches')

			    ->joinSub($sale, 'sales', function ($join) {

			            $join->on('branches.id', '=', 'sales.branch_id');

			    })->get();
		}
		//dd($data);
        return $data;	   

	}

	function getMonthSale($branch_id=''){

		 
		$month = Carbon::now()->month;

		if($branch_id){
			$sales = DB::table('sales')
             ->select(DB::raw('sum(total_sale) as total'))
             ->whereMonth('created_at', $month)
			 ->where('branch_id', $branch_id)
			 ->groupBy('created_at')
             ->get();
		}else{
			$sales = DB::table('sales')
             ->select('total_sale as total', 'created_at')
			 ->whereMonth('created_at', $month)
			 
             ->get();
		}

       return $sales;

	}


	function getSale($date='', $branch_id=''){

		$tot = 0.00;

		if($date=='')$date= Carbon::today();		

		if($branch_id){
			$sale = DB::table('sales')
             ->select(DB::raw('sum(total_sale) as total'))
             ->whereDate('created_at', $date)
			 ->where('branch_id', $branch_id)
             ->get()->first();
		}else{
			$sale = DB::table('sales')
             ->select(DB::raw('sum(total_sale) as total'))
             ->whereDate('created_at', $date)
             ->get()->first();
		}

        $tot +=$sale->total;      

		return $tot;

	}

	function getTax($date='', $branch_id=''){

		$tot = 0.00;

		if($date=='')$date= Carbon::today();		

		if($branch_id){
			$tax = DB::table('sales')
             ->select(DB::raw('sum(total_tax) as total'))
             ->whereDate('created_at', $date)
			 ->where('branch_id', $branch_id)
             ->get()->first();
		}else{
			$tax = DB::table('sales')
             ->select(DB::raw('sum(total_tax) as total'))
             ->whereDate('created_at', $date)
             ->get()->first();
		}

        $tot +=$tax->total;      

		return $tot;

	}



	function getAttendence(){

		$tot = 0.00;

		return $tot;

	}

	function getExpense(){

		$tot = 0.00;

		return $tot;

	}

	function getTransfers($from,$to,$fromBranch='',$toBranch=''){
		$to = $to.' 23:59:59';
		$from = $from.' 00:00:01';
		if($fromBranch !='' && $toBranch !=''){
			$transfer = DB::table('transfers')
				->join('inventories','transfers.sku','=','inventories.sku')
             	->select('transfers.created_at','transfers.sku','transfers.from_branch','transfers.to_branch','transfers.qty','inventories.unit_price')	
				->where('transfers.created_at', '>',$from)
             	->where('transfers.created_at', '<',$to)
             	->where('transfers.from_branch', $fromBranch)
             	->where('transfers.to_branch', $toBranch)
            	->groupBy('transfers.created_at','transfers.qty','transfers.sku','transfers.from_branch','transfers.to_branch','inventories.unit_price')				
				->get();
		}else{
			$transfer = DB::table('transfers')
				->join('inventories','transfers.sku','=','inventories.sku')
             	->select('transfers.created_at','transfers.sku','transfers.from_branch','transfers.to_branch','transfers.qty','inventories.unit_price')
				->where('transfers.created_at', '>',$from)
             	->where('transfers.created_at', '<',$to)				
				->groupBy('transfers.created_at','transfers.qty','transfers.sku','transfers.from_branch','transfers.to_branch','inventories.unit_price')				
            	->get();
        }  	
        return $transfer;    	
	}

	function getCurrentInventory($branchId,$itemId){
		if($branchId != '0' && $itemId != '0'){
			
			$inventory = DB::table('inventories')
						->where('branch_id',$branchId)
						->where('item_id',$itemId)
						->join('branches', 'inventories.branch_id', '=', 'branches.id')
           				->join('items', 'inventories.item_id', '=', 'items.id')
            			->select('inventories.*', 'branches.title', 'items.name')
						->get();
                			
		}else if($branchId == '0' && $itemId != '0'){
			$inventory = DB::table('inventories')						
						->where('item_id',$itemId)
						->join('branches', 'inventories.branch_id', '=', 'branches.id')
           				->join('items', 'inventories.item_id', '=', 'items.id')
            			->select('inventories.*', 'branches.title', 'items.name')
						->get();
						
		}else if($branchId != '0' && $itemId == '0'){

			$inventory = DB::table('inventories')
						->where('branch_id',$branchId)						
						->join('branches', 'inventories.branch_id', '=', 'branches.id')
           				->join('items', 'inventories.item_id', '=', 'items.id')
            			->select('inventories.*', 'branches.title', 'items.name')
						->get();
					
		}else{
			$inventory = DB::table('inventories')						
						->join('branches', 'inventories.branch_id', '=', 'branches.id')
           				->join('items', 'inventories.item_id', '=', 'items.id')
            			->select('inventories.*', 'branches.title', 'items.name')
						->get();
						
		}		

		return $inventory;
	}

	function getCurrentSummary($branchId,$itemId){
		if($branchId != '0' && $itemId != '0'){
			$summary  = DB::table('inventories')										
                		->select( DB::raw(" SUM(`qty`) as total_qty, sum(`cost_price`*`qty`) as total_cost, sum(`unit_price`*`qty`) as total_unit "))
                		->where('branch_id',$branchId)
						->where('item_id',$itemId)
						->where('qty','>',0)->get();
                			
		}else if($branchId == '0' && $itemId != '0'){
			$summary  = DB::table('inventories')										
                		->select( DB::raw(" SUM(`qty`) as total_qty, sum(`cost_price`*`qty`) as total_cost, sum(`unit_price`*`qty`) as total_unit "))
                		->where('item_id',$itemId)
						->where('qty','>',0)->get();
                						
		}else if($branchId != '0' && $itemId == '0'){
			$summary  = DB::table('inventories')										
                		->select( DB::raw(" SUM(`qty`) as total_qty, sum(`cost_price`*`qty`) as total_cost, sum(`unit_price`*`qty`) as total_unit "))
                		->where('branch_id',$branchId)
						->where('qty','>',0)->get();
                						
		}else{
			$summary  = DB::table('inventories')										
                		->select( DB::raw(" SUM(`qty`) as total_qty, sum(`cost_price`*`qty`) as total_cost, sum(`unit_price`*`qty`) as total_unit "))              		
						->where('qty','>',0)->get();
                						
		}		

		return $summary;
	}

	function getInventory($from, $to, $branchId){
		if($branchId === '0'){
			$inventory = DB::table('inventories')	
						->where('inventories.created_at','>',$from)	
						->where('inventories.created_at','<',$to)					
						->join('branches', 'inventories.branch_id', '=', 'branches.id')
           				->join('items', 'inventories.item_id', '=', 'items.id')
            			->select('inventories.*', 'branches.title', 'items.name')
						->get();
		}else{
			$inventory = DB::table('inventories')
						->where('inventories.branch_id',$branchId)	
						->where('inventories.created_at','>',$from)	
						->where('inventories.created_at','<',$to)					
						->join('branches', 'inventories.branch_id', '=', 'branches.id')
           				->join('items', 'inventories.item_id', '=', 'items.id')
            			->select('inventories.*', 'branches.title', 'items.name')
						->get();
		}
		return $inventory;

	}

	function getSummary($from, $to, $branchId){
		if($branchId === '0'){
			$summary  = DB::table('inventories')						
					->where('inventories.created_at','>',$from)	
					->where('inventories.created_at','<',$to)											
                	->select( DB::raw(" SUM(`qty`) as total_qty, sum(`cost_price`*`qty`) as total_cost, sum(`unit_price`*`qty`) as total_unit "))              		
					->where('qty','>',0)->get();
		}else{
			$summary  = DB::table('inventories')
					->where('inventories.branch_id',$branchId)	
					->where('inventories.created_at','>',$from)	
					->where('inventories.created_at','<',$to)											
                	->select( DB::raw(" SUM(`qty`) as total_qty, sum(`cost_price`*`qty`) as total_cost, sum(`unit_price`*`qty`) as total_unit "))              		
					->where('qty','>',0)->get();
		}
		return $summary;				
	}

	function getItemInventory($sku){
		$inventory = DB::table('inventories')	
						->where('inventories.sku','=',$sku)											
						->join('branches', 'inventories.branch_id', '=', 'branches.id')
           				->join('items', 'inventories.item_id', '=', 'items.id')
            			->select('inventories.*', 'branches.title', 'items.name')
						->get();
		return $inventory;				
	}

	function getItemSale($sku){
		$sale =  DB::table('saleitems')	
					->where('saleitems.sku','=',$sku)
					->join('sales', 'saleitems.sale_id', '=', 'sales.id')
					->select('saleitems.*', 'branches.title', 'users.name')
					->join('branches', 'sales.branch_id', '=', 'branches.id')
					->join('users', 'sales.user_id', '=', 'users.id')
					->get();            	

            
		return $sale;
	}

	function getItemTransfers($sku){
		$transfer = DB::table('transfers')				
             	->select('transfers.created_at','transfers.sku','transfers.from_branch','transfers.to_branch','transfers.qty', 'transfers.comment')
				->where('transfers.sku', '=',$sku)			
            	->get();
          	
        return $transfer;
	}

	function getItemTracks($sku){
		$track =  DB::table('trackinventories')	
					->select('trackinventories.*', 'branches.title', 'users.name')	
					->where('trackinventories.sku','=',$sku)					
					->join('branches', 'trackinventories.branch_id', '=', 'branches.id')
					->join('users', 'trackinventories.user_id', '=', 'users.id')
					->get();
            
		return $track;
	}

	function getSummaryVat($branch='',$from='',$to=''){

		$to = $to.' 23:59:59';

		$from = $from.' 00:00:01';

		if($branch ==''){

			$sale = DB::table('sales')					

             	->select('branch_id',DB::raw('sum(total_tax) as total'))

             	->where('created_at', '>',$from)

             	->where('created_at', '<',$to)

             	->groupBy('branch_id');

            $data = DB::table('branches')

			    ->joinSub($sale, 'sales', function ($join) {

			            $join->on('branches.id', '=', 'sales.branch_id');

			    })->get(); 

		}else{


			$sale = DB::table('sales')					

             	->select('branch_id',DB::raw('sum(total_sale) as total'))

             	->where('created_at', '>',$from)

             	->where('created_at', '<',$to)

             	->where('branch_id',$branch)

             	->groupBy('branch_id');

            $data = DB::table('branches')

			    ->joinSub($sale, 'sales', function ($join) {

			            $join->on('branches.id', '=', 'sales.branch_id');

			    })->get(); 

		

		}
		//dd($data);

        return $data;	   

	}

	function getPaymentHistory($from, $to, $branch ='', $type=''){
		$to = Carbon::create($to.' 23:59:59');
		$from = Carbon::create($from.' 00:00:01');

		if($branch && $type){
			$payments = DB::table('salepayments')
				->select('salepayments.amount','paymenttypes.typename','branches.title', 'sales.created_at', 'sales.id')		
				->join('sales', 'salepayments.sale_id', '=', 'sales.id') 
				->join('paymenttypes', 'salepayments.payment_type', '=', 'paymenttypes.id')  
				->join('branches', 'sales.branch_id', '=', 'branches.id') 
				->where('salepayments.created_at', '>=', $from)
				->where('salepayments.created_at', '<=', $to)	
				->where('salepayments.payment_type', $type)	
				->where('sales.branch_id', $branch)	
				->get();
		}else if($branch){

			$payments = DB::table('salepayments')
			->select('salepayments.amount','paymenttypes.typename','branches.title', 'sales.created_at', 'sales.id')		
			->join('sales', 'salepayments.sale_id', '=', 'sales.id') 
			->join('paymenttypes', 'salepayments.payment_type', '=', 'paymenttypes.id')  
			->join('branches', 'sales.branch_id', '=', 'branches.id') 
			->where('salepayments.created_at', '>=', $from)
			->where('salepayments.created_at', '<=', $to)	
			->where('sales.branch_id', $branch)	
			->get();

		}elseif($type){

			$payments = DB::table('salepayments')
			->select('salepayments.amount','paymenttypes.typename','branches.title', 'sales.created_at', 'sales.id')		
			->join('sales', 'salepayments.sale_id', '=', 'sales.id') 
			->join('paymenttypes', 'salepayments.payment_type', '=', 'paymenttypes.id')  
			->join('branches', 'sales.branch_id', '=', 'branches.id') 
			->where('salepayments.created_at', '>=', $from)
			->where('salepayments.created_at', '<=', $to)	
			->where('salepayments.payment_type', $type)	
			->get();
		}else{

			$payments = DB::table('salepayments')
				->select('salepayments.amount','paymenttypes.typename','branches.title', 'sales.created_at', 'sales.id')
				->where('salepayments.created_at', '>=', $from)
				->where('salepayments.created_at', '<=', $to)			
				->join('sales', 'salepayments.sale_id', '=', 'sales.id') 
				->join('paymenttypes', 'salepayments.payment_type', '=', 'paymenttypes.id')  
				->join('branches', 'sales.branch_id', '=', 'branches.id') 	
				->get();
		}

		return $payments;		

	}

	function getSalesPayment(){
		$payments = DB::table('salepayments')
				->select( DB::raw('sum(salepayments.amount) as amount'),'paymenttypes.typename as name')
				->whereDate('salepayments.created_at', Carbon::today())
				->join('paymenttypes', 'salepayments.payment_type', '=', 'paymenttypes.id')
				->groupBy('salepayments.payment_type')
				->get();

		return $payments;
	}

	function getEspenses($branch_id='',$from='',$to=''){
		$data = [];

		if($branch_id){
			$to = Carbon::create($to.' 23:59:59');
			$from = Carbon::create($from.' 00:00:01');

			$branch = DB::table('branches')->where('id', $branch_id)->get()->first();
			$expenses = DB::table('expenses')
				->select('*')
				->where('expenses.created_at', '>=', $from)
             	->where('expenses.created_at', '<=', $to)
				 ->where('expenses.branch_id',  $branch_id)
				->join('expensetypes', 'expenses.expensetype_id', '=', 'expensetypes.id')   	
				->get();	

			$data[$branch->name] = $expenses;

		}else{
			$expenses = DB::table('expenses')
				->select('*')
				->whereDate('expenses.created_at', Carbon::today())
				->join('expensetypes', 'expenses.expensetype_id', '=', 'expensetypes.id')   	
				->get();

			$branches = DB::table('branches')->get();
			
			foreach($branches as $branch){
				if($expenses){
					foreach($expenses as $expense){
						if($expense->branch_id === $branch->id){
							$data[$branch->name][] = [
								'addby'=> $expense->addby,
								'amount'=> $expense->amount,
								'typename'=> $expense->typename,
								'description'=> $expense->description
							];
						}
					}
				}	
			}
		}

		return $data;	
	}

	function getExpenseTotal($date='', $branch_id=''){
		$tot = 0.00;

		if($date=='')$date= Carbon::today();		

		if($branch_id){
			$expense = DB::table('expenses')
             ->select(DB::raw('sum(amount) as total'))
             ->whereDate('created_at', $date)
			 ->where('branch_id', $branch_id)
             ->get()->first();
		}else{
			$expense = DB::table('expenses')
             ->select(DB::raw('sum(amount) as total'))
             ->whereDate('created_at', $date)
             ->get()->first();
		}

        $tot +=$expense->total;      

		return $tot;
	}

	
	function getSummaryProfit(){
			$data = DB::table('saleitems')
             	->select('branches.id', 'saleitems.sale_id', DB::raw('sum(saleitems.unit_price) as unit, sum(saleitems.cost_price) as cost'))
             	->whereDate('saleitems.created_at', Carbon::today())
				->join('sales', 'saleitems.sale_id', '=', 'sales.id')
				->join('branches', 'sales.branch_id', '=', 'branches.id')
             	->groupBy('sale_id')
				->get();
		
        return $data;	
	}

	function getProfit($branch, $from, $to){

		$to = $to.' 23:59:59';

		$from = $from.' 00:00:01';

		
		if($branch){
			$data = DB::table('saleitems')
				->select('branches.title', 'saleitems.sale_id','saleitems.created_at', DB::raw('sum(saleitems.unit_price) as unit, sum(saleitems.cost_price) as cost'))
				
				->where('saleitems.created_at', '>',$from)

				->where('saleitems.created_at', '<',$to)

				->where('branches.id', $branch)

				->join('sales', 'saleitems.sale_id', '=', 'sales.id')
				->join('branches', 'sales.branch_id', '=', 'branches.id')
				->groupBy('saleitems.sale_id')
				->groupBy('saleitems.created_at')
				->get();
		}
	
		return $data;	
	}

//end

}

?>