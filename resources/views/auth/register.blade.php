<x-guest-layout>
  
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <iframe style="width: 100%;
                height: 300px;
                border: 6px solid #CCCCCC;
                border-radius: 25px;
                margin-top: 80%;" src="https://youtube.com/embed/b6ffAuBYf8g?autoplay=1&controls=1&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>


        <div class="row">
            <main class="form-signin">        
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                {{--  <img class="mb-0" src="{{ asset('assets/img/logo.png') }}" alt="" width="160" height="200"> --}}
                    <h3>Registro de nuevo usuario</h3>

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <!-- Name -->
                    <div class="form-floating mb-3">
                        <input type="nickname" name="nickname" value="{{old('nickname')}}" class="form-control" id="nickname" required autofocus>
                        <label for="nickname">Nickname</label>
                    </div>

                    <!-- Plan -->
                    <div class="form-floating mb-3">
                        <select name="package" class="form-select" id="package">
                            @foreach($packages as $package)
                                <option value="{{ $package->id }}">{{ $package->name }} </option>
                            @endforeach
                        </select>
                        <label for="package">Seleccione un paquete</label>
                    
                    </div>

                    <!-- NickName -->
                    <div class="form-floating mb-3">
                        <input type="nickname_promoter" name="nickname_promoter" value="{{ $promotor }}" class="form-control" id="nickname_promoter" required>
                        <label for="nickname_promoter">Nickname del Promotor (Prometer)</label>
                    </div>

                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" required>
                        <label for="email">Correo Electrónico (email)</label>
                    </div>

                    <!-- Phone -->
                    <div class="form-floating mb-3">
                        <input type="phone" name="phone" value="{{old('phone')}}" class="form-control" id="phone" required>
                        <label for="phone">Teléfono</label>
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="password" required>
                        <label for="password">Contraseña</label>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-floating mb-3">
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                        <label for="password_confirmation">Confirme Contraseña</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn-block btn btn-lg btn-primary" type="submit">Registrar</button>
                        <a href="{{route('login')}}">O si ya tienes una cuenta da clic aqui</a>
                    </div>

                </form>
            
            </main>

        </div>
    </div>
</x-guest-layout>
