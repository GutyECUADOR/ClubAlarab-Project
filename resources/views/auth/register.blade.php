<x-guest-layout>
  
    <main class="form-signin">        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <img class="mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
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
                <input type="nickname_promoter" name="nickname_promoter" value="{{old('nickname_promoter')}}" class="form-control" id="nickname_promoter" required>
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
                <input type="text" name="password" class="form-control" id="password" required>
                <label for="password">Contraseña</label>
            </div>

            <!-- Confirm Password -->
            <div class="form-floating mb-3">
                <input type="text" name="password_confirmation" class="form-control" id="password_confirmation" required>
                <label for="password_confirmation">Confirme Contraseña</label>
            </div>

            <div class="d-grid gap-2">
                <button class="btn-block btn btn-lg btn-primary" type="submit">Registrar</button>
            </div>

        </form>
    
    </main>
</x-guest-layout>
