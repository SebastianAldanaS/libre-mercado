<x-app>
    {{-- A Book --}}

    <section class="d-flex justify-content-center flex-wrap">
        @foreach ($products as $product)
            <div class="card mx-3 my-3" style="width: 18rem;">
                <img src="https://http2.mlstatic.com/D_NQ_NP_854874-MCO45857546559_052021-O.jpg" class="card-img-top"
                    alt="Producto">
                <div class="card-body">
                    <h5 class="card-title"><b>{{ $product->name }}</b></h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text"><b> $ {{ $product->price }}</b></p>

                    <a href="#" class="btn btn-primary ">Añadir a Carrito</a>
                </div>
            </div>
        @endforeach

    </section>
</x-app>
