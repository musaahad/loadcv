<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    
    
    
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <div class="navbar-custom menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="" class="dropdown-toggle" data-toggle="dropdown">
            <span class="hidden-xs"><b>Selamat Datang, {{ auth()->user()->panggilan }} {{ auth()->user()->name }}</b> </span>
          </a>
        <ul class="dropdown-menu">
        <div class="">
              <a  href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" 
                  class="btn btn-block btn-default btn-flat"
                  >Sign Out
              </a>
        </div>
        <form id="logout-form" 
           action="{{ route('logout') }}" 
           method="POST" 
           style="display: none;">
           @csrf
      </form>
        </ul>
        </li>
      </ul>
    </div>
     
     
      <!-- Notifications Dropdown Menu -->
    
     <!---- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>--->
    </ul>
  </nav>