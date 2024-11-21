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
                    <tr><td>{{ ucwords($config->address) }}</td></tr>
                    <tr><td>{{ ucwords($config->contact) }}</td></tr>
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

                <h3 class="card-title">Profits </h3>                

                <!-- /.card-tools -->

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                    <table class="table" width="100%" style="text-align:center" >

                      <tr>

                        <th>SL.</th>
                        <th>Date</th>
                        <th>Cost Price</th>
                        <th>Unit Price</th>
                        <th>Profit</th>

                      </tr> 

                      <?php
                      
                      if(count($profits)){
                        $i = 1;
                        $total_cost = 0;
                        $total_unit = 0;
                        $total_profit = 0;
                          foreach($profits as $key=>$row){
                            
                            $total_unit +=  $row['unit'];
                            $total_cost +=  $row['cost'];
                            $total_profit +=  $row['profit'];
                        ?>
                          <tr>

                            <td>{{ $i }}</td>
                            <td>{{ $key }}</td>
                            <td>{{ Helper::toCurrency($row['cost']) }} </td>
                            <td>{{ Helper::toCurrency($row['unit']) }} </td>
                            <td>{{ Helper::toCurrency($row['profit']) }} </td>
                          </tr>
                      <?php
                      $i++;
                          }  


                          echo '<tr><th></th><th>Total</th><th>'.Helper::toCurrency($total_cost).'</th><th>'.Helper::toCurrency($total_unit).'</th><th>'.Helper::toCurrency($total_profit).'</th></tr>';

                        }

                        ?>

                    </table>

              </div>

              <!-- /.card-body -->

            </div>

            <!-- /.card -->

          </div>         
        </div>

        <!-- /.row -->

      </div><!-- /.container-fluid -->

</div>

@endsection