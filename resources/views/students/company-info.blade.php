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
                            <div class="form-group   has-warning mb-3">
                                <div class="mb-0">
                                    <label for="business_name" class="d-block text-dark letter">Razón
                                        Social:</label>
                                </div>
                                <input type="text" class="form-control" name="business_name" id="business_name"
                                    value="{{ old('business_name', $company->business_name) }}"
                                    placeholder="Ingresé la Razón Social" autofocus>
                                @error('business_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            {{-- ADDRESS NAME --}}
                            <div class="form-group  has-warning mb-3">
                                <div class="mb-0">
                                    <label for="address_name" class="d-block text-dark letter">Dirección:</label>

                                </div>
                                <div class="input-group input-group-dynamic has-warning">
                                    <textarea class="form-control text-justify" name="address_name"
                                        placeholder="Ingresé la Dirección" id="address_name"
                                        rows="2">{{ old('address_name', $company->address_name) }}</textarea>
                                </div>
                                @error('address_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-row">
                                {{-- PERSON NAME IN CHARGE --}}
                                <div class="form-group col-md-6 has-warning">
                                    <div class="mb-0">
                                        <label for="person_in_charge"
                                            class="d-block text-dark letter">Encargado:</label>
                                    </div>
                                    <input type="text" class="form-control text-center" name="person_in_charge"
                                        id="person_in_charge" placeholder="Ingresé la Persona Encargada"
                                        value="{{ old('person_in_charge', $company->person_in_charge) }}">
                                    @error('person_in_charge')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- PERSON IN CHARGE POSITION --}}
                                <div class="form-group col-md-6 has-warning">
                                    <div class="mb-0">
                                        <label for="person_in_charge_position"
                                            class="d-block text-dark letter">Cargo:</label>
                                    </div>
                                    <input type="text" class="form-control text-center" name="person_in_charge_position"
                                        id="person_in_charge_position" placeholder="Ingresé el Cargo"
                                        value="{{ old('person_in_charge_position', $company->person_in_charge_position) }}">
                                    @error('person_in_charge_position')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 has-warning">
                                    <div class="mb-0">
                                        <label for="email" class="d-block text-dark letter">E-mail:</label>
                                    </div>
                                    <input type="email" class="form-control text-center" name="email" id="email"
                                        placeholder="Ingresé el E-mail" value="{{ old('email', $company->email) }}">
                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 has-warning mb-3">
                                    <div class="mb-0">
                                        <label for="office_phone_number" class="d-block text-dark letter">Teléfono
                                            Oficina:</label>
                                    </div>
                                    <input type="text" class="form-control text-center" name="office_phone_number"
                                        id="office_phone_number"
                                        value="{{ old('office_phone_number', $company->office_phone_number) }}"
                                        placeholder="Ingresé el Teléfono Oficina">
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
                                        value="{{ old('personal_phone_number', $company->personal_phone_number) }}">
                                    @error('personal_phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                {{-- COMMERCIAL BUSINESS --}}
                                <div class="form-group col-md-4 has-warning">
                                    <div class="mb-0">
                                        <label for="commercial_business" class="d-block text-dark letter">Giro
                                            Comercial:</label>
                                    </div>
                                    <input type="text" class="form-control text-center" name="commercial_business"
                                        id="commercial_business" placeholder="Ingresé el Giro Comercial"
                                        value="{{ old('commercial_business', $company->commercial_business) }}">
                                    @error('commercial_business')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- DEPARTMENT REQUESTING PROJECT --}}
                                <div class="form-group col-md-4 has-warning">
                                    <div class="mb-0">
                                        <label for="Department_requesting_project"
                                            class="d-block text-dark letter">Departamento Solicitante del
                                            Proyecto:</label>
                                    </div>
                                    <input type="text" class="form-control text-center"
                                        name="Department_requesting_project" id="Department_requesting_project"
                                        placeholder="Ingresé el Departamento Solicitante del Proyecto"
                                        value="{{ old('Department_requesting_project', $company->Department_requesting_project) }}">
                                    @error('Department_requesting_project')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- ZIP CODE --}}
                                <div class="form-group col-md-4 has-warning">
                                    <div class="mb-0">
                                        <label for="zip_code" class="d-block text-dark letter">Código Postal:</label>
                                    </div>
                                    <input type="text" class="form-control text-center" name="zip_code" id="zip_code"
                                        placeholder="Ingresé el Código Postal"
                                        value="{{ old('zip_code', $company->zip_code) }}">
                                    @error('zip_code')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row align-items-end mb-2">                                
                                <div class="col-md-4">
                                    <label for="have_agreement_check" class="text-dark letter d-block">Posee numero de convenio</label>
                                    <input type="checkbox" @if (old('number_of_agreement', $company->number_of_agreement) || old('date', $company->date ? $company->date->format('Y-m-d') : '')) checked @endif name="have_agreement" id="have_agreement_check">
                                </div>
                                <div class="col-md-4" id="number_of_agreement_column" @if (!old('number_of_agreement', $company->number_of_agreement) && !old('date', $company->date ? $company->date->format('Y-m-d') : '')) style="display: none" @endif>
                                    <label for="number_of_agreement" class="text-dark letter">Numero de convenio</label>
                                    <input
                                        type="text" 
                                        class="form-control" 
                                        name="number_of_agreement" 
                                        id="number_of_agreement"
                                        value="{{old('number_of_agreement', $company->number_of_agreement ?? '')}}"
                                    >
                                    @error('number_of_agreement')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4" id="date_column" @if (!old('number_of_agreement', $company->number_of_agreement) && !old('date', $company->date ? $company->date->format('Y-m-d') : '')) style="display: none" @endif>
                                    <label for="date" class="text-dark letter">Fecha</label>
                                    <input
                                        type="date" 
                                        class="form-control" 
                                        name="date"
                                        id="date"
                                        value="{{old('date', $company->date ? $company->date->format('Y-m-d') : '')}}"
                                    >
                                    @error('date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                {{-- SECTOR --}}
                                <div class="form-group col-md-4 has-warning">
                                    <div class="mb-0">
                                        <label for="sector" class="d-block text-dark letter">Sector:</label>
                                    </div>
                                    <select name="sector" id="sector" class="form-control">
                                        <option value="" selected disabled class="text-center">Seleccione una Opción</option>                                        
                                        <option value="publico" @if (old('sector', $company->sector) === 'publico') selected @endif>Publico</option>
                                        <option value="privado" @if (old('sector', $company->sector) === 'privado') selected @endif>Privado</option>
                                        <option value="educativo" @if (old('sector', $company->sector) === 'educativo') selected @endif>Educativo</option>
                                        <option value="social" @if (old('sector', $company->sector) === 'social') selected @endif>Social</option>
                                    </select>
                                    @error('sector')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn  btn-success"><i class="material-icons">save</i><b>
                                        Guardar</b></button>
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
        const checkbox = document.getElementById('have_agreement_check');

        var numberOfAgreement = @json(old('number_of_agreement', $company->number_of_agreement ?? ''));
        var date = @json(old('date', $company->date ? $company->date->format('Y-m-d') : ''));

        if(checkbox){
            checkbox.addEventListener('change', (e) => {                
                var dateColumn = document.getElementById('date_column');
                var numberOfAgreementColumn = document.getElementById('number_of_agreement_column');

                var dateInput = document.getElementById('date');
                var numberOfAgreementInput = document.getElementById('number_of_agreement');

                if(e.target.checked){                    
                    dateInput.value = date;
                    numberOfAgreementInput.value = numberOfAgreement;
                    dateColumn.style.display = 'block';
                    numberOfAgreementColumn.style.display = 'block';                    
                }else{
                    
                    dateInput.value = '';
                    numberOfAgreementInput.value = '';

                    dateColumn.style.display = 'none';
                    numberOfAgreementColumn.style.display = 'none';
                }
            });
        }
    </script>
@endpush