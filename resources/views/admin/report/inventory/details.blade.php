@extends('admin')

@section('content')

 <div class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12"><button type="button" onClick="return  print_this('receiptDiv') " class=" float-right btn btn-sm btn-default">Print</button></div>
        </div>
      </div>
</div>

<div class="content" id="receiptDiv">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <table id="receiptTable" style="width:100%;" cellpadding="3" >
          <tr>
            <td>
							<table style="width:100%;border-bottom: 2px red solid;text-align:center;" id="headerTable">
								<tr><td>{{ Helper::printLogo() }}</td></tr>
								<tr><td>{{ ucwords($config->address) }}</td></tr>
								<tr><td>{{ ucwords($config->contact) }}</td></tr>
							</table>
            </td>
          </tr>
        </table>
      </div>
    </div>

    <div class="row">
			<div class="col">
				<h2> Date: {{ date('d-m-Y') }}</h2>
			</div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">Inventory</h3>
          </div>
          <div class="card-body">
            <table class="table" width="100%" style="text-align:center" >

							<tr>
								<th>SL.</th>
								<th>Item</th>
								<th>SKU</th>
								<th>Qty</th>
								<th>Cost</th>
								<th>Sale</th>
								<th>Branch</th>
								<th>Details</th>
							</tr>

							@foreach ($inventories as $inv)

								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $inv->name }} </td>
									<td>{{ $inv->sku }}</td>
									<td>{{ $inv->qty }}</td>
									<td>{{ $inv->cost_price }}</td>
									<td>{{ $inv->unit_price }}</td>
									<td>{{ $inv->title }}</td>
									<td>
										<?php
										foreach (json_decode($inv->variation) as $variation) {
														echo $variation->variation.' : '.$variation->value.', ';
												}
										?>
									</td>
								</tr>

							@endforeach

            </table>
            <div class="row">
              <div class="col text-center pt-5">
                <h3>Total</h3>
								@foreach ($summary as $total)
									<h4>Qty : {{ $total->total_qty}}</h4>
									<h4>Cost Price: {{ $total->total_cost}}</h4>
									<h4>Sale Price: {{ $total->total_unit}}</h4>
								@endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection