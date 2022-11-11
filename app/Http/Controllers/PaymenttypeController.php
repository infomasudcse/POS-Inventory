<?php

namespace App\Http\Controllers;

use App\Models\Paymenttype;
use Illuminate\Http\Request;

class PaymenttypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public $title = 'Configuration';    
    public $subtitle = "Payment-Type";

    public function index()
    {
        $data = ['title'=>$this->title, 'subtitle'=>$this->subtitle];
        return view('admin.paymenttype.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title'=>$this->title, 'subtitle'=>$this->subtitle];
        return view('admin.paymenttype.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([          
            'typename' => 'required|max:30|unique:paymenttypes'        
        ]);
        //validate
        $type = new Paymenttype;           
        $type->typename = ucwords($request->typename);       
            if($type->save()){
                return redirect('paymenttype')->with('status', 'A New Type Just Created!');
            }else{
                return redirect('paymenttype/create')->with('status', 'Something went wrong, Try Again');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paymenttype  $paymenttype
     * @return \Illuminate\Http\Response
     */
    public function show(Paymenttype $paymenttype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paymenttype  $paymenttype
     * @return \Illuminate\Http\Response
     */
    public function edit(Paymenttype $paymenttype)
    {
        return view('admin.paymenttype.update',['title'=>$this->title, 'subtitle'=>$this->subtitle,'paymenttype'=>$paymenttype]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paymenttype  $paymenttype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paymenttype $paymenttype)
    {
        $validatedData = $request->validate([          
            'typename' => 'required|max:30|unique:paymenttypes'             
        ]);
        //validate                 
        $paymenttype->typename = ucwords($request->typename);     
       
        if($paymenttype->save()){
            return redirect('paymenttype')->with('status', 'Type Updated!');
        }else{
            return redirect('paymenttype/'.$paymenttype->$id.'/edit')->with('status', 'Something went wrong, Try Again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paymenttype  $paymenttype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paymenttype $paymenttype)
    {
        //
    }

    public function getPaymentType(){
        $etype = Paymenttype::all();
         $typeData =[]; 
         $i=1;       
         foreach($etype as $type){
            $action = "<div class='btn-group'>
                        <a type='button' href='".url('paymenttype/'.$type->id.'/edit')."' class='btn btn-default btn-sx'>Edit</a>
                        </div>";

                $typeData['data'][] = array($i, ucfirst($type->typename),$action);
                $i++;
         }
        return json_encode($typeData);
    }


}
