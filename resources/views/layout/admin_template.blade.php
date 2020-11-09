<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
     
 <link rel="stylesheet" href="{{asset("css/app.css")}}">
  <link rel="stylesheet" href="{{asset("admin_LTE/plugins/fontawesome-free/css/all.min.css")}}">   
  <link rel="stylesheet" href="{{asset("admin_LTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}">
 
  <link rel="stylesheet" href="{{asset("admin_LTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
 
  <link rel="stylesheet" href="{{asset("admin_LTE/plugins/jqvmap/jqvmap.min.css")}}">
  
  <link rel="stylesheet" href="{{asset("admin_LTE/dist/css/adminlte.min.css")}}">

  <link rel="stylesheet" href="{{asset("admin_LTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
 
  <link rel="stylesheet" href="{{asset("admin_LTE/plugins/daterangepicker/daterangepicker.css")}}">

  <link rel="stylesheet" href="{{asset("admin_LTE/plugins/summernote/summernote-bs4.css")}}">
  
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<div id="app">
<!-- Header -->
    @include('layout.header')

    <!-- Sidebar -->
    @include('layout.sidebar')
	
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">      
		    @yield('content')   
		 </section>
    <!-- /.content -->
  </div>
   @include('layout.footer')
   </div>
   </div>
<!-- ./wrapper -->

<script src="{{ asset ("js/app.js") }}" type="text/javascript"></script>
<!--
<script src="{{asset("admin_LTE/plugins/jquery/jquery.min.js")}}"></script>

<script src="{{asset("admin_LTE/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("plugins/bs-custom-file-input/bs-custom-file-input.min.js")}}"></script>

<script src="{{asset("admin_LTE/dist/js/adminlte.js")}}"></script>
 -->

</body>
</html>
	