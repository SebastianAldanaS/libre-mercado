{{-- Menu --}}
<nav class="navbar navbar-expand-md navbar-light bg-primary  shadow-sm">
    <div class="container">
        <nav class="navbar navbar-light ">
            <div>
                <a>
                    <img src="https://st4.depositphotos.com/1004996/23226/v/600/depositphotos_232261456-stock-illustration-two-fists-bumping-together-vector.jpg"
                        width="60" height="50">
                </a>
            </div>
        </nav>
        <a class="navbar-brand mx-3" href="{{ url('/') }}">
            <strong style="color: yellow;">Libre Mercado</strong>
        </a>


        {{-- Hamburguesa --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registro</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->full_name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            {{-- Menu Admin --}}
                            @role('admin')
                                {{-- Menu Admin --}}
                                <a class="dropdown-item" href="{{ route('users') }}">
                                    Usuarios
                                </a>

                                {{-- Productos --}}
                                <a class="dropdown-item" href="{{ route('products') }}">
                                    Productos
                                </a>
                            @endrole
                            {{-- Categorias --}}
                            <a class="dropdown-item" href="{{ route('categories') }}">
                                Categorias
                            </a>

                            {{-- Logout --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
										   document.getElementById('logout-form').submit();">
                                Salir
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>



                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
