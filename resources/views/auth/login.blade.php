@extends('layouts.main', ['activePage' => 'admins', 'titlePage' => 'Admins'])

@section('content')
    <div class="container" style="height: auto;">
        <div class="row align-items-center">
            <div class="col-md-9 ml-auto mr-auto mb-3 text-center">
                <h3>{{ __('Sistema Control de Residencias Profesionales') }} </h3>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card card-login card-hidden mb-3">
                        <div class="card-header card-header-success text-center text-white ">
                            <h4>{{ __('B I E N V E N I D O') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-md-9 ml-auto mr-auto mb-2 text-center" align="center">
                                <img src="{{ asset('img/logo2.png') }}" alt="umb" height="95" width="180">
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
                                        placeholder="{{ __('Email...') }}" value="{{ old('email', null) }}" required
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
                                        placeholder="{{ __('Password...') }}" required autocomplete="current-password">
                                </div>
                                @if ($errors->has('password'))
                                    <div id="password-error" class="error text-danger  text-center" for="password"
                                        style="display: block;">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-check mr-auto ml-3 mt-3">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember"
                                        {{ old('remember') ? 'checked' : '' }}> {{ __('Remember me') }}
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit"
                                class="btn btn-danger animation-on-hover btn-round">{{ __('Iniciar Sesión') }} <i
                                    class="material-icons">login</i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
