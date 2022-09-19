@extends('layouts.main', ['activePage' => 'admins', 'title' => __(''), 'titlePage' => 'Administradores'])

@section('content')
    <div class="content">
        @if ($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title text-white"><b>Añadir Administrador</b> </h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admins.store') }}" method="POST">
                    @csrf
                    {{-- EMAIL --}}
                    <x-inputs.text-field-row name="email" label="Correo Electrónico:"
                        placeholder="Ingresé el Correo Electrónico" />

                    {{-- FIRST NAME --}}
                    <x-inputs.text-field-row name="first_name" label="Nombre(s):" placeholder="Ingresé los Nombre(s)" />

                    {{-- LAST NAME --}}
                    <x-inputs.text-field-row name="last_name" label="Apellidos:" placeholder="Ingresé los Apellidos" />

                    {{-- PASSWORD --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="password" class="d-block letter text-dark">Contraseña:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic has-warning">
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Ingresé la Contraseña">
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- PASSWORD CONFIRMATION --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="password_confirmation" class="d-block letter text-dark">Confirmar Contraseña:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic has-warning">
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="password_confirmation" placeholder="Confirmación de Contraseña">
                            </div>
                        </div>
                    </div>
                        <div class="float-right">
                            <a href="{{ route('admins.index') }}" class="btn btn-sm btn-warning mr-3">
                                <i class="material-icons">cancel</i><b> Cancelar</b> </a>
                            <button class="btn  btn-success btn-sm"><i class="material-icons">save</i><b> Guardar</b></button>
                        </div>

                </form>
            </div>
        </div>
    </div>
@endsection
