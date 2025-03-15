@extends('admin')



@section('content')

 <!-- Content Header (Page header) -->

 <div class="content-header">

      <div class="container-fluid">

        <div class="row">

          <!-- use this space for notify user -->

           <div class="col">

            <!-- use this space for notify user -->

            @if(!$sms_balance)
              <div class="alert alert-danger"> SMS FEATURE NOT Active Yet</div>
            @endif

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



        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

</div>


    <!-- Main content -->

<?php 
$cids = isset($ids)? $ids : '';

?>    

<div class="content">

      <div class="container-fluid">

        <div class="row">
         
          <div class="col-12 col-md-6"> 
            <div class="card card-secondary card-outline">
              <div class="card-header">
                <h5 class="m-0">New SMS</h5>
              </div>
              <div class="card-body">
                @if($sms_balance)                
                <form class="form-horizontal" action="{{ url('sms/sendSms') }}" method="POST" >
                @else
                <form class="form-horizontal" action="#" method="GET" >
                @endif

                  @csrf
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="fn" class="col-sm-2 col-form-label"> Mobile Number</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control is-warning" id="fn" name="mobile_no" value="{{ $cids }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="fn" class="col-sm-2 col-form-label">Message</label>
                      <div class="col-sm-10">
                        <textarea class="form-control is-warning" id="fn" rows="5" name="message">{{ old('message') }}</textarea>
                      </div>
                    </div>
                    
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-lg">SEND</button>
                    
                  </div>
                  <!-- /.card-footer -->
                </form>
              </div>
            </div>
          </div>  

          @if($sms_balance)
            <div class="col-12 col-md-6">
              <div class="small-box bg-primary p-3">
                <div class="inner">                  
                  <h3>Non Masking SMS: {{ $sms_balance->nonmasking }}</h3>
                  <h3>Masking SMS: {{ $sms_balance->masking }}</h3>
                  <h3>Last Update: {{ date('d-m-Y h:i', strtotime($sms_balance->updated_at)) }}</h3>

                  <a href="{{ url('sms/updateBalance') }}" class="btn btn-lg button btn-success">Update SMS Balance</a>              
            
                </div>
                <div class="icon">
                  <i class="fas fa-sms"></i>
                </div>
                
              </div>            
              
            </div>
          @else

          <div class="col-12 col-md-6" style="opacity: 0.2;">
              <div class="small-box p-3">
                <div class="inner">                  
                  <h3>Non Masking SMS: 0</h3>
                  <h3>Masking SMS: 0</h3>
                  <h3>Last Update:  - - - </h3>

                  <a href="#" class="btn btn-lg button btn-success">Update SMS Balance</a>              
            
                </div>
                <div class="icon">
                  <i class="fas fa-sms"></i>
                </div>
                
              </div>            
              
            </div>

          @endif

        </div>
				


      </div><!-- /.container-fluid -->

</div>





@endsection