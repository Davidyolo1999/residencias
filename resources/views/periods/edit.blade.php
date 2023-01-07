@extends('layouts.main', ['activePage' => 'periods', 'title' => __(''), 'titlePage' => 'Editar Periodo'])

@section('content')
    <div class="content">
        @if ($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title text-white"><b>Editar Periodo</b> </h4>
            </div>

            <div class="card-body">
                <form action="{{ route('periods.update', $period) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        {{-- FIRST NAME --}}
                        <div class="form-group col-md-4 has-warning mb-3">
                            <div class="mb-0">
                                <label for="name" class="d-block text-dark letter">Nombre del
                                    Periodo:</label>
                            </div>
                            <input type="text" class="form-control text-center" name="name" id="name"
                            value="{{ old('name', $period->name) }}"
                                placeholder="Ingresé el nombre.">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- START --}}
                        <div class="form-group col-md-4 has-warning mb-3">
                            <div class="mb-0">
                                <label for="start" class="d-block text-dark letter">Inicia:</label>
                            </div>
                            <input type="date" class="form-control text-center" name="start" id="start"
                            value="{{ old('start', optional($period->start)->format('Y-m-d')) }}"
                                placeholder="Ingresé el nombre.">
                            @error('start')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- END --}}
                        <div class="form-group col-md-4 has-warning mb-3">
                            <div class="mb-0">
                                <label for="end" class="d-block text-dark letter">Finaliza:</label>
                            </div>
                            <input type="date" class="form-control text-center" name="end" id="end"
                            value="{{ old('end', optional($period->end)->format('Y-m-d')) }}"                                placeholder="Ingresé el nombre.">
                            @error('end')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- UNIT --}}
                    <div class="form-group  has-warning mb-3">
                        <div class="mb-0">
                            <label for="unit" class="d-block text-dark letter">Unidad de Estudios:</label>

                        </div>
                        <input type="text" class="form-control" name="unit" id="unit"
                            value="{{ old('unit', $period->unit) }}"
                            placeholder="Ingresé nombre de la unidad de estudios">
                        @error('unit')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- ADDRESS --}}
                    <div class="form-group  has-warning mb-3">
                        <div class="mb-0">
                            <label for="address" class="d-block text-dark letter">Dirección:</label>

                        </div>
                        <div class="input-group input-group-dynamic has-warning">
                            <textarea class="form-control text-justify" name="address" placeholder="Ingresé la Dirección" id="address"
                                rows="2">{{ old('address', $period->address) }}</textarea>
                        </div>
                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-row">
                        {{-- PERSON NAME IN CHARGE --}}
                        <div class="form-group col-md-6 has-warning">
                            <div class="mb-0">
                                <label for="person_in_charge" class="d-block text-dark letter">Encargado:</label>
                            </div>
                            <input type="text" class="form-control text-center" name="person_in_charge"
                                id="person_in_charge" placeholder="Ingresé la Persona Encargada"
                                value="{{ old('person_in_charge', $period->person_in_charge) }}">
                            @error('person_in_charge')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- PERSON IN CHARGE POSITION --}}
                        <div class="form-group col-md-6 has-warning">
                            <div class="mb-0">
                                <label for="person_in_charge_position" class="d-block text-dark letter">Cargo:</label>
                            </div>
                            <input type="text" class="form-control text-center" name="person_in_charge_position"
                                id="person_in_charge_position" placeholder="Ingresé el Cargo"
                                value="{{ old('person_in_charge_position', $period->person_in_charge_position) }}">
                            @error('person_in_charge_position')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- PERSON IN CHARGE POSITION ABBREVIATION --}}
                    <div class="form-row">
                        <div class="form-group col-md-6 has-warning">
                            <div class="mb-0">
                                <label for="person_in_charge_position_abbreviation" class="d-block text-dark letter">Cargo
                                    Abreviado:</label>
                            </div>
                            <input type="text" class="form-control text-center"
                                name="person_in_charge_position_abbreviation" id="person_in_charge_position_abbreviation"
                                placeholder="Ingresé el Cargo Abreviado"
                                value="{{ old('person_in_charge_position_abbreviation', $period->person_in_charge_position_abbreviation) }}">
                            @error('person_in_charge_position_abbreviation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- E-MAIL --}}
                        <div class="form-group col-md-4 has-warning">
                            <div class="mb-0">
                                <label for="email" class="d-block text-dark letter">E-mail:</label>
                            </div>
                            <input type="email" class="form-control text-center" name="email" id="email"
                                placeholder="Ingresé el E-mail" value="{{ old('email', $period->email) }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 has-warning mb-3">
                            <div class="mb-0">
                                <label for="office_phone_number" class="d-block text-dark letter">Teléfono Oficina:</label>
                            </div>
                            <input type="text" class="form-control text-center" name="office_phone_number"
                                id="office_phone_number" placeholder="Ingresé el Teléfono Oficina"
                                value="{{ old('office_phone_number', $period->office_phone_number) }}">
                            @error('office_phone_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- PERSONAL PHONE NUMBER --}}
                        <div class="form-group col-md-4 has-warning ml-auto">
                            <div class="mb-0">
                                <label for="personal_phone_number" class="d-block text-dark letter">Teléfono
                                    Celular:</label>
                            </div>
                            <input type="text" class="form-control text-center" name="personal_phone_number"
                                id="personal_phone_number" placeholder="Ingresé el Teléfono Celular"
                                value="{{ old('personal_phone_number', $period->personal_phone_number) }}">
                            @error('personal_phone_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- INSTITUTION CODE --}}
                        <div class="form-group col-md-4 has-warning ml-auto">
                            <div class="mb-0">
                                <label for="institution_code" class="d-block text-dark letter">Clave de
                                    Institución:</label>
                            </div>
                            <input type="text" class="form-control text-center" name="institution_code"
                                id="institution_code" placeholder="Ingresé la Clave de Institución"
                                value="{{ old('institution_code', $period->institution_code) }}">
                            @error('institution_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="float-right">
                        <a href="{{ route('periods.index') }}" class="btn btn-sm btn-warning mr-3">
                            <i class="material-icons">cancel</i>
                            <b> Cancelar</b>
                        </a>
                        <button class="btn  btn-success btn-sm">
                            <i class="material-icons">save</i>
                            <b> Guardar</b>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
