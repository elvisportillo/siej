 
@guest
@if (Route::has('login'))
    
@endif

@else
    <div id="app">

    <nav class="navbar navbar-expand-md sticky-top navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/cnj.png') }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto">
                    
                    @can('mostrar-usuarios')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('usuarios.index')}}">Usuarios</a>
                    </li>
                    @endcan

                    @can('mostrar-rol')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('roles.index')}}">Roles</a>
                    </li>
                    @endcan

                    
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">Informes de Gestion</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('informes-de-gestion')}}">Ingresar Informes de Gestión</a></li>
                            <li><a class="dropdown-item" href="{{route('mostrar-informes-de-gestion')}}">Buscar Informes de Gestión</a></li>
                        </ul>
                        
                    </li>
                  
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{auth()->user()->name}}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ url('change_password_form') }}">Cambiar Contrasena</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Cerrar Sesión') }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>  
                                </div>   

                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endguest