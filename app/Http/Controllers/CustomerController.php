<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Traits\CustomerTrait;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use CustomerTrait; 
    public $title = 'Customer'; 
    


    public function index()
    {
        return view('admin.customer.index',['title'=>$this->title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function getCustomers(){
        $customers = $this->getCustomerInfo();
         $customerData =[]; 
         $i=1;       
         foreach($customers as $customer){
            $action = "<div class='btn-group'>
                            <a type='button' href='".url('customer/details/'.$customer->id)."' class='btn btn-warning btn-xs mr-2'>Details</a>               
                        </div>";
                    

                $customerData['data'][] = array( $i, $customer->name, $customer->mobile, Helper::toCurrency($customer->paid), $action);
                $i++;
         }
        
        return json_encode($customerData);
    }

    public function getSuggestion($query){
        $query = Helper::cleanStr($query);
       $customers = Customer::where('mobile', 'LIKE', $query.'%')->get();
        $str = '';
        if($customers->count()){ 
            foreach($customers as $customer){
                $str .= '<li class="list-group-item suggested-item" data-name="'.$customer->name.'" data-mobile="'.$customer->mobile.'" data-id="'.$customer->id.'" >'.$customer->name.' | '.$customer->mobile.'</li>';
            }         
        }
        return json_encode($str);
    }

    public function customersDetails($id){
        $data['title'] = $this->title;
        $data['customer'] = Customer::where('id', $id)->get()->first();
        $data['sales'] = $this->getCustomerSales($id);
        return view('admin.customer.details', $data); 
    }

}
