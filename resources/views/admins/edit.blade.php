@extends('layouts.main', ['activePage' => 'admins', 'title' => __(''), 'titlePage' => 'Administradores'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title text-white"><b>Editar Administrador</b></h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admins.update', $admin) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- EMAIL --}}
                    <x-inputs.text-field-row
                        name="email"
                        label="Correo Electrónico:"
                        placeholder="Ingresé el Correo Electrónico"
                        :default-value="$admin->user->email"
                    />

                    {{-- FIRST NAME --}}
                    <x-inputs.text-field-row
                        name="first_name"
                        label="Nombre(s):"
                        placeholder="Ingresé los Nombres"
                        :default-value="$admin->first_name"
                    />

                    {{-- LAST NAME --}}
                    <x-inputs.text-field-row
                        name="last_name"
                        label="Apellidos:"
                        placeholder="Ingresé los Apellidos"
                        :default-value="$admin->last_name"
                    />

                    <div class="text-right">
                        <a href="{{ route('admins.index') }}" class="btn  btn-warning mr-3">
                            <i class="material-icons">cancel</i><b> Cancelar</b> </a>
                        <button class="btn  btn-success"><i class="material-icons">save</i><b> Guardar</b></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title text-white"><b> Cambiar Contraseña</b></h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admins.updatePassword', $admin) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- PASSWORD --}}
                    <x-inputs.text-field-row
                        name="password"
                        label="Contraseña Nueva:"
                        placeholder="Ingresé la Contraseña Nueva"
                        type="password"
                    />
                    {{-- CONFIRM PASSWORD --}}
                    <x-inputs.text-field-row
                        name="password_confirmation"
                        label="Confirmar Contraseña:"
                        placeholder="Confirme la Contraseña Nueva"
                        type="password"
                    />
                    <div class="text-right">
                        <a href="{{ route('admins.index') }}" class="btn  btn-warning mr-3">
                            <i class="material-icons">cancel</i><b> Cancelar</b> </a>
                        <button class="btn  btn-success"><i class="material-icons">save</i><b> Guardar</b></button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
