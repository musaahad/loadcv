<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="#" class="logo"> -->
     <!--<span class="logo-mini"><b>L</b>CV</span>---->
     <!-- <span class="logo-lg" colour="white"> <b>Load CV</b> Daily</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
  
        <div class="info">
          <a href="#" class="d-block"><b>MENU UTAMA</b></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
 
         
          <li class="nav-item">
            <a href="{{route ('admin.reviews.index')}}" class="nav-link">
            <i class="fab fa-buffer"></i>
              <p>Review LPA</p>
            </a>
            <a href="{{route ('admin.internal.index')}}" class="nav-link">
            <i class="fas fa-search-location"></i>
              <p>Penilaian Internal</p>
            </a>
            <a href="{{route ('admin.vercall.index')}}" class="nav-link">
            <i class="fas fa-phone-alt"></i>
              <p>Verifikasi Progress</p>
            </a>
            <a href="{{route ('admin.flpps.index')}}" class="nav-link">
            <i class="fas fa-store-alt"></i>
              <p>Inspeksi FLPP</p>
            </a>
            <a href="{{route ('admin.developer.index')}}" class="nav-link">
            <i class="fas fa-city"></i>
              <p>Developer</p>
            </a>
            <a href="{{route ('admin.bus.index')}}" class="nav-link">
              <i class="fa fa-users"></i>
              <p>BU</p>
            </a>
            <a href="{{route ('admin.kjpps.index')}}" class="nav-link">
            <i class="fas fa-address-card"></i>
              <p>KJPP</p>
            </a>
            <a href="{{route ('admin.users.index')}}" class="nav-link">
            <i class="fas fa-diagnoses"></i>
              <p>PIC</p>
            </a>
            <a href="{{route ('admin.holidays.index')}}" class="nav-link">
            <i class="fas fa-diagnoses"></i>
              <p>Hari Libur</p>
            </a>
         
          </li>
         
        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>