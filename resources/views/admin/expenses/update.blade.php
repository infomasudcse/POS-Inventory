@extends('admin')



@section('content')

 <!-- Content Header (Page header) -->

 <div class="content-header">



      <div class="container-fluid">

        <div class="row">

          <div class="col">

            <!-- use this space for notify user -->

            @if (session('status'))

              <div class="alert alert-warning">

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

                <h5 class="m-0">Update {{ $title }}</h5>

              </div>

              <div class="card-body">
              <form class="form-horizontal" method="POST" action="{{ url('expenses/'.$expenses->id.'') }}">

                @csrf

                @method('PUT')

                <div class="card-body">

                <div class="form-group row">
                  <label for="brunch" class="col-sm-2 col-form-label">Select Branch</label>
                  <div class="col-sm-10">
                    <select id="brunch" name="branch_id" class="form-control is-warning">
                        @foreach ($branches as $branch)
                              <option value="{{ $branch->id }}" <?=(($branch->id==$expenses->branch_id)?'selected':'')?>> {{ $branch->name }}</option>
                          @endforeach
                      </select>
                  </div>
                </div> 

                <div class="form-group row">
                    <label for="expensetypes" class="col-sm-2 col-form-label">Select Expense Type</label>
                    <div class="col-sm-10">
                      <select id="expensetypes" name="expensetype_id" class="form-control is-warning">
                          @foreach ($expensetypes as $type)
                                <option value="{{ $type->id }}" <?=(($type->id==$expenses->expensetype_id)?'selected':'')?>> {{ $type->typename }}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>

                <div class="form-group row">
                    <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                      <input type="number" step="1" name="amount" class="form-control is-warning" id="amount"  value="{{ $expenses->amount }}">
                    </div>
                </div> 

                <div class="form-group row">
                  <label for="note" class="col-sm-2 col-form-label">Note</label>
                  <div class="col-sm-10">
                    <input type="text" name="note" class="form-control" id="note"  value="{{ $expenses->description }}">
                  </div>
                </div>
                  

                </div>

                <!-- /.card-body -->

                <div class="card-footer">

                  <button type="submit" class="btn btn-success btn-lg">UPDATE</button>

                  

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