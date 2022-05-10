@extends('layouts.main', ['activePage' => 'configurations', 'title' => __(''), 'titlePage' => 'Información de la Unidad'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-success">
                <h3 class="card-title text-white"><b> Información de la Unidad </b></h3>
            </div>
            <div class="card-body">
                <form action="{{ route('configurations.updateUnitInfo') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- UNIT --}}
                    <x-inputs.text-field-row name="unit" label="Unidad de Estudios:" placeholder="Ingresé la Unidad" :default-value="$configuration->unit" />

                    {{-- ADDRESS --}}

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="address" class="d-block">Dirección:</label>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group input-group-dynamic has-warning">
                                    <textarea class="form-control text-justify" name="address" placeholder="Ingresé la Direccion" id="address"
                                        rows="3">{{ old('address', $configuration->address) }}</textarea>
                                </div>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    {{-- PERSON NAME IN CHARGE --}}
                    <x-inputs.text-field-row name="person_in_charge" label="Encargado:" placeholder="Ingresé la Persona Encargada"  :default-value="$configuration->person_in_charge" />
                    
                        {{-- PERSON NAME IN CHARGE POSITION --}}
                    <x-inputs.text-field-row name="person_in_charge_position" label="Cargo:" placeholder="Ingresé el Cargo"  :default-value="$configuration->person_in_charge_position" />

                    {{-- PERSON IN CHARGE POSITION ABBREVIATION --}}
                    <x-inputs.text-field-row name="person_in_charge_position_abbreviation" label="Cargo Abreviado:" placeholder="Ingresé el Cargo Abreviado"  :default-value="$configuration->person_in_charge_position_abbreviation" />

                    {{-- E-MAIL --}}
                    <x-inputs.text-field-row name="email" label="E-mail:" type="email" placeholder="Ingresé el E-mail" :default-value="$configuration->email" />

                    {{-- OFFICE PHONE NUMBER --}}
                    <x-inputs.text-field-row name="office_phone_number" label="Teléfono Oficina:" placeholder="Ingresé el Teléfono Oficina"  :default-value="$configuration->office_phone_number" />

                    {{-- PERSONAL PHONE NUMBER --}}
                    <x-inputs.text-field-row name="personal_phone_number" label="Teléfono Celular:" placeholder="Ingresé el Teléfono Celular"  :default-value="$configuration->personal_phone_number" />

                    {{-- INSTITUTION CODE --}}
                    <x-inputs.text-field-row name="institution_code" label="Clave de Institución:" placeholder="Ingresé la Clave de Institución"  :default-value="$configuration->institution_code" />

                    <div class="text-right">
                        <button class="btn  btn-success"><i class="material-icons">save</i><b> Guardar</b></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
