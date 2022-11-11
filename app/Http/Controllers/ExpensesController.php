<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Branch;
use App\Models\Expensetype;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $title = 'Expenses';

    public function index()
    {   $data = ['title'=>$this->title];
        return view('admin.expenses.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expensetypes = Expensetype::all();
        $branches = Branch::all();        
        if($expensetypes->count() > 0){            
            
            return view('admin.expenses.create',['title'=>$this->title,'branches'=>$branches,'expensetypes'=>$expensetypes]); 
        }else{
           return redirect('expensetype')->with('status', 'You must create a Expense Type First. ');
        }
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
            'branch_id' =>'required|numeric',
            'expensetype_id' =>'required|numeric',
            'amount' => 'required|min:0|max:999999',
            'note' => 'max:200',
        ];
       
        $validatedData = $request->validate($rules);
        //validate
        $newExpenses = new Expenses;           
        $newExpenses->branch_id = $request->branch_id;            
        $newExpenses->expensetype_id = $request->expensetype_id;
        $newExpenses->amount = $request->amount;
        $newExpenses->description = $request->note;
       
        if($newExpenses->save()){
            return redirect('expenses')->with('status', 'Expense Added!');
        }else{
            return redirect('expenses/create')->with('status', 'Something went wrong, Try Again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expenses  $Expenses
     * @return \Illuminate\Http\Response
     */
    public function show(Expenses $Expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expenses  $Expenses
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expensetypes = Expensetype::all();
        $branches = Branch::all();    
        $expenses = Expenses::where('id', $id)->with('expensetype')->with('branch')->get()->first();
       
        return view('admin.expenses.update',['title'=>$this->title,'expenses'=>$expenses,'expensetypes'=>$expensetypes,'branches'=>$branches]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenses  $Expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
       $rules = [
            'branch_id' =>'required|numeric',
            'expensetype_id' =>'required|numeric',
            'amount' => 'required|min:0|max:999999',
            'note' => 'max:200',
        ];
       
        $validatedData = $request->validate($rules);
        //validate
        $newExpenses = Expenses::where('id', $id)->get()->first();           
        $newExpenses->branch_id = $request->branch_id;            
        $newExpenses->expensetype_id = $request->expensetype_id;
        $newExpenses->amount = $request->amount;
        $newExpenses->description = $request->note;
       
        if($newExpenses->save()){
            return redirect('expenses')->with('status', 'Update!');
        }else{
            return redirect('expenses/'.$newExpenses->id.'/edit')->with('status', 'Something went wrong, Try Again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {       
       $Expenses = Expenses::find($id);
      
        $Expenses->delete();
       
        return redirect('expenses')->with('status', 'Deleted ! ');
    }

    function getExpenses(){
        $expenses = Expenses::whereDate('created_at', Carbon::today())->with('expensetype')->with('branch')->get();
        $expensesData =[]; 
        $i=1;       
        foreach($expenses as $expense){
            $action = "<div class='btn-group'>
                        <a type='button' href='".url('expenses/'.$expense->id.'/edit')."' class='btn btn-warning btn-xs mr-2'>Edit</a>
                        <form class='delete-form' action='".url('expenses/'.$expense->id)."' method='post'>
                        <input type='hidden' name='_token' value='".csrf_token()."' />
                        <input type='hidden' name='_method' value='DELETE'/>
                        <button type='submit' onClick='return askConfirm()' class='btn btn-default btn-xs delete'>Delete</button>
                        </form>
                        </div>";

                $expensesData['data'][] = array($i,$expense->expensetype->typename,$expense->amount, $expense->description, $expense->branch->name,$action);
                $i++;
         }
        return json_encode($expensesData);
    }

    // function getExpensesByCatId($id){
    //     $subcategories = Expenses::where('category_id', $id)->get();
    //     $options = '';
    //     foreach($subcategories as $subcategory){
    //         $options.= '<option value="'.$subcategory->id.'">'.$subcategory->name.'</option>';
    //     }
    //     return $options;
    // }

    //end
}
