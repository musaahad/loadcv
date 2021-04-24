<!DOCTYPE html>
<html>
@include('admin.templates.partials.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  @include('admin.templates.partials.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('admin.templates.partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header " >
      <!---<h1>{{Breadcrumbs::current()->title}}</h1>---->
 
            
            <ol class="breadcrumb float-sm-right">
              {{Breadcrumbs::render()}}
             <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>---->
            </ol>
    </section>
   
    <section class="content">
        @yield('content')
    </section>
  </div>
     
  <!-- /.content-wrapper -->
  
  @include('admin.templates.partials.footer')
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('admin.templates.partials.script')


</body>
</html>
