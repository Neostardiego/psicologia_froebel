
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow mt-0"> 
                <a class="navbar-brand pl-2 text-primary" href="{{ url('/') }}">
                    {{ config('app.name', 'ApiFox') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto mr-2">
                        <!-- Authentication Links -->
                        @if(auth()->check())
                        <li class="nav-item">
                                <a class="nav-link active" href="{{ url('/dashboard') }}"    ><b>{{ __('INICIO') }}</b></a>
                        </li>
                        @else
                        <li class="nav-item">
                                <a class="nav-link active" href="{{ url('/') }}"    ><b>{{ __('INICIO') }}</b></a>
                        </li>
                        @endif
                        <li class="nav-item">
                                <a class="nav-link text-primary" href="https://docs.google.com/document/d/1Zsp-zEJW_u-Q6Sq8ZIHgus_UlzUIJh6MjFSEekZWzzI/edit" target="_blank"><b>{{ __('DOCUMENTACION') }}</b></a>
                        </li>
                     
                      
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-primary" href="{{ route('login') }}"><b>{{ __('INGRESAR') }}</b></a>
                            </li>
                         
                            <li class="nav-item">
                                    <a class="nav-link text-primary" href="{{ route('register') }}"><b>{{ __('REGISTRARSE') }}</b></a>
                            </li>
                        @else
                        
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <b>{{ Auth::user()->name }}</b> <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
    </nav>
