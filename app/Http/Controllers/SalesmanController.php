<?php
	namespace App\Http\Controllers;

	use App\Models\Config;
	use App\Models\Salesman;
	use App\Models\Branch;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Validator;

	class SalesmanController extends Controller
	{
		public $title = "Salesman";

		public function index()
		{
			$data = ['title'=> $this->title];

			return view('admin.salesman.index', $data);
		}

		/**
		* Show the form for creating a new resource.
		*
		* @return \Illuminate\Http\Response
		*/
		public function create()
		{
			$branches = Branch::orderBy('id', 'asc')->get();

			return view('admin.salesman.create', ['title'=> $this->title, 'branches'=> $branches]);
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
					'name' => 'required|max:40',
					'mobile' => 'required|digits_between:8,20|numeric',
					'nid' => 'required|max:40',
					'idnumber' => 'required|max:40',
			];
			$validatedData = $request->validate($rules);

			$newSalesman = new Salesman;
			$newSalesman->branch_id = $request->branch_id;
			$newSalesman->name = ucfirst($request->name);
			$newSalesman->mobile = ucfirst($request->mobile);
			$newSalesman->nid = ucfirst($request->nid);
			$newSalesman->idnumber = ucfirst($request->idnumber);
			if ($newSalesman->save()) {
					return redirect('salesman')->with('status', 'Salesman Just Created!');
			} else {
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
			$branches = Branch::orderBy('id','asc')->get();

			return view('admin.salesman.update', ['title'=>$this->title, 'salesman'=>$salesman, 'branches'=> $branches]);

		}

		/**
		* Update the specified resource in storage.
		*
		* @param  \Illuminate\Http\Request  $request
		* @param  \App\Models\Salesman  $Salesman
		* @return \Illuminate\Http\Response
		*/
		public function update(Request $request, Salesman $salesman)
		{
			$rules = [
					'branch_id' =>'required|numeric',
					'name' => 'required|max:40',
					'mobile' => 'required|digits_between:8,20|numeric',
					'nid' => 'required|max:40',
					'idnumber' => 'required|max:40',
			];
			$validatedData = $request->validate($rules);

			$salesman->branch_id = $request->branch_id;
			$salesman->name = ucfirst($request->name);
			$salesman->mobile = ucfirst($request->mobile);
			$salesman->nid = ucfirst($request->nid);
			$salesman->idnumber = ucfirst($request->idnumber);
			if ($salesman->save()) {
					return redirect('salesman')->with('status', 'Salesman Updated!');
			} else {
					return redirect('salesman/' . $salesman->$id . '/edit')->with('status', 'Something went wrong, Try Again');
			}
		}

		/**
		* Remove the specified resource from storage.
		*
		* @param  \App\Models\Salesman  $Salesman
		* @return \Illuminate\Http\Response
		*/
		public function destroy(Salesman $salesman)
		{
				//
		}

		public function getSalesmans()
		{
			$salesmans = Salesman::with('branch')->get();
			$salesmanData =[];
			$i=1;
			foreach ($salesmans as $salesman) {
					$action = "<div class='btn-group'>
											<a type='button' href='" . url('salesman/' . $salesman->id . '/edit') . "' class='btn btn-sm btn-default mr-3 btn-item-table'>Edit</a>
												<form action='helper/printSalesmanBarcode' method='post' target='_blank'>
													<input type='hidden' name='_token' value='" . csrf_token() . "' />
													<input type='hidden' name='_method' value='POST'/>
													<input type='hidden' name='idnumber' value='" . $salesman->idnumber . "'/>
													<input type='hidden' name='name' value='" . $salesman->name . "'/>
													<button type='submit' title='PRINT' class='btn btn-default btn-sm btn-item-table'><i class='fas fa-barcode'></i></button>
												</form>
											</div>";

					$salesmanData['data'][] = array($i, $salesman->name . '<br/>' . $salesman->nid, $salesman->mobile, $salesman->idnumber, $salesman->branch->title, $action);
					$i++;
			}

			return json_encode($salesmanData);
		}

	}
	?>