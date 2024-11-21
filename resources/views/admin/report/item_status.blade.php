@extends('admin')



@section('content')



<div class="content">

  <div class="container-fluid">

    <div class="row">

        <div class="col-sm-12"><button type="button" onClick="return  print_this('receiptDiv') " class=" float-right btn btn-sm btn-default">Print</button></div>         



        <div class="col-lg-12">

            <div class="card card-primary card-outline" id="receiptDiv">

                

                <div class="card-header">

                    <div class="row">

                        <div class="col-12"><h1 class="text-center">Status of SKU: {{ $number }}</h1></div>

                    </div>

                    <div class="row">

                        <div class="col-12">
                        @if($inventory)
                          <h3 class="">Cost Price: {{ Helper::toCurrency($inventory[0]->cost_price) }}</h3>
                          <h3 class="">Unit Price: {{ Helper::toCurrency($inventory[0]->unit_price) }}</h3>
                          @endif
                        </div>

                      </div>

                </div> 

                <div class="card-body">

                    <div class="row">

                      <div class="col-12">

                        <h1>Inventory</h1>

                        <table class="table" width="100%">

                          <tr>

                            <th>SL.</th>

                            <th>Item</th>                            

                            <th>Qty</th>      

                            <th>Branch</th>

                            <th>Details</th>

                          </tr>                      

                          @if($inventory)

                          @foreach($inventory as $inv)



                            <tr>

                              <td>{{ $loop->iteration }}</td>

                              <td>{{ $inv->name }} </td>

                              <td>{{ $inv->qty }} </td>

                              <td>{{ $inv->title }} </td>

                              <td>

                                <?php foreach(json_decode($inv->variation) as $variation){

                                        echo $variation->variation.' : '.$variation->value.', ';

                                  }; ?>

                              </td>



                            </tr>



                            @endforeach  

                            @endif

                          </table>

                       

                      </div>

                    </div>

                </div> 

                <div class="card-body">

                    <div class="row">

                      <div class="col-12">

                        <h1>Distributions</h1>

                        <table class="table" width="100%">

                          <tr>

                            <th>SL.</th>

                            <th>Date</th>

                            <th>SKU</th>

                            <th>Qty</th>                           

                            <th>From</th>

                            <th>To</th>

                          

                          </tr>                      

                           @if($distribution)

                              @foreach($distribution as $trans)



                                <tr>



                                  <td>{{ $loop->iteration }}</td>

                                  <td>{{ date('d-m-Y', strtotime($trans['date'])) }} </td>

                                  <td>{{ $trans['sku'] }}</td>

                                  <td>{{ $trans['qty'] }} </td>                                 

                                  <td>{{ $trans['from'] }} </td>

                                  <td>{{ $trans['to'] }} </td>

                                 



                                </tr>



                              @endforeach   

                            @endif

                          </table>

                       

                      </div>

                    </div>

                </div>

                <!-- card-->

                <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <h1>Sale</h1>
                          <table class="table" width="100%">

                          <tr>

                            <th>SL.</th>

                            <th>Date</th>

                            <th>SKU</th>

                            <th>Qty</th>                           

                            <th>Branch</th>

                            <th>User</th>

                            <th>View</th>

                          </tr>   

                          @if($sales)

                              @foreach($sales as $sale)



                                <tr>

                                  <td>{{ $loop->iteration }}</td>

                                  <td>{{ date('d-m-Y', strtotime($sale->created_at)) }} </td>

                                  <td>{{ $sale->sku }}</td>

                                  <td>{{ $sale->qty }} </td>                                 

                                  <td>{{ $sale->title }} </td>

                                  <td>{{ $sale->name }} </td>

                                  <td><a href="{{ url('/sales/receipt/'.$sale->sale_id)}}" class="clink" target="_blank">{{ Helper::viewSaleId($sale->sale_id) }}</a></td>



                                </tr>



                              @endforeach   

                            @endif            

                          

                          </table>
                      </div>
                    </div>
                </div>

                <!-- new card -->
                <div class="card-body">

                  <div class="row">

                    <div class="col-12">

                      <h1>Track Details</h1>

                      <table class="table" width="100%">
                        <tr>
                          <th>SL.</th>
                          <th>Date</th>
                          <th>Branch</th>
                          <th>Qty</th>                 
                          <th>Action</th>
                          <th>User</th>
                        </tr>                      

                        @if($tracks)

                            @foreach($tracks as $track)
                              <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ date('d-m-Y', strtotime($track->created_at)) }} </td>

                                <td>{{ $track->title }}</td>

                                <td>{{ $track->qty }} </td>                                 

                                <td>{{ $track->comment }} </td>

                                <td>{{ $track->name }} </td>

                              </tr>



                            @endforeach   

                          @endif

                        </table>

                    

                    </div>

                  </div>

                  </div>

                 <!-- card end-->                 

            </div>



        </div>



      </div>



  </div>



</div>          





</script>



@endsection