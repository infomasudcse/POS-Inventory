@extends('admin')



@section('content')

 <!-- Content Header (Page header) -->

 <div class="content-header">

      <div class="container-fluid">

        <div class="row">
            <div class="col text-center">

            @if($status->status=='on')
              <div class="alert alert-success">Your Sale System is On <a href="{{ url('config/changeSystemStatus') }}" class="btn btn-sm btn-danger" onClick="return confirm('Are You Sure ? ')">Suspend</a></div>
            @else
              <div class="alert alert-danger">Your Sale System if Suspended ! <a href="{{ url('config/changeSystemStatus') }}" class="btn btn-sm btn-success" onClick="return confirm('Are You Sure ? ')"> ON</a></div>
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

          <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ Helper::toCurrency($sale) }}</h3>
                <p>Today Sale</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="/report" class="small-box-footer">
                Report <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ Helper::toCurrency($tax) }}</h3>
                <p>Today Tax</p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="/report" class="small-box-footer">
                Report <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

            <!-- ./col -->


          <div class="col-lg-3 col-6">

            <!-- small card -->

            <div class="small-box bg-success">

              <div class="inner">

                <h3>{{ Helper::toCurrency($attendence) }}</h3>



                <p>Today Attendence</p>

              </div>

              <div class="icon">

                <i class="fas fa-users"></i>

              </div>

              <a href="/report" class="small-box-footer">

                Report <i class="fas fa-arrow-circle-right"></i>

              </a>

            </div>

          </div>

          <!-- ./col -->

          <div class="col-lg-3 col-6">

            <!-- small card -->

            <div class="small-box">

              <div class="inner">

                <h3>{{ Helper::toCurrency($expense) }}</h3>



                <p>Expenses Today</p>

              </div>

              <div class="icon">

                <i class="fas fa-chart-line"></i>

              </div>

              <a href="/report" class="small-box-footer">

                Report <i class="fas fa-arrow-circle-right"></i>

              </a>

            </div>

          </div>

          <!-- ./col -->

        </div>

				<!-- Week -->
				<div class="row">
          <div class="col-lg-12"> 
             <div class="card card-default card-outline">
              <div class="card-header bg-warning">
                <h3 class="card-title">  <i class="far fa-chart-bar"></i> Last Week Sales   </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>               
                </div>
              </div>
              <div class="card-body">
                <div id="bar-week-chart" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
				<!-- Month -->

        <div class="row">         

          <div class="col-lg-12">           

             <div class="card card-default card-outline">

              <div class="card-header">

                <h3 class="card-title">

                  <i class="far fa-chart-bar"></i>

                  Month Sales

                </h3>



                <div class="card-tools">

                  <button type="button" class="btn btn-tool" data-card-widget="collapse">

                    <i class="fas fa-minus"></i>

                  </button>

                 

                </div>

              </div>

              <div class="card-body">

                <div id="bar-chart" style="height: 300px;"></div>

              </div>

              <!-- /.card-body-->

            </div>


          </div>

          <!-- /.col-md-6 -->

        </div>

        <!-- /.row -->

      </div><!-- /.container-fluid -->

</div>





@endsection