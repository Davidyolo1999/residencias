@extends('layouts.main', ['activePage' => 'admins', 'titlePage' => 'Admins'])

@section('content')
    <div class="container" style="height: auto;">
        <div class="row align-items-center">
            <div class="col-md-9 ml-auto mr-auto mb-3 text-center">
                <h3 style="font-weight: bold;">{{ __('Sistema Control de Residencias Profesionales') }} </h3>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div style="opacity: .9;" class="card card-login card-hidden mb-3">
                    
                        <div class="card-body  text-center">

                            <h2 style="font-weight: bold;" class="text-warning mb-2 text-uppercase">Bienvenido</h2>
                            <div class="col-md-9 ml-auto mr-auto text-center" align="center">
                                <img src="{{ asset('img/logo2.png') }}" alt="umb_logo" height="95" width="180">
                            </div>
                            <p class="card-description text-center text-danger"><b>
                                    {{ __('Ingresé sus credenciales ') }}</b></p>
                            {{-- Email --}}
                            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group has-warning">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">email</i>
                                        </span>
                                    </div>
                                    <input type="text" name="email" class="form-control"
                                        placeholder="{{ __('Correo...') }}" value="{{ old('email', null) }}" required
                                        autocomplete="username" autofocus>
                                </div>
                                @if ($errors->has('email'))
                                    <div id="username-error" class="error text-danger pl-3 text-center" for="email"
                                        style="display: block;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                                <div class="input-group has-warning">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="{{ __('Contraseña...') }}" required autocomplete="current-password">
                                </div>
                                @if ($errors->has('password'))
                                    <div id="password-error" class="error text-danger  text-center" for="password"
                                        style="display: block;">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class=" bmd-form-group text-right mt-3 mb-3 px-3">
                            <button type="submit"
                                class="btn btn-danger animation-on-hover btn-round text-white">{{ __('Iniciar Sesión') }} <i
                                    class="material-icons">login</i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
