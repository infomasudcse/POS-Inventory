@extends('admin')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">

      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <!-- use this space for notify user -->
            @if (session('status'))
              <div class="alert alert-info">
                  {{ session('status') }}
              </div>
            @endif
            @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
    <!-- /.content-header -->

    <!-- Main content -->
<div class="content">
      <div class="container-fluid">
        <div class="row">         
          <div class="col-lg-12">
            <div class="card card-info card-outline">
              <div class="card-header">
                  <div class="row">
                      <div class="col-12"><h5 class="m-0 text-center">Details</h5></div>
                      <div class="col-12">
                      <h5 class="m-0">Name: {{ $customer->name }}</h5>
                      <h5 class="m-0">Mobile: {{ $customer->mobile }}</h5>
                      </div>

                  </div>  

                    
              </div>
              <div class="card-body">
              <table id="customerSalesTable" class="table table-bordered">
                <thead>
                <tr>                  
                  <th>Date</th> 
                  <th>Branch</th>
                  <th>Items</th>
                  <th>subtotal</th>                    
                  <th>Total</th>                  
                  <th>Tax</th>
                  <th>Discount</th>
                  <th>Receipt</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                    if($sales){
                    
                    foreach($sales as $sale){ ?>
                        
                        <tr>                         
 
                           <td><?=date('d-m-Y', strtotime($sale->created_at));?></td>
                           <td><?=$sale->title;?></td>
                           <td><?=$sale->total_item;?></td>                          
 
                           <td><?=Helper::toCurrency($sale->subtotal);?> </td>
 
                           <td><?=Helper::toCurrency($sale->total_sale);?></td>
 
                           <td><?=Helper::toCurrency($sale->total_tax);?></td>
 
                           <td><?=Helper::toCurrency($sale->total_discount);?></td>
                           <td><a href="<?=url('/sales/receipt/'.$sale->id);?>" class="clink" target="_blank">
                             <?=Helper::viewSaleId($sale->id);?></a></td>
                         </tr>
                    <?php } }else{
                        echo '<tr><td colspan="7"><div class="alter alert-warning">No Sales !</div></td></tr>';
                    }  ?>
                </tbody>               
              </table>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</div>


@endsection