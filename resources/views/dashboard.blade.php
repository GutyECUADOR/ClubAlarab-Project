<x-app-layout>
    <x-navbar-menu></x-navbar-menu>
    
    <div class="container-fluid">
      <div class="row">
        <x-sidebar-menu></x-sidebar-menu>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h3">Datos Personales</h3>
            <div class="btn-toolbar mb-2 mb-md-0">
              <button type="button" class="btn btn-sm btn-primary">
                <span data-feather="upload"></span>
                Cargar Comprobante
              </button>
            </div>
          </div>

          <div class="container text-center">
            <div class="row mb-3">
              <div class="col">
                <div class="card">
                  <div class="card-header">
                    Plan: 
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">NickName: {{ Str::title(Auth::user()->nickname) }}</h5>
                    <p class="card-text">Esta Activo: {{ Auth::user()->EstadoPago }}</p>
                    <p class="card-text">Cantidad Invitados: {{ Auth::user()->CantidadInvitadosPagados->count() }}</p>
                    <p class="card-text">Inversión total de Invitados: $ {{ Auth::user()->CantidadInvesionPagada }}</p>
                    <p class="card-text">Comisión 20% ganada.</p>
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="card">
                  <div class="card-header">
                    Equipo 1
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="card">
                  <div class="card-header">
                    Equipo 2
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>

          
        </main>
      </div>
    </div>
</x-app-layout>
