<!doctype html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dashboard | @yield('TabTitle')</title>
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{ asset('css/dashboard/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/dashboard/vendor/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/dashboard/vendor/linearicons/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/dashboard/vendor/chartist/css/chartist-custom.css') }}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{ asset('css/dashboard/css/main.css') }}">
 	<link rel="stylesheet" href="{{ asset('css/generator/custom.css') }}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('css/dashboard/img/apple-icon.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/images/favicon.ico') }}">
	<link rel="apple-touch-icon" href="{{ asset('/images/apple-icon-57x57.png') }}">
	@section('style')
	@show
</head>
<body>
 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{route('home')}}" >{{ __("generator.blue_infinty") }}</a>
    </div>
<div class="user-nav">
    	@if (Auth::check())
      		<p style="color:#fff;">{{__('generator.greetings')}} {{Auth::user()->name}},<a style="color:#bce9fb;" href="{{route('logout')}}"><b> {{__('generator.logout')}}</b></a></p>
      	@endif
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="#" role="button"><span class="fa fa-gear" style="margin-left:5px;" aria-hidden="true"></span>{{ __("generator.manage_html") }}</a>       
        </li>
      </ul>
    </div>
  </div>
</nav>
	<div id="wrapper">
		<div class="main" style="padding: 0px !important;margin:0 !important; width: 100%;" >
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-headline">
						@yield('content')
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2018. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	 <script src="https://code.jquery.com/jquery-3.2.1.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="{{ asset('css/dashboard/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('css/dashboard/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
	<script src="{{ asset('css/dashboard/vendor/chartist/js/chartist.min.js') }}"></script>
	<script src="{{ asset('css/dashboard/scripts/klorofil-common.js') }}"></script>
	<script src="{{ asset('js/dashboard/main.js') }}"></script>
	@yield('script')
</body>
</html>
