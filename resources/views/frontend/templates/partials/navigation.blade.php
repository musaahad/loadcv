<div class="navbar-fixed">
<nav>
    <div class="nav-wrapper">
      <a href="{{route('homepage')}}" class="brand-logo"> {{ $title ?? 'Load CV Daily Web'}}</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      
      
      <ul class="right hide-on-med-and-down">
      @guest
        <li><a href="{{route('login')}}">Login</a></li>
        <li><a href="{{route('register')}}">Register</a></li>
      @else
        <ul id="dropdown1" class="dropdown-content">
          <li><a href="{{route('kerjareview.datanilai')}}">Review LPA</a></li>
          <li class="divider"></li>
          <li><a href="{{route('kerjainternal.datanilai')}}">Penilaian Internal</a></li>
          <li class="divider"></li>
          <li><a href="{{route('datapasar.index')}}">Pembanding</a></li>
        </ul>

        <ul id="dropdown2" class="dropdown-content">
        <li><a href="{{route('kerjareview.index')}}">Review LPA</a></li>
          <li class="divider"></li>
        <li><a href="{{route('kerjainternal.index')}}">Internal</a></li>
          <li class="divider"></li>
        <li><a href="{{route('kerjaflpp.index')}}">FLPP</a></li>
          <li class="divider"></li>
        <li><a href="#">Vercall</a></li>
        </ul>
        
        <ul class="right hide-on-med-and-down">
          <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">Kerjakan<i class="material-icons right">expand_more</i></a></li>
          <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Database<i class="material-icons right">expand_more</i></a></li>
         
          
          <li><a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
                </a>
          </li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" 
                method="POST" style="display: none;">@csrf
        </form>
      @endguest
      </ul>
    </div>
</nav>
</div>
  <ul class="sidenav" id="mobile-demo">
  @guest
    <li><a href="{{route('login')}}">Login</a></li>
    <li><a href="{{route('register')}}">Register</a></li>
  @else
  <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
      {{ __('Logout') }}</a>
  </li>
  @endguest
  </ul>

<form id="logout-form" action="{{ route('logout') }}" 
      method="POST" style="display: none;">@csrf
</form>