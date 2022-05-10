@extends('layouts.main', ['activePage' => 'teachers', 'title' => __(''), 'titlePage' => 'Profesores'])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title text-white"><b>Editar Profesor</b> </h4>
            </div>

            <div class="card-body">
                <form action="{{ route('teachers.update', $teacher)}}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- EMAIL --}}
                    <x-inputs.text-field-row
                        name="email"
                        label="Correo Electrónico:"
                        placeholder="Ingresé el Correo Electrónico"
                        autofocus
                        :default-value="$teacher->user->email"
                    />

                    {{-- FIRST NAME --}}
                    <x-inputs.text-field-row
                        name="first_name"
                        label="Nombre(s):"
                        placeholder="Ingresé el Nombre"
                        :default-value="$teacher->first_name"
                    />

                    {{-- FATHER'S LAST NAME --}}
                    <x-inputs.text-field-row
                        name="fathers_last_name"
                        label="Apellido Paterno:"
                        placeholder="Ingresé el Apellido Paterno"
                        :default-value="$teacher->fathers_last_name"
                    />

                    {{-- MOTHERS'S LAST NAME --}}
                    <x-inputs.text-field-row
                        name="mothers_last_name"
                        label="Apellido Materno:"
                        placeholder="Ingresé el Apellido Materno"
                        :default-value="$teacher->mothers_last_name"
                    />

                    {{-- SEX --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="sex" class="d-block">Sexo:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <select
                                    class="form-control"
                                    name="sex"
                                    id="sex"
                                >
                                    <option value="" selected disabled>Seleccione una Opción</option>
                                    <option value="m" @if (old('sex', $teacher->sex) == 'm') selected @endif>Masculino</option>
                                    <option value="f" @if (old('sex', $teacher->sex) == 'f') selected @endif>Femenino</option>
                                </select>
                            </div>
                            @error('sex')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- CURP --}}
                    <x-inputs.text-field-row
                        name="curp"
                        label="CURP:"
                        placeholder="Ingresé el Curp"
                        :default-value="$teacher->curp"
                    />

                    {{-- PHONE NUMBER --}}
                    <x-inputs.text-field-row
                        name="phone_number"
                        label="Teléfono:"
                        placeholder="Ingresé Número de Teléfono"
                        :default-value="$teacher->phone_number"
                    />

                    {{-- State --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="state_id" class="d-block">Estado:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <select
                                    class="form-control"
                                    name="state_id"
                                    id="state_id"
                                >
                                    <option value="" selected disabled>Seleccione una Opción</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" @if ($state->id == old('state_id', $teacher->state_id)) selected @endif>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('state_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- MUNCIPALITY --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="municipality_id" class="d-block">Municipio:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <select
                                    class="form-control"
                                    name="municipality_id"
                                    id="municipality_id"
                                >
                                    <option value="" selected disabled>Seleccione una Opción</option>
                                </select>
                            </div>
                            @error('municipality_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- LOCALITY --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="locality_id" class="d-block">Localidad:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <select
                                    class="form-control"
                                    name="locality_id"
                                    id="locality_id"
                                >
                                    <option value="" selected disabled>Seleccione una Opción</option>
                                </select>
                            </div>
                            @error('locality_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
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
                <h4 class="card-title text-white"><b>Cambiar Contraseña</b></h4>
            </div>
            <div class="card-body">
                <form action="{{ route('teachers.updatePassword', $teacher) }}" method="POST">
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

@push('js')
<script>
    const states = @json($states);

    $(() => {
        $('#state_id').change((e) => {
            const stateId = Number(e.target.value);
            const state = states.find((state) => state.id === stateId);

            if (!state) return;

            const municipalities = state
                .locations
                .map((municipality) => `<option value="${municipality.id}" ${municipality.id == @json(old('municipality_id', $teacher->municipality_id)) ? 'selected' : ''}>${municipality.name}</option>`)
                .join('');

            $('#municipality_id').html(`
                <option value="" selected disabled>Seleccione una opción</option>
                ${municipalities}
            `);
        }).trigger('change');

        $('#municipality_id').change((e) => {
            const stateId = Number($('#state_id').val());
            const municipalityId = Number(e.target.value);
            const state = states.find((state) => state.id === stateId);

            if (!state) return;

            const municipality = state.locations.find((municipality) => municipality.id === municipalityId);

            if (!municipality) return;

            const localities = municipality
                .locations
                .map((locality) => `<option value="${locality.id}" ${locality.id == @json(old('locality_id', $teacher->locality_id)) ? 'selected' : ''}>${locality.name}</option>`)
                .join('');

            $('#locality_id').html(`
                <option value="" selected disabled>Seleccione una opción</option>
                ${localities}
            `);
        }).trigger('change');
    });
</script>
@endpush

