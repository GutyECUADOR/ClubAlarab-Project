<x-app-layout>
    <x-navbar-menu></x-navbar-menu>
    
    <div class="container-fluid">
      <div class="row">
        <x-sidebar-menu></x-sidebar-menu>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h3">Datos Personales</h3>
           
          </div>

          <div class="container text-center">
            <div class="row mb-3">
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header fw-bold">
                    Datos de la cuenta 
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">NickName: {{ Str::title(Auth::user()->nickname) }}</h5>
                    <p class="card-text">Esta Activo: {{ Auth::user()->EstadoPago }}</p>
                    <p class="card-text">Cantidad Invitados: {{ Auth::user()->CantidadInvitadosPagados->count() }}</p>
                    <p class="card-text">Inversión total de Invitados: $ {{ Auth::user()->CantidadInvesionPagada }}</p>
                    <p class="card-text">Comisión 20% ganada: $ {{ Auth::user()->ComisionGanada }}</p>
                    
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card">
                  <div class="card-header fw-bold">
                    Comisión Ganada
                  </div>
                  <div class="card-body">
                    <p class="card-text h3 text-success">$ {{ Auth::user()->ComisionGanada }} USDT</p>
                    
                  </div>
                </div>

                <div class="card">
                  <div class="card-header fw-bold">
                    Comprobante
                  </div>
                  <div class="card-body">
                     
                      @if(auth()->user()->imagen_recibo)
                        <a class="btn btn-success btn-sm" href="{{ asset('/storage/recibos/'.auth()->user()->imagen_recibo) }}" download target="_blank">
                        <span data-feather="download"></span> Descargar</a>   
                      @else 
                        <span>Sin Comprobante, carge el comprobante aqui</span>
                      @endif
                  </div>
                   @if(!auth()->user()->imagen_recibo)
                    <div class="card-footer">
                      <form method="POST" enctype="multipart/form-data" action="{{ route('uploadFile') }}">
                        @csrf
                        <input class="form-control form-control-sm" id="imagen_recibo" name="imagen_recibo" type="file" accept="image/*">
                        <button class="btn-block btn btn-sm btn-primary w-100" type="submit">Subir comprobante</button>
                      </form>
                    </div>
                   @endif
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="card">
                  <div class="card-header fw-bold">
                    Equipo 1 - {{ Auth::user()->ListaEquipoA->count() }} invitados
                    <p class="mb-0 text-success">Total Invertido: ${{ Auth::user()->ListaEquipoA->sum('usdt') }}</p>
                  </div>
                  <div class="card-body">
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseEQ1" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Ver detalle
                    </a>
                    <div class="collapse" id="collapseEQ1">
                      <table class="table table-striped table-sm table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Nickname</th>
                            <th scope="col">Inversión</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach (Auth::user()->ListaEquipoA as $user)
                          <tr>
                            <td>{{ $user->nickname }}</td>
                            <td>$ {{ $user->usdt }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col">
                <div class="card">
                  <div class="card-header fw-bold">
                     Equipo 1 - {{ Auth::user()->ListaEquipoB->count() }} invitados
                     <p class="mb-0 text-success">Total Invertido: ${{ Auth::user()->ListaEquipoB->sum('usdt') }}</p>
                  </div>
                  <div class="card-body">
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseEQ2" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Ver detalle
                    </a>
                    <div class="collapse" id="collapseEQ2">
                      <table class="table table-striped table-sm table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Nickname</th>
                            <th scope="col">Inversión</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach (Auth::user()->ListaEquipoB as $user)
                          <tr>
                            <td>{{ $user->nickname }}</td>
                            <td>$ {{ $user->usdt }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          
        </main>
      </div>
    </div>
</x-app-layout>
