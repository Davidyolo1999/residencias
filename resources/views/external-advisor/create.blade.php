@extends('layouts.main', ['activePage' => 'external-advisor', 'title' => __(''), 'titlePage' => 'Asesor Externo'])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title text-white"><b>Añadir Asesor Externo</b> </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('externalAdvisor.store') }}" method="POST">
                    @csrf

                    {{-- EMAIL --}}
                    <x-inputs.text-field-row
                        name="email"
                        label="Correo electrónico:"
                        placeholder="Ingresé el Correo Electrónico"
                        autofocus
                    />

                    {{-- FIRST NAME --}}
                    <x-inputs.text-field-row
                        name="first_name"
                        label="Nombre(s):"
                        placeholder="Ingresé el Nombre"
                    />

                    {{-- FATHER'S LAST NAME --}}
                    <x-inputs.text-field-row
                        name="fathers_last_name"
                        label="Apellido Paterno:"
                        placeholder="Ingresé el Apellido Paterno"
                    />

                    {{-- MOTHERS'S LAST NAME --}}
                    <x-inputs.text-field-row
                        name="mothers_last_name"
                        label="Apellido Materno:"
                        placeholder="Ingresé el Apellido Materno"
                    />

                    {{-- CHARGE --}}
                    <x-inputs.text-field-row
                        name="charge"
                        label="Cargo:"
                        placeholder="Ingresé el Cargo"
                    />

                    {{-- CAREER --}}
                    <x-inputs.text-field-row
                        name="career"
                        label="Carrera:"
                        placeholder="Ingresé la Carrera"
                    />

                    {{-- SEX --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="sex" class="d-block letter text-dark">Sexo:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <select
                                    class="form-control"
                                    name="sex"
                                    id="sex"
                                >
                                    <option value="" selected disabled>Seleccione una Opción</option>
                                    <option value="m" @if (old('sex') == 'm') selected @endif>Masculino</option>
                                    <option value="f" @if (old('sex') == 'f') selected @endif>Femenino</option>
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
                    />

                    {{-- PHONE NUMBER --}}
                    <x-inputs.text-field-row
                        name="phone_number"
                        label="Teléfono"
                        placeholder="Ingresé Número de Teléfono"
                    />

                    {{-- State --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="state_id" class="d-block letter text-dark">Estado:</label>
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
                                        <option value="{{ $state->id }}" @if ($state->id == old('state_id')) selected @endif>{{ $state->name }}</option>
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
                            <label for="municipality_id" class="d-block letter text-dark">Municipio:</label>
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
                            <label for="locality_id" class="d-block letter text-dark">Localidad:</label>
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

                    {{-- PASSWORD --}}
                    <x-inputs.text-field-row
                        name="password"
                        label="Contraseña:"
                        placeholder="Ingresé la Contraseña"
                        type="password"
                    />


                    {{-- PASSWORD CONFIRMATION --}}
                    <x-inputs.text-field-row
                        name="password_confirmation"
                        label="Confirmar Contraseña:"
                        placeholder="Confirmación de Contraseña"
                        type="password"
                    />

                    <div class="text-right">
                        <a href="{{ route('externalAdvisor.index') }}" class="btn btn-sm btn-warning mr-3">
                            <i class="material-icons">cancel</i><b> Cancelar</b> </a>
                        <button class="btn btn-sm btn-success"><i class="material-icons">save</i><b> Guardar</b></button>
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
                .map((municipality) => `<option value="${municipality.id}" ${municipality.id == @json(old('municipality_id')) ? 'selected' : ''}>${municipality.name}</option>`)
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
                .map((locality) => `<option value="${locality.id}" ${locality.id == @json(old('locality_id')) ? 'selected' : ''}>${locality.name}</option>`)
                .join('');

            $('#locality_id').html(`
                <option value="" selected disabled>Seleccione una opción</option>
                ${localities}
            `);
        }).trigger('change');
    });
</script>
@endpush
