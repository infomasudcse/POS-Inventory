@extends('admin')



@section('content')

 <!-- Content Header (Page header) -->

 <div class="content-header">

      <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12"><button type="button" onClick="return  print_this('receiptDiv') " class=" float-right btn btn-sm btn-default">Print</button></div>
        </div>

      </div><!-- /.container-fluid -->

</div>

    <!-- /.content-header -->



    <!-- Main content -->

<div class="content" id="receiptDiv">

      <div class="container-fluid">
         <div class="row">
          <div class="col">
              <table id="receiptTable" style="width:100%;" cellpadding="3" >
              <tr>
                  <td>
                  <table style="width:100%;border-bottom: 2px red solid;text-align:center;" id="headerTable">
                    <tr><td>{{ Helper::printLogo() }}</td></tr>
                    <tr><td>{{ ucwords( Helper::getConfig()->address) }}</td></tr>
                    <tr><td>{{ ucwords(Helper::getConfig()->contact) }}</td></tr>
                  </table>
                </td>
              </tr>
              
          </table>
          </div>
        </div>
        <div class="row">

          <!-- use this space for notify user -->

          <div class="col">

            <h2> Date: {{ $from_to }}</h2>

          </div>

        </div><!-- /.row -->

        <div class="row">

          <div class="col-md-12">

            <div class="card card-outline card-primary">

              <div class="card-header">

                <h3 class="card-title">Salesman Sales</h3>                

                <!-- /.card-tools -->

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                  <table class="table" width="100%" style="" >
                    <thead>
                      <tr>
                        <th style="text-align:left;">Sales Man</th>
                        <th style="text-align:left;">Item</th>
                        <th style="text-align:left;">Qty</th>                                    
                      </tr>

                    </thead>

                    <tbody>
                      @if($sale_data)
                        @foreach($sale_data as $key => $sell)
                          <tr class="table-info">
                            <td>{{ $sell['salesman_name'] }}</td><td>TOTAL</td><td>{{ $sell['salesman_total_qty'] }}</td>
                          </tr>
                          @if($sell['items'])
                            @foreach($sell['items'] as $item)
                              <tr>
                                <td></td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['qty'] }}</td>
                              </tr>
                            @endforeach
                          @endif
                        @endforeach
                      @endif                    
                    </tbody>             

                  </table>
              </div>
            </div>
          </div>  
        </div>
      </div>
</div>


@endsection