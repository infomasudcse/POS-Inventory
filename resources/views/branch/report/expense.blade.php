@extends('pos')

@section('content')

 <!-- Content Header (Page header) -->

 <div class="content-header">

      <div class="container">

        <div class="row">

          <!-- use this space for notify user -->

           <div class="col-sm-12">

            <h2> Date: {{ $from_to }}</h2>

          </div>

          <div class="col-sm-12">

              <table style="width:100%;text-align:center;" id="headerTable">

                <tr><td>{{ Helper::printLogo() }}</td></tr>

                <tr><td>{{ ucwords($branchinfo->title) }}</td></tr>

                <tr><td>{{ ucwords($branchinfo->address) }}</td></tr>

                <tr><td>{{ $branchinfo->phone }}</td></tr>

                <tr><td style="text-align:right;">Musak: {{ $branchinfo->musak }}</td></tr>
                <tr><td style="text-align:right;">BIN: {{ $branchinfo->bin }}</td></tr>

              </table>

          </div>

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

</div>

    <!-- /.content-header -->



    <!-- Main content -->

<div class="content">

      <div class="container">

        <div class="row">

          <div class="col-md-12">

            <div class="card card-outline card-primary">

              <div class="card-header">

                <h3 class="card-title">Expense</h3>                

                <!-- /.card-tools -->

              </div>

              <!-- /.card-header -->

              <div class="card-body">
              <table id="expenses" class="table">

                    <thead>

                    <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Note</th>                
                    <th>By</th>                     
                    </tr>

                    </thead>

                    <tbody>
                    <?php if($expenses){
                            $total = 0;
                            foreach($expenses as $expense){
                                $total += floatval($expense->amount);
                        ?>
                            <tr>
                                <td>{{ $expense->expensetype->typename }}</td>
                                <td>{{ Helper::toCurrency($expense->amount) }}</td>
                                <td>{{ $expense->description }}</td>                
                                <td>{{ $expense->addby }}</td>                     
                            </tr>
                        <?php 
                                }

                                echo '<tr><th>Total:</th><th colspan="3">'.Helper::toCurrency($total).'</th></tr>';
                            }
                        ?>

                    </tbody>

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