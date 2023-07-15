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
                <h3 class="card-title">Sale Payments</h3> 
                <!-- /.card-tools -->
              </div>

              <!-- /.card-header -->

              <div class="card-body">
                    <table class="table" width="100%" style="text-align:center">
                        <tr>
                           
                            <th>Payment Type</th>
                            <th>Amount</th>
                           
                        </tr>
                
                     <?php if($payments){

                                foreach($payments as $key => $payment){
                                    
                                    $total = 0;
                                    $total += floatval($payment->amount);
                                ?>
                                                            
                                <tr>
                                    
                                    <td>{{ $payment->name }}</td>
                                    <td>{{ Helper::toCurrency($payment->amount) }} </td>                            
                                 </tr>
                                                    
                                <?php 
                                }
                                            
                                echo '<tr><td>Total</td><td>'.Helper::toCurrency($total).'</td></tr>'; 

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