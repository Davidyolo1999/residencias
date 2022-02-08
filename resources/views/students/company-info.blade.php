@extends('layouts.main', ['activePage' => 'company-info', 'title' => __(''), 'titlePage' => 'Información de la Empresa'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-success">
                <h3 class="card-title text-white"><b> Información de la Empresa </b></h3>
            </div>
            <div class="card-body">
                <form action="{{ route('students.updateCompanyInfo') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- BUSINESS NAME --}}
                    <x-inputs.text-field-row name="business_name" label="Razón Social:" placeholder="Ingresé la Razón Social" :default-value="$company->business_name" />

                    {{-- ADDRESS NAME --}}
                    <x-inputs.text-field-row name="address_name" label="Dirección:" placeholder="Ingresé la Direccion"  :default-value="$company->address_name" />

                    {{-- PERSON NAME IN CHARGE --}}
                    <x-inputs.text-field-row name="person_in_charge" label="Encargado:" placeholder="Ingresé la Persona Encargada"  :default-value="$company->person_in_charge" />

                    {{-- PERSON IN CHARGE POSITION --}}
                    <x-inputs.text-field-row name="person_in_charge_position" label="Cargo:" placeholder="Ingresé el Cargo"  :default-value="$company->person_in_charge_position" />

                    {{-- E-MAIL --}}
                    <x-inputs.text-field-row name="email" label="E-mail:" placeholder="Ingresé el E-mail" :default-value="$company->email" />

                    {{-- OFFICE PHONE NUMBER --}}
                    <x-inputs.text-field-row name="office_phone_number" label="Teléfono Oficina:" placeholder="Ingresé el Teléfono Oficina"  :default-value="$company->office_phone_number" />

                    {{-- PERSONAL PHONE NUMBER --}}
                    <x-inputs.text-field-row name="personal_phone_number" label="Teléfono Celular:" placeholder="Ingresé el Teléfono Celular"  :default-value="$company->personal_phone_number" />

                    {{-- COMMERCIAL BUSINESS --}}
                    <x-inputs.text-field-row name="commercial_business" label="Giro Comercial:" placeholder="Ingresé el Giro Comercial"  :default-value="$company->commercial_business" />

                    {{-- ZIP CODE --}}
                    <x-inputs.text-field-row name="zip_code" label="Código Postal:" placeholder="Ingresé el Código Postal"  :default-value="$company->zip_code" />

                    <div class="text-right">
                        <button class="btn  btn-success"><i class="material-icons">save</i><b> Guardar</b></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
