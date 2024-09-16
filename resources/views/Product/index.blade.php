<x-app>
    @auth
        <section class="container">
            <product-detail :user-id="{{ auth()->user()->id }}" />
        </section>
    @else
        <div class="text-center my-5">
            <p>Debes iniciar sesión para ver el detalle del producto. O Registrate</p>
            <a href="{{ route('login') }}" class="btn btn-primary me-2">Iniciar sesión</a>
            <a href="{{ route('registro') }}" class="btn btn-primary me-2">Registarse</a>
        </div>
    @endauth
</x-app>
