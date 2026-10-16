@extends('admin')

@section('content')

 <div class="content-header">
    <div class="container-fluid">
        <div class="row">
          <div class="col">

            @if (session('status'))

              <div class="alert alert-success">

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

        </div>

      </div>

</div>


<div class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-lg-12">

            <div class="card card-secondary card-outline">

              <div class="card-header">

                  <div class="row">

                      <div class="col"><h5 class="m-0">{{ $title }}</h5></div>

                      <div class="col"><a href="{{ route('salesman.create') }}" class="btn btn-flat btn-primary float-right">New</a></div>

                  </div>

              </div>

              <div class="card-body">

              <table id="salesmanTable" class="table table-bordered">

                <thead>

                <tr>

                  <th>SL.</th>
                  <th>Name/NID</th>
                  <th>Mobile</th>
                  <th>IDNumber</th>
				  				<th>Branch</th>
                  <th>Action</th>

                </tr>

                </thead>

                <tbody>
                </tbody>

              </table>

              </div>

            </div>

          </div>

        </div>

      </div>

</div>

@endsection