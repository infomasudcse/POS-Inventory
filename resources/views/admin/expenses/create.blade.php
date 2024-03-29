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

            <div class="card card-secondary card-outline">

              <div class="card-header">

                <h5 class="m-0">New {{ $title }}</h5>

              </div>

              <div class="card-body">

                

              <form class="form-horizontal" action="{{ url('expenses') }}" method="POST" >

                @csrf

                <div class="card-body">



                  <div class="form-group row">

                    <label for="brunch" class="col-sm-2 col-form-label">Select Branch</label>

                    <div class="col-sm-10">

                      <select id="brunch" name="branch_id" class="form-control is-warning">

                          @foreach ($branches as $branch)

                                <option value="{{ $branch->id }}"> {{ $branch->name }}</option>

                            @endforeach

                        </select>

                    </div>

                  </div> 

                  <div class="form-group row">
                    <label for="expensetypes" class="col-sm-2 col-form-label">Select Expense Type</label>
                    <div class="col-sm-10">
                      <select id="expensetypes" name="expensetype_id" class="form-control is-warning">
                          @foreach ($expensetypes as $type)
                                <option value="{{ $type->id }}"> {{ $type->typename }}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>

                <div class="form-group row">
                    <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                      <input type="number" step="1" name="amount" class="form-control is-warning" id="amount"  value="{{ old('amount') }}">
                    </div>
                </div> 

                <div class="form-group row">
                  <label for="note" class="col-sm-2 col-form-label">Note</label>
                  <div class="col-sm-10">
                    <input type="text" name="note" class="form-control" id="note"  value="{{ old('note') }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="fromdate" class="col-sm-2 col-form-label">Date</label>
                  <div class="col-sm-6 col-12">
                  <input type="date" placeholder="dd/mm/yyyy" class="form-control" name="fromDate" id="fromdate" autocomplete="off">
                  <p class="text-muted">If you dont add date , the date will be today.</p>
                  </div>
                  
                </div>

                  
              </div>

                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success btn-lg">SAVE</button>
                </div>

                <!-- /.card-footer -->

              </form>

              </div>

            </div>

          </div>

          <!-- /.col-md-6 -->

        </div>

        <!-- /.row -->

      </div><!-- /.container-fluid -->

</div>





@endsection