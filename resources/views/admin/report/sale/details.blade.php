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

                <h3 class="card-title">Sales</h3>                

                <!-- /.card-tools -->

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                    <table class="table" width="100%" style="text-align:center" >

                      <tr>

                        <th>SaleID</th>

                        <th>Items</th>

                        <th>Subtotal</th>

                        <th>Total Sale</th>

                        <th>Payment</th>

                        <th>Tax</th>

                        <th>Discount</th>

                      </tr>

                      <?php
                          $total_cost = 0; 
                          
                         

                       ?>

                    <?php foreach($sales as $sale){ ?>
                        
                       <tr class="details" data-id="<?=$sale->id;?>">

                          <td><a href="<?=url('/sales/receipt/'.$sale->id);?>" class="clink" target="_blank">
                            <?=Helper::viewSaleId($sale->id);?></a></td>

                          <td><?=$sale->total_item;?></td>

                          <td>
                            <?=Helper::toCurrency($sale->subtotal);?>
                          </td>

                          <td><?=Helper::toCurrency($sale->total_sale);?> </td>

                          <td><?=Helper::toCurrency($sale->total_payment);?></td>

                          <td><?=Helper::toCurrency($sale->total_tax);?></td>

                          <td><?=Helper::toCurrency($sale->total_discount);?></td>

                        </tr>

                        <tr style="display:none;" id="details{{$sale->id}}">

                          <td colspan="6">
                                  <table class="table">

                                      <tr>
                                        <th>SKU</th>
                                        <th>Qty</th>
                                        <th>Unit Cost</th>
                                        <th>Total Cost</th>
                                        <th>Unit Price</th>  
                                        <th>Total Price</th>
                                        <th>Tax Amount</th>
                                      </tr>

                                  <?php foreach($sale->saleitems as $item){ ?>

                                      <tr>
                                        <td><?=$item->sku;?></td>
                                        <td><?=$item->qty;?></td>
                                        <td>
                                          <?php 
                                            echo Helper::toCurrency($item->cost_price);
                                           
                                          ?>                                          
                                        </td>
                                        <td>
                                          <?php                                           
                                            $items_costing =  floatval($item->cost_price) * $item->qty;
                                            echo Helper::toCurrency($items_costing);
                                            $total_cost += $items_costing;
                                          ?>                                          
                                        </td>

                                        <td><?=Helper::toCurrency($item->unit_price);?></td>
                                        <td>
                                          <?php                                           
                                            echo Helper::toCurrency( floatval($item->unit_price) * $item->qty );
                                          ?>                                          
                                        </td>

                                        <td><?=Helper::toCurrency($item->tax_amount);?> (<?=$item->tax_code;?>%)</td>

                                      </tr> 

                                  <?php } ?>

                               </table>

                          </td>

                        </tr> 
                        <?php } ?>

                    </table>


                   <div class="bg-gray disabled color-palette p-3 mt-2">
                     

                      <?php foreach($summary as $summ){ 
                            $sale_subtotal =  $summ->subtotal;
                            $sale_disq = $summ->discounts;
                        ?>

                     <h4>Total Items : <?= $summ->items;?></h4>
                     <h4>Sub Total : <?=Helper::toCurrency($summ->subtotal);?> </h4>

                     <h4>Total Tax : <?=Helper::toCurrency($summ->taxs); ?></h4>

                     <h4>Total Sale : <?=Helper::toCurrency($summ->totals);?></h4>       

                     <h4>Total Discount : <?=Helper::toCurrency($summ->discounts);?></h4>

                                  

                    <?php } ?> 
                    <?php                       
                          $profit = $sale_subtotal - $total_cost -  $sale_disq; 

                      ?>
                    <h4>Total Profit : <?=Helper::toCurrency($profit);?> </h4>

                   </div>



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