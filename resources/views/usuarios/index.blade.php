<x-app-layout>
    <x-navbar-menu></x-navbar-menu>
    
    <div class="container-fluid">
      <div class="row">
        <x-sidebar-menu></x-sidebar-menu>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Lista de Clientes</h1>
          </div>

          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Tasa</th>
                  <th scope="col">Dias</th>
                  <th scope="col">Monto</th>
                  <th scope="col">A Recibir</th>
                  <th scope="col">Fecha Inversion</th>
                  <th scope="col">Fecha Pago</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Recibo</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->nickname }}</td>
                  
                    <td><a class="btn btn-success btn-sm" href="{{ asset('/storage/recibos/'.$user->imagen_recibo) }}" download target="_blank">
                      <span data-feather="download"></span> Descargar</a>
                    </td>
                    <td>
                      <a href="{{ route('register.edit', $user)}}" class="btn btn-sm btn-primary">
                        <span data-feather="edit"></span>
                        Editar
                    </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
</x-app-layout>
