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
                <h3 class="card-title">Expenses</h3> 
                <!-- /.card-tools -->
              </div>

              <!-- /.card-header -->

              <div class="card-body">
                
                    <?php if($expenses){
                        foreach($expenses as $key => $branch_expense){
                            echo '<h5>'.$key.'</h5>';
                                if($branch_expense){ 
                                    $total = 0;
                                    ?>
                                    <table class="table" width="100%" style="text-align:center" >
                                        <tr>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Note</th>
                                            <th>By</th>
                                        </tr>
                                <?php
                                    foreach($branch_expense as $expense){ 
                                                $total += floatval($expense->amount);
                                        ?>
                                                    
                                            <tr>
                                                <td>{{ $expense->amount }}</td>
                                                <td>{{ Helper::toCurrency($expense->amount) }} </td>
                                                <td>{{ $expense->amount }}</td>
                                                <td>{{ $expense->amount }}</td>
                                            </tr>
                                            
                                    <?php 
                                        }
                                    
                                    echo '<tr><th>Total</th><th>'.Helper::toCurrency($total).'</th><th><th/><th></th></tr>'; 
                                ?>
                                    
                                    </table>
                        <?php 
                               }

                        }
                    }
                    ?>


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