<?php

namespace App\Http\Controllers;

use App\Models\Branchexpense;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Expensetype;
use App\Models\Expenses;
use App\Helper\Helper;

class BranchexpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $title = 'Report';	

    public function index()
    {
        $expensetypes = Expensetype::all();
        $expenses = Expenses::where('branch_id', auth()->user()->branch_id)->whereDate('created_at', Carbon::today())->with('expensetype')->get();
        return view('branch.expense',['title'=>$this->title, 'expensetypes'=> $expensetypes,'expenses'=>$expenses]);
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
        $rules = [
            'expensetype_id' =>'required|numeric',
            'amount' => 'required|min:0|max:999999',
            'note' => 'max:200',
        ];
       
        $validatedData = $request->validate($rules);
        //validate
        $newExpenses = new Expenses;           
        $newExpenses->branch_id = auth()->user()->branch_id;        
        $newExpenses->expensetype_id = $request->expensetype_id;
        $newExpenses->amount = $request->amount;
        $newExpenses->description = $request->note; 
        $newExpenses->addby = auth()->user()->name;
        if($newExpenses->save()){
            $status =  'Expense Added!';
        }else{
            $status =  'Something went wrong, Try Again';
        }

        return redirect('expense')->with('status', $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branchexpense  $branchexpense
     * @return \Illuminate\Http\Response
     */
    public function show(Branchexpense $branchexpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branchexpense  $branchexpense
     * @return \Illuminate\Http\Response
     */
    public function edit(Branchexpense $branchexpense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branchexpense  $branchexpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branchexpense $branchexpense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branchexpense  $branchexpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branchexpense $branchexpense)
    {
        //
    }
}
