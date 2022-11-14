@extends('admin')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">

      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <!-- use this space for notify user -->
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
    <!-- /.content-header -->

    <!-- Main content -->
<div class="content">
      <div class="container-fluid">
        <div class="row">         
          <div class="col-lg-12">
            <div class="card card-secondary card-outline">
              <div class="card-header">
                <h5 class="m-0">Basic Configuration</h5>
              </div>
              <div class="card-body">
                
              <form class="form-horizontal" action="{{ route('configs.store') }}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="name" class="col-3 col-form-label">Company Name</label>
                    <div class="col-9">
                      <input type="text" name="business_name" class="form-control" id="name" value="{{ $cf->business_name }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="slogan" class="col-3 col-form-label">Business Slogan</label>
                    <div class="col-9">
                      <input type="text" class="form-control" id="slogan" name="slogan" value="{{ $cf->slogan }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="oname" class="col-3 col-form-label">Owner Name</label>
                    <div class="col-9">
                      <input type="text" class="form-control" id="oname" name="owner_name" value="{{ $cf->owner_name }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="address" class="col-3 col-form-label">Address</label>
                    <div class="col-9">
                      <input type="text" class="form-control" id="address" name="address" value="{{ $cf->address }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="contact" class="col-3 col-form-label">Contact</label>
                    <div class="col-9">
                      <input type="text" class="form-control" id="contact" name="contact" value="{{ $cf->contact }}">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label for="tn" class="col-3 col-form-label">VAT Name</label>
                    <div class="col-9">
                      <input type="text" class="form-control" id="tn" name="default_tax_name" value="{{ $cf->default_tax_name }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tr" class="col-3 col-form-label">VAT Rate</label>
                    <div class="col-9">
                      <input type="number" step="0.01" name="default_tax" class="form-control" id="tr" value="{{ $cf->default_tax }}" required>
                    </div>
                  </div>

                  <div class="form-group row">
                      <label for="inputEmail3" class="col-3 col-form-label">Email</label>
                      <div class="col-9">
                        <input type="email" class="form-control" name="email" id="inputEmail3" value="{{ $cf->email }}">
                      </div>
                    </div>
                    <div class="form-group row">
                    <label for="mh" class="col-3 col-form-label">Memo Header</label>
                    <div class="col-9">
                      <textarea class="textarea form-control" id="mh" name="memo_header" rows="3">{{ $cf->memo_header}}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="rp" class="col-3 col-form-label">Return policy</label>
                    <div class="col-9">                      
                      <textarea class="textarea form-control" id="rp" name="return_policy" rows="3">{{ $cf->return_policy}}</textarea>
                    </div>
                  </div>  
                    <div class="form-group row">
                      <div class="col">
                        <h3 class="form-title  pt-5 mb-3">Bar Code Setup</h3>
                      </div>
                    </div>     

                    <div class="form-group row">
                      <label for="nobarcode" class="col-3 col-form-label">Manual Bar Code</label>
                      <div class="col-2">
                        <input type="checkbox" class="form-control" name="autobarcode" id="nobarcode" value="1" {{ (($cf->autobarcode) ? 'checked': '') }}>
                      </div>
                      <div class="col-4">
                           <p id="check-msg" class="d-inline-block text-truncate font-weight-light font-italic text-danger"> 
                          {{ (($cf->autobarcode) ? 'Manual Bar Code Required later !': 'Bar code will be auto generated ! ') }}
                          </p>

                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="nobarcode" class="col-3 col-form-label">Label Print Per Row </label>
                      <div class="col-6">

                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" value="1" name="br_line" class="custom-control-input" {{ (($cf->br_line=='1') ? 'checked': '') }}>
                            <label class="custom-control-label" for="customRadio1"> 1 [ 1 Bar code per line, Single ]</label>
                          </div>

                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" value="2" name="br_line" class="custom-control-input" {{ (($cf->br_line=='2') ? 'checked': '') }}>
                            <label class="custom-control-label" for="customRadio2"> 2 [ 2 Bar code per line, Envelope ]</label>
                          </div>

                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio3" value="3" name="br_line" class="custom-control-input" {{ (($cf->br_line=='3') ? 'checked': '') }}>
                            <label class="custom-control-label" for="customRadio3"> 2 [ OLD Style ]</label>
                          </div>

                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio4" value="4" name="br_line" class="custom-control-input" {{ (($cf->br_line=='4') ? 'checked': '') }}>
                            <label class="custom-control-label" for="customRadio4">4 [4 Bar code per line, A4 ]</label>
                          </div>

                      </div>                      
                    </div>

                    <div class="form-group row">
                      <div class="col">
                        <h3 class="form-title pt-5 mb-3">Update System Logos</h3>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="logo" class="col-3 col-form-label">Main Logo</label>
                      <div class="col-9">
                        <input type="file" name="logo" class="form-input" id="logo" />
                        <span class="small text-danger"> Size: 300 * 80. <span>
                      </div>
                    </div>

                  <div class="form-group row">
                    <label for="plogo" class="col-3 col-form-label">Profile Logo</label>
                    <div class="col-9">
                      <input type="file" name="mono" class="form-input" id="plogo" />
                      <span class="small text-danger"> Size: 60 * 60. <span>
                    </div>
                  </div>

                  <div class="form-group row">
                      <div class="col">
                        <h3 id="more-option" class="form-title pt-5 mb-3">More....</h3>
                      </div>
                    </div>

                    <div class="hidden-row hidden" id="hidden-row">

                            <div class="form-group row">
                              <label for="tr" class="col-3 col-form-label">Corporate Report Multiply</label>
                              <div class="col-9">
                                <input type="number" step="0.1" name="corporate_multiply" class="form-control" id="tr" value="{{ $cf->corporate_multiply }}" required>
                              </div>
                            </div>
                    </div>




                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Update</button>
                  
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