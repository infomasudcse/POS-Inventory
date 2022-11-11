<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ReportTrait;
use App\Models\Branch;
use App\Models\Expenses;
use Carbon\Carbon;


class BranchreportController extends Controller
{
    use ReportTrait;
	public $title = 'Report';	

    public function index(){
		$sale = $this->getSale('', auth()->user()->branch_id);
		$expense =  $this->getExpenseTotal('', auth()->user()->branch_id);
		$cash = floatval($sale) - floatval($expense);

		$data['overview'] = [
			'sale' => $sale,
			'expense' => $expense,
			'cash'=> $cash
		];
		$data['titile'] = ['title'=>$this->title];

    	return view('branch.report.index', $data);
    }

    public function todayDetails(){
		
    	$branch = auth()->user()->branch_id;
    	$data['branchinfo'] = Branch::find($branch);
    	$date = Date('Y-m-d');
    	$data['from_to'] = $date.' / '.$date; 
    	$data['sales'] = $this->getDetailsSale($branch,$date,$date);
    	$data['summary'] = $this->getSummaryOfDetails($branch,$date,$date);
    	return view('branch.report.sale',$data);
    }

    function saleDetails(Request $request){
    	$validatedData = $request->validate([ 
            'fromDate' =>'required',
            'toDate' =>'required'            
            ]);
    	$from = $request->fromDate;
    	$to = $request->toDate;
    	$branch = auth()->user()->branch_id;
    	$data['branchinfo'] = Branch::find($branch);
    	$data['from_to'] = $request->fromDate.' / '.$request->toDate;    	
    	$data['sales'] = $this->getDetailsSale($branch,$request->fromDate,$request->toDate); 
    	$data['summary'] = $this->getSummaryOfDetails($branch,$request->fromDate,$request->toDate);
    	return view('branch.report.sale',$data);
    }

	function branchExpense(){
		$data['expenses'] = Expenses::where('branch_id', auth()->user()->branch_id)->whereDate('created_at', Carbon::yesterday())->with('expensetype')->get();
		$branch = auth()->user()->branch_id;
    	$data['branchinfo'] = Branch::find($branch);    	
    	$data['from_to'] = 'Yesterday';
		return view('branch.report.expense',$data);

	}

//end class 

}

?>