@extends('pos')

@section('content')

<div class="">

      <div class="container">

        <div class="row mb-2">

          <div class="col">        

             <!-- use this space for notify user -->

            @if (session('status'))

              <div class="alert-warning">

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

          <div class="col-12 col-lg-8">

             <div class="card card-secondary card-outline">

              <div class="card-header">

                <form class="ml-0 ml-md-3" id="" method="POST" action="{{ url('sales/addToCart') }}">

                           @csrf

                    <div class="row">

                     

                          <div class="col-sm-10">  

                              <div class="form-group">

                                 <input type="text" class="form-control is-warning" id="iteminput" name="sku" placeholder="Scan item or enter sku ..." autocomplete="off">

                              </div>                           

                          </div>

                          <div class="col-sm-2">

                                <select name="mode" class="form-control">

                                  <option value="sale">Sale</option>

                                  <option value="return">Return</option>

                                </select>

                          </div>

                     

                    </div>                   

                   </form>

              </div>

              <div class="card-body">
               
                 <table id="inventori" class="table">

                    <thead>

                    <tr>

                      <th>Delete</th>

                      <th>SKU</th>

                      <th>Item</th>                

                      <th>Price</th>                     

                      <th style="width:50px;">Qty</th>                                      

                      <th>Tot</th>

                    </tr>

                    </thead>

                    <tbody>

                      @foreach($cartContent as $content)

                      <tr>

                        <td> <a href="{{ url('sales/removeFromCart/'. $content->rowId.'') }}" class="btn btn-xs btn-outline-secondary">X</a>  </td>

                        <td>{{ $content->id }}</td>

                        <td>{{ $content->name }}<br/>in stock[ {{ $content->options->stock }} ]</td>

                        <td>{{ $content->price }}</td>

                        <td>
                          <form method="POST" action="{{ url('sales/updateQtyToCart') }}">
                             @csrf
                             <input type="hidden" name="rowid" value="{{  $content->rowId }}"/>
                             <input type="number" value="{{ $content->qty }}" name="qty" min="1" max="9" size="1" autocomplete="off"/>
                             <input type="submit" class="btn btn-xs btn-outline-info" value="Update"/> 
                          </form>
                        </td>

                        <td>{{ intval($content->qty) * floatval($content->price) }}</td>

                      </tr>

                      

                      @endforeach



                    </tbody>

                  </table>



              </div>

            </div>



           

          </div>

          <!-- /.col-md-6 -->

          <div class="col-12 col-lg-4">

            <div class="card card-info card-outline">

              <div class="card-header">

                <div class="row">

                  <div class="col"><h5 class="card-title m-0">Sale Summary</h5></div>

                  <div class="col text-right">

                      <a onClick="return askConfirm();" href="{{ url('sales/cancelSale') }}" class="btn btn-secondary btn-sm">Cancel Sale</a>

                  </div>

                </div>               

              </div>
              <div class="card-header">
            
                  @if($customer)

                 
                  <div class="row">
                      <div class="col">
                        <table class="summary_table">
                          <tr>
                              <td>Customer</td>
                              <td class="text-right"> 
                                  <a href="{{ url('sales/removeCustomer') }}" class="btn btn-outline-secondary btn-sm">X</a>
                              </td>
                            </tr>
                          <tr>                            
                              <td colspan="2">{{ ucwords($customer['name']) }} / {{ $customer['mobile'] }}</td>
                          </tr>
                            
                        </table>
                      </div>
                    </div>   

                  @else

                <form action="{{ url('sales/addCustomer') }}" method="POST" id="customerForm">

                  @csrf
                  <div class="row">

                    <div class="col-9">
                      <input id="customerid" class="" type="hidden" name="customer_id" value="" /> 
                      <input id="customername" class="p-0 w-100 mb-1" name="name" type="text" value="{{ old('name') }}" placeholder="Customer Name" autocomplete="off" />
                      <input id="customersearch" class="p-0 w-100" name="mobile" value="" type="text" placeholder="Mobile" autocomplete="off" actionTo="{{ url('CustomerController/getSuggestion') }}"/>
                      <div class="list-group-div" id="search_result" data-fill="input-pick" style="position: absolute; display:none; max-height:200px; overflow-y:scroll;z-index: 10;width:96%;border:1px dotted red;">

                        <ul class="list-group">
                        </ul>                        

                      </div>

                    </div>

                    <div class="col-3 text-right">
                      <button type="submit" class="btn btn-sm btn-outline-info">Add</button>                  
                    </div>

                  </div>

               </form>

                @endif
              </div>

              <div class="card-body" style="padding:0.50rem;">

                <div class="row">

                    <div class="col">

                      <table class="summary_table">

                         <tr>

                            <td>Items :</td>

                            <td class="text-right">{{ $counts }}</td>

                          </tr>

                          <tr>

                            <td>Sub Total :</td>

                            <td class="text-right">{{ Helper::toCurrency($subtotal) }}</td>

                          </tr>

                          <tr>

                            <td>Vat :</td>

                            <td class="text-right">{{ Helper::toCurrency($tax) }}</td>

                          </tr>

                           <tr>

                            <td>Discount :</td>

                            <td class="text-right">{{ Helper::toCurrency($discount) }}</td>

                          </tr>

                          <tr>

                            <td> Total :</td>

                            <td class="text-right">{{ Helper::toCurrency($total) }}</td>

                          </tr>



                      </table>

                    </div>  

                </div>

                <div class="summary_divider"></div>

                <div class="row">

                  <div class="col">



                    <table class="summary_table">

                      <tr>

                        <td style="width:60%;border-right:1px dotted #ccc;">

                           

                            <form action="{{ url('sales/addPayment') }}" method="POST">

                              @csrf

                            <div class="row">

                              <div class="col">

                                <table class="summary_table">

                                <tr><td>Payment Type:</td></tr>

                                <tr><td class="">                                     

                                          <select class="small_input" name="payment_type">

                                          @if($paymentType)
                                              @foreach($paymentType as $ptype)

                                              <option value="{{ $ptype->id }}">{{ $ptype->typename }}</option>

                                              
                                              @endforeach

                                          @endif
                                          </select>                                      

                                  </td>                            

                                </tr>

                                <tr><td>Amount :</td></tr>

                                <tr><td  class="">                                      

                                         <input class="small_input" name="amount" type="number" step="0.01" autocomplete="off" />

                                  </td>

                                </tr>

                                <tr>

                                  <td class="">                                   

                                          <button type="submit" class="btn btn-sm btn-info">Add Payment</button>

                                    

                                  </td>                            

                                </tr>                  

                               

                              </table>

                              </div>

                            </div> 

                            </form> 

                        </td>

                        <td style="width:40%;">

                        @if($branchInfo->discount == 1)

                          <form action="{{ url('sales/addDiscount') }}" method="POST">

                             @csrf

                            <div class="row">

                              <div class="col">

                                <table class="summary_table">

                              <tr><td>Discount Type:</td></tr>

                              <tr><td class="">

                                    <select class="small_input" name="discount_type">

                                      <option value="fixed">Fixed</option>

                                      <option value="percent"> - % -  </option>

                                    </select>

                                </td>

                              </tr>

                              <tr><td>Amount :</td></tr>

                              <tr><td  class="">

                                    <input class="small_input" name="amount" type="text" step="0.01" autocomplete="off" /> 

                                </td>

                              </tr>

                              <tr>

                                <td class="">                                 

                                  <button type="submit" class="btn btn-sm btn-outline-info">Add Discount</button>                                    

                                </td>                                

                              </tr> 

                            </table>

                              </div>

                            </div>

                            </form> 
                        @else
                        <h6 class="text-center"> No Discount Option </h6>


                        @endif    


                        </td>

                      </tr>

                    </table>  

                  </div>

                </div>   

                <div class="summary_divider"></div>

                <div class="row">

                  <div class="col">



                        <?php  

                             $payments = session('payment');

                             $amount_paid = 0.00;

                             if($payments){

                         ?>

                        <table class="table">

                          <tr>                     

                            <th>Type</th>

                            <th>Amount</th>

                            <th class="text-right"> <a href="{{ url('sales/deletePayment') }}" class="btn btn-xs btn-outline-secondary">Delete Payment</a></th>

                          </tr>

                          <?php foreach($payments as $paid){ ?>

                          <tr>                     

                            <td><?php echo ucfirst($paid['payment_type']);  ?> </td>

                            <td><?php echo Helper::toCurrency($paid['amount']); ?></td>

                            <td></td>

                          </tr>

                          <?php } ?>

                        </table>



                      <?php } ?>

                    </div>

                 </div>    

                 <div class="summary_divider"></div>



                <table class="summary_table">

                    <tr>

                      <td>Payments Total:</td>

                      <td class="text-right">{{ Helper::toCurrency($payment) }}</td>

                    </tr>

                    <tr>

                      <td>Amount Due:</td>

                      <td  class="text-right"> <?php echo Helper::toCurrency($due); ?></td>

                    </tr>

                    <?php if(($due <= 0) && ($total >= 0) && ($counts > 0)){ ?>

                      <form action="{{ url('sales/doSale') }}" method="POST">

                        @csrf

                        <tr>

                          <td>                       

                          </td>

                          <td class="text-right">

                             <div class="form-group">

                                  <button type="submit" onClick='return askConfirm()' class="btn btn-sm btn-info">Complete</button>

                              </div>

                          </td>

                        </tr>

                      </form>

                    <?php } ?>

                </table>

                

              </div>

            </div>



           

          </div>

          <!-- /.col-md-6 -->

        </div>

        <!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>



    @endsection