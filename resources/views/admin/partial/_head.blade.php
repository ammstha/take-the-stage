<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>@yield('title')</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('adminLte/plugins/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('adminLte/https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('adminLte/dist/css/adminlte.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('adminLte/plugins/iCheck/flat/blue.css')}}">
<!-- Morris chart -->
<link rel="stylesheet" href="{{asset('adminLte/plugins/morris/morris.css')}}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{asset('adminLte/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
<!-- Date Picker -->
<link rel="stylesheet" href="{{asset('adminLte/plugins/datepicker/datepicker3.css')}}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{asset('adminLte/plugins/daterangepicker/daterangepicker-bs3.css')}}">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{asset('adminLte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
<!-- Google Font: Source Sans Pro -->
<link href="{{asset('adminLte/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet')}}">

@stack('stylesheets')