@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Nombre -->
                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="nombre"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Poner E-mail -->
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Poner password -->
                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirmar password -->
                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <!-- Sector donde trabaja -->
                            <div class="form-group row">
                                <label for="sector_donde_trabaja"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Sector donde trabaja') }}</label>

                                <div class="col-md-6">
                                    <select name="sector_donde_trabaja" type="text" class="form-control">
                                        <option value="S-1">S-1</option>
                                        <option value="S-2">S-2</option>
                                        <option value="S-3">S-3</option>
                                        <option value="A-1">A-1</option>
                                        <option value="A-2">A-2</option>
                                        <option value="A-3">A-3</option>
                                        <option value="Z-1">Z-1</option>
                                        <option value="Z-2">Z-2</option>
                                        <option value="Z-3">Z-3</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Subir foto -->
                           <div>
                               <input type="file" name="url_foto">
                           </div>

                            <!-- Registro normal -->
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>

                            <!-- Registrar con google -->
                            <a href="{{ url('auth/google') }}" class="btn btn-lg btn-success btn-block mt-3 disabled">
                                <strong>Registrarse Con Google</strong>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
