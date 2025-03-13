@extends('pos')

@section('content')

 <!-- Content Header (Page header) -->

 <div class="content-header">

      <div class="container">

        <div class="row"> 
		<div class="col-sm-12"><button type="button" onClick="return  print_this('receiptDiv') " class=" float-right btn btn-sm btn-warning">Print</button></div>
      

          

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

</div>

    <!-- /.content-header -->



    <!-- Main content -->

<div id="receiptDiv" class="content" style="width:100%;">

      <div class="container">

        <div class="row">

			<div class="col-sm-12">

              <table style="width:100%;text-align:center;" id="headerTable">

                <tr><td>{{ Helper::printLogo() }}</td></tr>

                <tr><td>{{ ucwords($branchinfo->title) }}</td></tr>

                <tr><td>{{ ucwords($branchinfo->address) }}</td></tr>

                <tr><td>{{ $branchinfo->phone }}</td></tr>

                <tr><td style="text-align:right;">Musak: {{ $branchinfo->musak }}</td></tr>
                <tr><td style="text-align:right;">BIN: {{ $branchinfo->bin }}</td></tr>

              </table>

          </div>

          <div class="col-md-12">
			

            <div class="card card-outline card-primary">

              <div class="card-header d-flex justify-content-center">                                

                <h3> Stock Date: {{ $today }}</h3>

              </div>

              <!-- /.card-header -->

              <div class="card-body">
              	<table id="" class="table" style="width:100%;">

                    <thead>

                    <tr>
                    <th style="text-align:left;">Item</th>
                    <th style="text-align:left;">Qty</th>                                    
                    </tr>

                    </thead>

                    <tbody>
                    <?php if($stock){
                            $total = 0;
                            foreach($stock as $item){
                                $total += floatval($item->qty);
                        ?>
                            <tr>
                                <td style="text-align:left;">{{ $item->name }}</td>
                                <td style="text-align:left;">{{ $item->qty }}</td>                                                   
                            </tr>
                        <?php 
                                }

                                echo '<tr><th style="text-align:left;">Total:</th><th style="text-align:left;" >'.$total.'</th></tr>';
                            }
                        ?>

							

                    </tbody>

                </table>

              </div>

			       <div class="card-footer" style="text-align:center;">Powered by: ANISHA.UK</div>

              <!-- /.card-body -->

            </div>

            <!-- /.card -->

          </div> 

        </div>

        <!-- /.row -->

      </div><!-- /.container-fluid -->

</div>





@endsection