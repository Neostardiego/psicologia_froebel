
    @php
    $path = explode('/', request()->path());
    $path[1] = (array_key_exists(1, $path)> 0)?$path[1]:'';
    $path[2] = (array_key_exists(2, $path)> 0)?$path[2]:'';
    $path[0] = $path[0];
@endphp
    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="#"><span class="brand-logo">
            <img src="https://image.flaticon.com/icons/png/512/883/883039.png"/>
                  </span>
                <h5 class="brand-text">PSICOLOGIA<br> FROEBEL</h5></a></li>
            <li class="nav-item nav-toggle">
            <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
            <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
            <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
          </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
          <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a></li>
            @if(auth()->check())
           
            <li class="nav-item {{ ($path[0] === 'quotes' ) ? 'active':'' }}">
              <a class="d-flex align-items-center" href="{{route('quotes')}}">
                <i data-feather="settings"></i>
                <span class="menu-title text-truncate" data-i18n="Feather">
                 Citas
                </span>
              </a>
              </li>
          
            @endif
            
             
          </ul>
        </div>
      </div>
      <!-- END: Main Menu-->