@extends('layouts.main', ['activePage' => 'company-info', 'title' => __(''), 'titlePage' => 'Información de la Empresa'])

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
                <h3 class="card-title text-white"><b> Información de la Empresa </b></h3>
            </div>
            <div class="card-body">
                <form action="{{ route('students.updateCompanyInfo') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- BUSINESS NAME --}}
                    <x-inputs.text-field-row name="business_name" label="Razón Social:"
                        placeholder="Ingresé la Razón Social" :default-value="$company->business_name" />

                    {{-- ADDRESS NAME --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="address_name" class="d-block">Dirección:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic has-warning">
                                <textarea class="form-control text-justify" name="address_name" placeholder="Ingresé la Dirección" id="address_name"
                                    rows="3">{{ old('address_name', $company->address_name) }}</textarea>
                            </div>
                            @error('address_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- PERSON NAME IN CHARGE --}}
                    <x-inputs.text-field-row name="person_in_charge" label="Encargado:"
                        placeholder="Ingresé la Persona Encargada" :default-value="$company->person_in_charge" />

                    {{-- PERSON IN CHARGE POSITION --}}
                    <x-inputs.text-field-row name="person_in_charge_position" label="Cargo:" placeholder="Ingresé el Cargo"
                        :default-value="$company->person_in_charge_position" />

                    {{-- E-MAIL --}}
                    <x-inputs.text-field-row name="email" type="email" label="E-mail:" placeholder="Ingresé el E-mail"
                        :default-value="$company->email" />

                    {{-- OFFICE PHONE NUMBER --}}
                    <x-inputs.text-field-row name="office_phone_number" label="Teléfono Oficina:"
                        placeholder="Ingresé el Teléfono Oficina" :default-value="$company->office_phone_number" />

                    {{-- PERSONAL PHONE NUMBER --}}
                    <x-inputs.text-field-row name="personal_phone_number" label="Teléfono Celular:"
                        placeholder="Ingresé el Teléfono Celular" :default-value="$company->personal_phone_number" />

                    {{-- COMMERCIAL BUSINESS --}}
                    <x-inputs.text-field-row name="commercial_business" label="Giro Comercial:"
                        placeholder="Ingresé el Giro Comercial" :default-value="$company->commercial_business" />

                    {{-- DEPARTMENT REQUESTING PROJECT --}}
                    <x-inputs.text-field-row name="Department_requesting_project" label="Departamento Solicitante del Proyecto:"
                        placeholder="Ingresé el Departamento Solicitante del Proyecto" :default-value="$company->Department_requesting_project" />

                    {{-- ZIP CODE --}}
                    <x-inputs.text-field-row name="zip_code" label="Código Postal:" placeholder="Ingresé el Código Postal"
                        :default-value="$company->zip_code" />

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
