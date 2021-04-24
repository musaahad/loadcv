<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{$title ?? 'Load CV Daily'}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  
  
  @stack('select2css')
  <!-- css untuk tombol export data -->
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.dataTables.min.css')}}">

  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset ('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  
  <!-- <link rel="stylesheet" href="{{asset ('assets/plugins/jqvmap/jqvmap.min.css')}}">
   Theme style  -->
  <link rel="stylesheet" href="{{asset ('assets/dist/css/adminlte.min.css')}}">
  
  <link rel="stylesheet" href="{{asset ('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  
  <!---<link rel="stylesheet" href="{{ asset ('assets/plugins/daterangepicker/daterangepicker.css')}}">
  
  <link rel="stylesheet" href="{{ asset ('assets/plugins/summernote/summernote-bs4.css')}}"> -->
  
  <link rel="stylesheet" href="{{ asset ('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset ('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{ asset ('assets/plugins/fontgoogle/font.css')}}" rel="stylesheet">

  @stack('styles')
</head>