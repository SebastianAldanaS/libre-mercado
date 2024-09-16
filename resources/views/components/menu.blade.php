<nav class="navbar navbar-expand-md navbar-light custom-navbar">
    <div class="container">
        <a class="navbar-brand mx-3" href="{{ url('/') }}">
            <img src="https://st4.depositphotos.com/1004996/23226/v/600/depositphotos_232261456-stock-illustration-two-fists-bumping-together-vector.jpg"
                width="60" height="50" alt="Logo" style="border-radius: 50%;">
            <strong class="mx-2" style="color: #c7f0a3; font-style: italic; font-family: 'Pacifico', cursive;">Libre
                Mercado</strong>


        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link"href="{{ route('login') }}">Entrar</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('registro') }}">Registro</a>
                    </li>
                @else
                    @php
                        $currentUserId = auth()->user()->id;
                    @endphp
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->full_name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('carrito') }}">Carrito</a>
                            @role('admin')
                                <a class="dropdown-item" href="{{ route('users') }}">Usuarios</a>
                                <a class="dropdown-item" href="{{ route('products') }}">Productos</a>
                                <a class="dropdown-item" href="{{ route('listcategories') }}">Categorías</a>
                            @endrole
                            <a class="dropdown-item" href="{{ route('categories') }}">Listar Categorías</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
