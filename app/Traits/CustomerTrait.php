<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait CustomerTrait{

	function getCustomerInfo(){

        $customer = DB::table('customers')					

             	->select( 'customers.name', 'customers.mobile', 'customers.id', DB::raw('sum(sales.total_sale) as paid'))            
                 ->join('sales', 'customers.id', '=', 'sales.customer_id')
                 ->groupBy('customers.id', 'customers.name', 'customers.mobile')
             	->get();
	
        return $customer;
	}

    function getCustomerSales($id){
        $sales = DB::table('sales')
            ->select('sales.*', 'branches.title')
            ->where('sales.customer_id', $id)
            ->join('branches', 'sales.branch_id', '=', 'branches.id')
            ->get();

            return $sales;
    }


//end

}

?>