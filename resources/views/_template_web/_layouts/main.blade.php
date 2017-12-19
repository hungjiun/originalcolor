<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>OriginalColor</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="/web_assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="/web_assets/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="/web_assets/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
	<!-- DataTables -->
  	<link rel="stylesheet" href="/web_assets/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  	<!-- Sweet Alert -->
    <link rel="stylesheet" href="/web_assets/AdminLTE/plugins/sweetalert/sweetalert.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="/web_assets/AdminLTE/dist/css/AdminLTE.css">
	<link rel="stylesheet" href="/css/private.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="/web_assets/AdminLTE/dist/css/skins/_all-skins.min.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="/web_assets/AdminLTE/bower_components/morris.js/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="/web_assets/AdminLTE/bower_components/jvectormap/jquery-jvectormap.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="/web_assets/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="/web_assets/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="/web_assets/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="/web_assets/AdminLTE/plugins/summernote/dist/summernote.css" >

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	@yield('page-css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		@include('_template_web._layouts.header')
	  
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
			<!-- Sidebar user panel -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="/img/icon_member.png" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
					<p>{{session('member.info.vUserName')}}</p>
				</div>
			</div>
			@include('_template_web._layouts.nav')
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					@if($title != "")
					{{trans ( '_menu.'.$title.'.title' )}}
					@endif
				</h1>
				<ol class="breadcrumb">
					@foreach( $breadcrumb as $key => $var)
						<li><a href="{{$var}}">{{trans ( '_menu.'.$key.'.title' )}}</a></li>
						<!--  -->
					@endforeach
				</ol>
			</section>

			<!-- Main content -->
			@yield('content')
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1.0.0
			</div>
			<strong>Copyright &copy; 2017 <a href="#">OriginalColor</a>.</strong> All rights
			reserved.
		</footer>
	</div>
	<!-- ./wrapper -->

	<!-- jQuery 3 -->
	<script src="/web_assets/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="/web_assets/AdminLTE/bower_components/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	  $.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.7 -->
	<script src="/web_assets/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- DataTables -->
	<script src="/web_assets/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="/web_assets/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<!-- Morris.js charts -->
	<script src="/web_assets/AdminLTE/bower_components/raphael/raphael.min.js"></script>
	<script src="/web_assets/AdminLTE/bower_components/morris.js/morris.min.js"></script>
	<!-- Sparkline -->
	<script src="/web_assets/AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
	<!-- jvectormap -->
	<script src="/web_assets/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="/web_assets/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="/web_assets/AdminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="/web_assets/AdminLTE/bower_components/moment/min/moment.min.js"></script>
	<script src="/web_assets/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- datepicker -->
	<script src="/web_assets/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="/web_assets/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<!-- Slimscroll -->
	<script src="/web_assets/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="/web_assets/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
	<!-- Sweet alert -->
	<script src="/web_assets/AdminLTE/plugins/sweetalert/sweetalert.min.js"></script>
	<!-- AdminLTE App -->
	<!--<script src="/web_assets/AdminLTE/dist/js/adminlte.min.js"></script>-->
	<script src="/web_assets/AdminLTE/dist/js/adminlte.js"></script>

	<!-- Public var -->
	@include('_template_web._js.var')
	<!-- end -->
	<!-- Public commit -->
	@include('_template_web._js.commit')
	<!-- end -->

<!-- ================== page-js ================== -->
@yield('page-js')
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@yield('inline-js')
<!-- ================== /inline-js================== -->	
</body>
</html>
