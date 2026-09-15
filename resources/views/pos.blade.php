<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<?php  $newTitle = $title?? 'POS'; ?>
		<title>{{ $newTitle }} </title>
		<link rel="stylesheet" href="{{ asset('alte/css/adminlte.min.css') }}">
		<link rel="stylesheet" href="{{ asset('alte/css/custom.css') }}">
		<link rel="stylesheet" href="{{ asset('alte/css/register.css') }}">
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	</head>
	<body class="hold-transition layout-top-nav">
		<div class="wrapper">
			<nav class="main-header navbar navbar-expand-md navbar-dark">
				<div class="container">
					<a href="#" class="navbar-brand">
					{{ Helper::printMono() }}
					</a>

					<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse order-3 justify-content-center" id="navbarCollapse">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a href="{{ route('sale') }}" class="nav-link">Sales</a>
							</li>
							<!-- <li class="nav-item">
								<a href="#" class="nav-link">Attendence</a>
							</li> -->
							<li class="nav-item">
								<a href="{{ route('expense') }}" class="nav-link">Expense</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('branch-report') }}" class="nav-link">Report</a>
							</li>
							@if(Auth::user()->canTransfer==1)
							<li class="nav-item">
								<a href="{{ route('branch-transfer') }}" class="nav-link">Transfer</a>
							</li>
							@endif

						</ul>

					</div>

					<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

						<li class="nav-item dropdown">
							<a class="nav-link disabled" href="#">
								{{ Auth::user()->name }}
							</a>
						</li>

						<li class="nav-item dropdown">
							<form method="POST" action="{{ route('logout') }}" >
								@csrf
								<a href="{{ route('logout') }}" class="btn button btn-default" onclick="event.preventDefault();this.closest('form').submit();">
									<i class="fas fa-power-off"></i> LOG OUT
								</a>
							</form>
						</li>

					</ul>
				</div>
			</nav>

			<div class="content-wrapper">
				@yield('content')
			</div>

			<footer class="main-footer bg-dark">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-6">
								Powered by <strong><a href="{{ Helper::getConfig()->support_link }}" class="credit-link">{{ Helper::getConfig()->support }}</a></strong>
						</div>
						<div class="col-12 col-sm-6">
								<div class="float-right">
								{{ Helper::getConfig()->business_name }}
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<script src="{{ asset('alte/js/jquery/jquery.min.js') }}"></script>
		<script src="{{ asset('alte/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('alte/js/adminlte.min.js') }}"></script>
		<script src="{{ asset('alte/js/pos.js') }}"></script>
		<?php if ($newTitle=='Report') { ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
		<script type="text/javascript">
			$(function () {
				$('.datepicker').datepicker({format: 'yyyy-mm-dd',autoclose:true});
			});
		</script>
		<?php } ?>

	</body>
</html>