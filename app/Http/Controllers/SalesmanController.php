<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Salesman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalesmanController extends Controller
{
   public $title = "Salesman";

    public function index()
    {
        
        $data = ['title'=>$this->title];
        return view('admin.salesman.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.salesman.create',['title'=>$this->title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [          
            'name' => 'required|max:40',
            'mobile' => 'required|digits_between:8,20|numeric',
            'nid' => 'required|max:40',
            'idnumber' => 'required|max:40',
        ];
       
        $validatedData = $request->validate($rules);
        //validate
        $newSalesman = new Salesman;           
        $newSalesman->name = ucfirst($request->name);
        $newSalesman->mobile = ucfirst($request->mobile);
        $newSalesman->nid = ucfirst($request->nid);
        $newSalesman->idnumber = ucfirst($request->idnumber);
        if($newSalesman->save()){
            return redirect('salesman')->with('status', 'Salesman Just Created!');
        }else{
            return redirect('salesman/create')->with('status', 'Something went wrong, Try Again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salesman  $salesman
     * @return \Illuminate\Http\Response
     */
    public function show(Salesman $salesman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salesman  $salesman
     * @return \Illuminate\Http\Response
     */
    public function edit(Salesman $salesman)
    {       
        return view('admin.salesman.update',['title'=>$this->title,'salesman'=>$salesman]);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salesman  $Salesman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salesman $Salesman)
    {
        
        $rules = [          
            'name' => 'required|max:40',
            'mobile' => 'required|digits_between:8,20|numeric',
            'nid' => 'required|max:40',
            'idnumber' => 'required|max:40',
        ];

       
        $validatedData = $request->validate($rules);

        //validate
        $Salesman->name = ucfirst($request->name);
        $Salesman->mobile = ucfirst($request->mobile);
        $Salesman->nid = ucfirst($request->nid);
        $Salesman->idnumber = ucfirst($request->idnumber);
        if($Salesman->save()){
            return redirect('salesman')->with('status', 'Salesman Updated!');
        }else{
            return redirect('salesman/'.$Salesman->$id.'/edit')->with('status', 'Something went wrong, Try Again');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salesman  $Salesman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salesman $Salesman)
    {
        //
    }

    function getSalesmans(){

        $salesmans = Salesman::all();
         $salesmanData =[]; 
         $i=1;       
         foreach($salesmans as $salesman){
            $action = "<div class='btn-group'>
                        <a type='button' href='".url('salesman/'.$salesman->id.'/edit')."' class='btn btn-default btn-sx'>Edit</a>
                        </div>";

                $salesmanData['data'][] = array($i,$salesman->name.'<br/>'.$salesman->nid,$salesman->mobile,$salesman->idnumber,$action);
                $i++;
         }
        return json_encode($salesmanData);
    }
   

//end     
}

?>