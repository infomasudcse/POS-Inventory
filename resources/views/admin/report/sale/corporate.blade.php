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
                <h3 class="card-title">Sales Report</h3>
                <!-- /.card-tools -->
              </div>

              <!-- /.card-header -->

              <div class="card-body pb-5">
                    <table class="table" width="100%" style="text-align:center">
                      <tr>
                        <th>Date</th>
                        <th>Subtotal</th>
                        <th>Tax</th>
                        <th>Total Sale</th>
                      </tr>

                      <?php
                          $total_cost = 0; 
                       ?>

                    <?php 
                     $t_sub = 0;
                     $t_tax = 0;
                     $t_total = 0;
                    foreach($sales as $key => $sale){ 
                        $t_sub += $sale['subtotal'];
                        $t_tax += $sale['tax'];
                        $t_total += $sale['total'];
                    ?>
                        
                       <tr class="details" >                         

                          <td><?=$key;?></td>

                          <td> <?=Helper::toCurrency($sale['subtotal']);?> </td>

                          <td><?=Helper::toCurrency($sale['tax']);?> </td>

                          <td><?=Helper::toCurrency($sale['total']);?></td>

                        </tr>

                       
                    <?php } ?>


                    <tr>
                        <th>Total</th>
                        <th><?=Helper::toCurrency($t_sub);?></th>
                        <th><?=Helper::toCurrency($t_tax);?></th>
                        <th><?=Helper::toCurrency($t_total);?></th>
                    </tr>

                    </table>

                    <?php if($config->corporate_report_note){ ?>

                        <div class="mt-5 mb-3"><p>* Report generated from <?=request()->getHttpHost();?> on <?=date('d-m-Y');?></p></div>

                    <?php } ?>

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