@extends('pos')

@section('content')

<div class="">

      <div class="container">

        <div class="row mb-2">

          <div class="col">        

             <!-- use this space for notify user -->

            @if (session('status'))

              <div class="alert-info">

                  {{ session('status') }}

              </div>

            @endif

            @if ($errors->any())

              <div class="alert-danger">

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

      <div class="container">

        <div class="row">

            <div class="col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <form class="form-horizontal" action="{{ url('/addExpense/store') }}" method="POST" >

                            @csrf   
                            <div class="row">                
                                <div class="col-12">
                                <div class="form-group row">
                                    <label for="expensetypes" class="col-sm-4 col-form-label">Select Expense Type</label>
                                    <div class="col-sm-6">
                                    <select id="expensetypes" name="expensetype_id" class="form-control is-warning">
                                        <option value=""> Select </option>        
                                        @foreach ($expensetypes as $type)
                                                <option value="{{ $type->id }}"> {{ $type->typename }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="amount" class="col-sm-4 col-form-label">Amount</label>
                                    <div class="col-sm-4">
                                    <input type="number" step="1" name="amount" class="form-control is-warning" id="amount"  value="{{ old('amount') }}" placeholder="0">
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="note" class="col-sm-4 col-form-label">Note</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="note" class="form-control" id="note"  value="{{ old('note') }}" placeholder="...">
                                    </div>
                                    <div class="col-sm-4 text-right">
                                        <button type="submit" class="btn btn-success btn-lg">SAVE</button>
                                    </div>
                                </div>
                                </div>
                                
                            </div>  
                        </form>
                  
                    </div>
                </div>
            </div>

            <div class="col-12">

                <div class="card card-info card-outline">                 

                    <div class="card-body">
                        <h2>Today's Expenses</h2>
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

                </div>

             </div>

         

        </div>

        <!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>



    @endsection