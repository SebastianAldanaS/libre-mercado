<x-app>
    <div class="card my-5 mx-5">

        <div class="card-header d-flex justify-content-between">
            <h2>Usuarios</h2>
            <a href="{{ route('user.create') }}" class="btn btn-primary">Crear usuario</a>
        </div>
        <div class="card-body">
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">Documento</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Email</th>
                        <th scope="col">Direccion</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{{ $user->document_id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</x-app>
