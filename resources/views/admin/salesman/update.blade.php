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

                <h5 class="m-0">Update {{ $title }} </h5>

              </div>

              <div class="card-body">



              <form class="form-horizontal" method="POST" action="{{ url('salesman/'.$salesman->id.'') }}">
                @csrf

                @method('PUT')

                <div class="card-body">

                  <div class="form-group row">
                    <label for="iteminput" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control is-warning" id="iteminput"  value="{{ $salesman->name }}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                    <div class="col-sm-10">
                      <input type="text" name="mobile" class="form-control is-warning" id="mobile"  value="{{  $salesman->mobile }}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="nid" class="col-sm-2 col-form-label">NID</label>
                    <div class="col-sm-10">
                      <input type="text" name="nid" class="form-control is-warning" id="nid"  value="{{  $salesman->nid }}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="idnumber" class="col-sm-2 col-form-label">ID NUMBER</label>
                    <div class="col-sm-10">
                      <input type="text" name="idnumber" class="form-control is-warning" id="idnumber"  value="{{  $salesman->idnumber }}">
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