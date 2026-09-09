<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="x-ua-compatible" content="ie=edge">
			<?php
					$subtitle = $subtitle ?? '';
					$newTitle = $title ?? 'Dashboard';
			?>
			<title>{{ $newTitle }}</title>
			<link rel="stylesheet" href="{{ asset('alte/fontawesome-free/css/all.min.css') }}">
			<link rel="stylesheet" href="{{ asset('alte/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
			<link rel="stylesheet" href="{{ asset('alte/css/adminlte.min.css') }}">
			<link rel="stylesheet" href="{{ asset('alte/summernote/summernote-bs4.css') }}">
			<link rel="stylesheet" href="{{ asset('alte/css/custom.css') }}">
			<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	</head>

	<body class="hold-transition sidebar-mini">
		<div class="wrapper">
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
					</li>
				</ul>

				<div class="ml-1">
					<h4 class="mb-0">{{ $newTitle }}</h4>
				</div>

				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link" data-toggle="dropdown" href="#">
							<i class="fas fa-power-off"></i> LOG OUT
						</a>

						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
							<span class="dropdown-header">{{ Auth::user()->name }}</span>
							<div class="dropdown-divider"></div>
							<form method="POST" action="{{ route('logout') }}" >
								@csrf

								<a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();this.closest('form').submit();">
									<i class="fas fa-sign-out-alt"></i> Logout
								</a>
							</form>
							<div class="dropdown-divider"></div>
							<span class="dropdown-footer"></span>
						</div>
					</li>
				</ul>
			</nav>

			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<a href="{{ route('dashboard') }} " class="brand-link">
				{{ Helper::printMono() }}
					<span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
				</a>

				<div class="sidebar">
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

							<li class="nav-item">
								<a href="{{ url('/report') }}" class="nav-link <?=(($newTitle=='Report')?'active':'');?>">
									<i class="nav-icon fas fa-chart-bar"></i>
									<p>Report </p>
								</a>
							</li>

							<li class="nav-item has-treeview <?=(($newTitle=='Inventory')?'menu-open':'');?>">
								<a href="#" class="nav-link  <?=(($newTitle=='Inventory')?'active':'');?>">
									<i class="nav-icon fas fa-list"></i>
									<p>Inventory<i class="right fas fa-angle-left"></i></p>
								</a>

								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="{{ url('inventory/massDistribute') }}" class="nav-link ">
											<i class="far fa-circle nav-icon"></i>
											<p>Distribute</p>
										</a>
									</li>

									<li class="nav-item">
										<a href="{{ route('inventories.index') }}" class="nav-link ">
											<i class="far fa-circle nav-icon"></i>
											<p>List</p>
										</a>
									</li>

									<li class="nav-item">
										<a href="{{ route('inventories.create') }}" class="nav-link">
											<i class="far fa-circle nav-icon"></i>
											<p>Create New</p>
										</a>
									</li>
								</ul>
							</li>

							<li class="nav-item has-treeview <?=(($newTitle=='Item')?'menu-open':'');?>">
								<a href="#" class="nav-link  <?=(($newTitle=='Item')?'active':'');?>">
									<i class="nav-icon fas fa-layer-group"></i>
									<p>Items<i class="right fas fa-angle-left"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="{{ route('items.index') }}" class="nav-link">
											<i class="far fa-circle nav-icon"></i>
											<p>Item List</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="{{ route('items.create') }}" class="nav-link">
											<i class="far fa-circle nav-icon"></i>
											<p>New Item</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item has-treeview <?=(($newTitle=='Item-Settings')?'menu-open':'');?>">
								<a href="#" class="nav-link  <?=(($newTitle=='Item-Settings')?'active':'');?>">
									<i class="nav-icon fas fa-drum-steelpan"></i>
									<p>Item Settings<i class="right fas fa-angle-left"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="{{ route('subcategories.index') }}" class="nav-link <?=(($subtitle=='Sub Category')?'active':'');?>">
											<i class="nav-icon fab fa-pagelines"></i>
											<p>Sub Category </p>
										</a>
									</li>

									<li class="nav-item">
										<a href="{{ route('categories.index') }}" class="nav-link <?=(($subtitle=='Category')?'active':'');?>">
											<i class="nav-icon fas fa-tree"></i>
											<p>Category </p>
										</a>
									</li>
									<li class="nav-item">
									<a href="{{ route('variationvals.index') }}" class="nav-link  <?=(($subtitle=='Variation value')?'active':'');?>">
										<i class="nav-icon fab fa-creative-commons-nd"></i>
										<p>Variation Value </p>
									</a>
								</li>

								<li class="nav-item">
									<a href="{{ route('variations.index') }}" class="nav-link  <?=(($subtitle=='Variations')?'active':'');?>">
										<i class="nav-icon fab fa-blackberry"></i>
										<p>Variations </p>
									</a>
								</li>
								</ul>
							</li>

							<li class="nav-item">
								<a href="{{ route('employees.index') }}" class="nav-link  <?=(($newTitle=='Employees')?'active':'');?>">
									<i class="nav-icon fas fa-user-tie"></i>
									<p>Employee </p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('salesman.index') }}" class="nav-link  <?=(($newTitle=='Salesman')?'active':'');?>">
									<i class="nav-icon fas fa-user-tie"></i>
									<p>Salesman </p>
								</a>
							</li>

							<li class="nav-item">
								<a href="{{ route('branches.index') }}" class="nav-link  <?=(($newTitle=='Branches')?'active':'');?>">
									<i class="nav-icon fab fa-hubspot"></i>
									<p> Branches </p>
								</a>
							</li>

							<li class="nav-item">
								<a href="{{ route('customer.index') }}" class="nav-link  <?=(($newTitle=='Customer')?'active':'');?>">
									<i class="nav-icon fas fa-users"></i>
									<p>Customers </p>
								</a>
							</li>

							<li class="nav-item">
								<a href="{{ route('expenses.index') }}" class="nav-link  <?=(($newTitle=='Expenses')?'active':'');?>">
									<i class="nav-icon fas fa-money-bill"></i>
									<p>Expenses </p>
								</a>
							</li>

							<li class="nav-item">
								<a href="{{ url('/sms') }}" class="nav-link  <?=(($newTitle=='SMS')?'active':'');?>">
								<i class="nav-icon far fa-comment-dots"></i>
									<p>SMS</p>
								</a>
							</li>

							<li class="nav-item has-treeview <?=(($newTitle=='Configuration')?'menu-open':'');?>">
								<a href="#" class="nav-link  <?=(($newTitle=='Configuration')?'active':'');?>">
									<i class="nav-icon fas fa-cog"></i>
									<p>Configuration<i class="right fas fa-angle-left"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="{{ route('expensetype.index') }}" class="nav-link <?=(($subtitle=='Expense-Type')?'active':'');?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Expense Type</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="{{ route('paymenttype.index') }}" class="nav-link <?=(($subtitle=='Payment-Type')?'active':'');?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Payment Type</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="{{ route('configs.index') }}" class="nav-link <?=(($subtitle=='Config')?'active':'');?>">
											<i class="far fa-circle nav-icon"></i>
											<p>System Configuration</p>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</nav>
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<li class="nav-item" style="opacity: .4; margin-top: 100px;">
								<a href="https://www.anisha.uk/" class="nav-link">
									<p>Powered by ANISHA </p>
								</a>
							</li>
						</ul>
					</nav>
				</div>
			</aside>

			<div class="content-wrapper">

				@yield('content')

			</div>

		</div>

		<script src="{{ asset('alte/js/jquery/jquery.min.js') }}"></script>
		<script src="{{ asset('alte/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('alte/datatables/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('alte/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
		<script src="{{ asset('alte/js/adminlte.min.js') }}"></script>
		<script src="{{ asset('alte/summernote/summernote-bs4.min.js') }}"></script>
		<script src="{{ asset('alte/js/custom.js') }}"></script>
		<?php if($newTitle=='Dashboard') { ?>
			<!-- load only on dashboard -->
			<script src="{{ asset('alte/js/flot/jquery.flot.js') }}"></script>
			<script src="{{ asset('alte/js/flotold/jquery.flot.resize.min.js') }}"></script>
			<script src="{{ asset('alte/js/chart.js') }}"></script>
		<?php } ?>

	</body>

</html>