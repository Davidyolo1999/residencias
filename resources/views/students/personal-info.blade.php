@extends('layouts.main', ['activePage' => 'profile', 'title' => __(''), 'titlePage' => 'Estudiantes'])

@section('content')
    <div class="content">

    <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if ($alert = session('alert'))
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="alert alert-{{ $alert['type'] }}" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">close</i>
                                    </button>
                                    <span>{{ $alert['message'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

        <div class="card">
            <div class="card-header card-header-success">
                <h3 class="card-title text-white"><b> Información Personal</b></h3>
            </div>
            <div class="card-body">
                <form action="{{ route('students.updatePersonalInfo') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        {{-- CURP --}}
                        <div class="col-md-12">
                            <p class="mb-0"><b>CURP:</b></p>
                            {{ $user->student->curp }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        {{-- NAMES --}}
                        <div class="col-md-4">
                            <p class="mb-0"><b>Nombre(s):</b></p>
                            {{ $user->student->first_name }}
                        </div>
                        {{-- FATHER'S LAST NAME --}}
                        <div class="col-md-4">
                            <p class="mb-0"><b>Apellido Paterno:</b></p>
                            {{ $user->student->fathers_last_name }}
                        </div>
                        {{-- MOTHERS'S LAST NAME --}}
                        <div class="col-md-4">
                            <p class="mb-0"><b>Apellido Materno:</b></p>
                            {{ $user->student->mothers_last_name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        {{-- SEX --}}
                        <div class="col-md-4">
                            <p class="mb-0"><b>Sexo:</b></p>
                            {{ $user->student->sex_text }}
                        </div>
                        {{-- CAREER --}}
                        <div class="col-md-4">
                            <p class="mb-0"><b>Carrera:</b></p>
                            {{ $user->student->career->name }}
                        </div>
                        {{-- ACCOUNT NUMBER --}}
                        <div class="col-md-4">
                            <p class="mb-0"><b>Número de Cuenta:</b></p>
                            {{ $user->student->account_number }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        {{-- IS ENROLLED --}}
                        <div class="col-md-4">
                            <p class="mb-0"><b>Inscrito:</b></p>
                            {{ $user->student->is_enrolled ? 'Si' : 'No' }}
                        </div>
                        {{-- IS SOCIAL SERVICE CONCLUDED --}}
                        <div class="col-md-4">
                            <p class="mb-0"><b>Servicio Social Concluido:</b></p>
                            {{ $user->student->is_social_service_concluded ? 'Si' : 'No' }}
                        </div>
                        {{-- CAREER PERCENTAGE --}}
                        <div class="col-md-4">
                            <p class="mb-0"><b>Porcentaje de la Carrera:</b></p>
                            {{ $user->student->career_percentage }}%
                        </div>
                    </div>

                    <div class="row mb-3">
                        {{-- STATE --}}
                        <div class="col-md-4">
                            <p class="mb-0"><b>Estado:</b></p>
                            <select class="form-control" name="state_id" id="state_id">
                                <option value="" selected disabled>Seleccione una Opción</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}" @if ($state->id == old('state_id', $user->student->state->id)) selected @endif>{{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('state_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- MUNICIPALITY --}}
                        <div class="col-md-4">
                            <p class="mb-0"><b>Municipio:</b></p>
                            <select class="form-control" name="municipality_id" id="municipality_id">
                                <option value="" selected disabled>Seleccione una Opción</option>
                            </select>
                            @error('municipality_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- LOCALITY --}}
                        <div class="col-md-4">
                            <p class="mb-0"><b>Localidad:</b></p>
                            <select class="form-control" name="locality_id" id="locality_id">
                                <option value="" selected disabled>Seleccione una Opción</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        {{-- PHONE NUMBER --}}
                        <div class="col-md-4 has-warning">
                            <p class="mb-0"><b>Teléfono:</b></p>
                            <input type="text" class="form-control" name="phone_number"
                                value="{{ $user->student->phone_number }}">
                        </div>
                    </div>

                    <div class="text-right">
                        <button class="btn  btn-success"><i class="material-icons">save</i><b> Guardar</b></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                    .map((municipality) =>
                        `<option value="${municipality.id}" ${municipality.id == @json(old('municipality_id', $user->student->municipality->id)) ? 'selected' : ''}>${municipality.name}</option>`
                        )
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

                const municipality = state.locations.find((municipality) => municipality.id ===
                    municipalityId);

                if (!municipality) return;

                const localities = municipality
                    .locations
                    .map((locality) =>
                        `<option value="${locality.id}" ${locality.id == @json(old('locality_id', $user->student->locality->id)) ? 'selected' : ''}>${locality.name}</option>`
                        )
                    .join('');

                $('#locality_id').html(`
                    <option value="" selected disabled>Seleccione una opción</option>
                    ${localities}
                `);
            }).trigger('change');
        });
    </script>
@endpush
