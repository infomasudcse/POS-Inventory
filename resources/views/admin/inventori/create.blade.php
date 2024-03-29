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

                <h5 class="m-0">New {{ $title }} </h5>

              </div>

              <div class="card-body">

                

              <form class="form-horizontal inventory-form" action="{{ url('inventories') }}" method="POST" >

                @csrf

                <div class="card-body">



                 <div class="form-group row">

                    <label for="productsearch" class="col-sm-2 col-form-label">Select Item</label>

                    <div class="col-sm-8 search-area">

                        <input type="text"  class="form-control is-warning" id="productsearch"  placeholder="start typing product name...." autocomplete="off" actionTo="{{ url('ItemController/getSuggestion') }}" />

                        <input type="hidden" name="product_id" value="" id="product_id"/>

                        <div class="list-group-div" id="search_result" data-fill="input-pick" style="position: absolute; display:none; max-height:200px; overflow-y:scroll;z-index: 10;width:96%;border:1px dotted red;">

                          <ul class="list-group">
                          </ul>                        

                        </div>

                    </div>

                    <div class="col-sm-2 error-div"></div>



                  </div> 

                  

                <div class="form-group row">

                    <label for="branch" class="col-sm-2 col-form-label">Select Branch</label>

                    <div class="col-sm-8">

                      <select id="branch" name="branch_id" class="form-control is-warning" readonly>

                          @foreach ($branches as $branch)

                                <option value="{{ $branch->id }}"> {{ $branch->name }}</option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-sm-2 error-branch"></div>

                  </div>

                  <?php if($config->autobarcode): ?>
                    <div class="form-group row">
                        <label for="sku" class="col-sm-2 col-form-label">Bar Code/SKU</label>
                        <div class="col-sm-6">
                          <input type="numeric" step="1" name="sku" class="form-control is-warning" id="sku"  value="{{ old('sku') }}" required>
                        </div>
                        <div class="col-4">
                           <p class="d-inline-block text-truncate font-weight-light font-italic"> Bar Code Required As auto bar code off ! </p>

                        </div>
                    </div> 
                <?php endif; ?>


                <div class="form-group row">

                    <label for="qty" class="col-sm-2 col-form-label">Quantity</label>

                    <div class="col-sm-6">

                      <input type="number" name="qty" class="form-control is-warning" id="qty"  value="{{ old('qty') }}" required>

                    </div>

                    <div class="col-4">
                           <p class="d-inline-block text-truncate font-weight-light font-italic"> Quantity Required  </p>

                        </div>

                </div>

                <div class="form-group row">

                    <label for="costp" class="col-sm-2 col-form-label">Cost Price</label>

                    <div class="col-sm-6">

                      <input type="number" step=".01" name="costp" class="form-control is-warning" id="costp"  value="{{ old('costp') }}" required>

                    </div>

                    <div class="col-4">
                           <p class="d-inline-block text-truncate font-weight-light font-italic"> Item unit cost </p>

                        </div>
                </div>

                <div class="form-group row">

                    <label for="salep" class="col-sm-2 col-form-label">Sale Price</label>

                    <div class="col-sm-6">

                      <input type="number" step=".01" name="salep" class="form-control is-warning" id="salep"  value="{{ old('salep') }}" required>

                    </div>

                    <div class="col-4">
                           <p class="d-inline-block text-truncate font-weight-light font-italic"> Item unit sell price </p>

                        </div>

                </div>



                <div class="form-group row custom-color-row">

                   <div class="col-sm-2">

                      <p>Item Variation</p>

                      

                    </div>

                   <div class="col-sm-8">

                       @foreach ($variations as $variation)





                      <div class="row mt-2 mb-2">

                        <div class="col-sm-5">

                            <label class="form-label text-center">{{ $loop->iteration}} . {{ $variation['v_name'] }}</label>

                        </div>

                        <div class="col-sm-5">

                            

                            <select  name="vaval_id[]" class="form-control">

                                <option value="">Select</option>

                              @foreach ($variation['variationvals'] as $vals)

                                <option value="{{ $vals->id }}" > {{ $vals->value }} </option>



                              @endforeach

                            </select>

                        </div>                                                

                      </div>



                      @endforeach

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