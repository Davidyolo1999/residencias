@extends('layouts.main', ['activePage' => 'students', 'title' => __(''), 'titlePage' => 'Estudiantes'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title text-white"><b>Editar Estudiante</b> </h4>
            </div>

            <div class="card-body">
                <form action="{{ route('students.update', $student) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- EMAIL --}}
                    <x-inputs.text-field-row
                        name="email"
                        label="Correo Electrónico:"
                        placeholder="Ingresé el Correo Electrónico"
                        autofocus
                        :default-value="$student->user->email"
                    />

                    {{-- FIRST NAME --}}
                    <x-inputs.text-field-row
                        name="first_name"
                        label="Nombre(s):"
                        placeholder="Ingresé el Nombre"
                        :default-value="$student->first_name"
                    />

                    {{-- FATHER'S LAST NAME --}}
                    <x-inputs.text-field-row
                        name="fathers_last_name"
                        label="Apellido Paterno:"
                        placeholder="Ingresé el Apellido Paterno"
                        :default-value="$student->fathers_last_name"
                    />

                    {{-- MOTHERS'S LAST NAME --}}
                    <x-inputs.text-field-row
                        name="mothers_last_name"
                        label="Apellido Materno:"
                        placeholder="Ingresé el Apellido Materno"
                        :default-value="$student->mothers_last_name"

                    />

                    {{-- CARREER --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="career_id" class="d-block">Carrera:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <select
                                    class="form-control"
                                    name="career_id"
                                    id="career_id"
                                >
                                    <option value="" selected disabled>Seleccione una Opción</option>
                                    @foreach ($careers as $career)
                                        <option
                                            value="{{ $career->id }}"
                                            @if (old('career_id', $student->career_id) == $career->id) selected @endif
                                        >{{ $career->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('career_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- TEACHER --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="teacher_id" class="d-block">Asesor Interno:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <select
                                    class="form-control"
                                    name="teacher_id"
                                    id="teacher_id"
                                >
                                    <option value="" selected disabled>Seleccione una Opción</option>
                                    @foreach ($teachers as $teacher)
                                        <option
                                            value="{{ $teacher->user_id }}"
                                            @if (old('teacher_id', $student->teacher_id) == $teacher->user_id) selected @endif
                                        >{{ $teacher->first_name }} {{ $teacher->fathers_last_name }} {{ $teacher->mothers_last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('teacher_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- EXTERNAL ADVISOR --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="external_advisor_id" class="d-block">Asesor Externo:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <select
                                class="selectpicker form-control text-dark has-warning" data-live-search="true"
                                data-style="btn btn-sm btn-outline-success btn-round"
                                    name="external_advisor_id"
                                    id="external_advisor_id"
                                >
                                    <option style="background: #fff ; color: black;" value="" selected disabled>Seleccione una Opción</option>
                                    @foreach ($externalAdvisors as $externalAdvisor)
                                        <option
                                        style="background: #fff ; color: black;"
                                            value="{{ $externalAdvisor->user_id }}"
                                            @if (old('external_advisor_id', $student->external_advisor_id) == $externalAdvisor->user_id) selected @endif
                                        >{{ $externalAdvisor->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('external_advisor_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- ACCOUNT NUMBER --}}
                    <x-inputs.text-field-row
                        name="account_number"
                        label="Número de Cuenta:"
                        placeholder="Ingresé Número de Cuenta"
                        :default-value="$student->account_number"
                    />
                    {{-- RPA --}}
                    <x-inputs.text-field-row
                        name="rpa"
                        label="RPA:"
                        placeholder="Ingresé el RPA"
                        :default-value="$student->rpa"
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
                                    <option value="m" @if (old('sex', $student->sex) == 'm') selected @endif>Masculino</option>
                                    <option value="f" @if (old('sex', $student->sex) == 'f') selected @endif>Femenino</option>
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
                        :default-value="$student->curp"


                    />

                    {{-- CAREER PERCENTAGE --}}
                    <x-inputs.text-field-row
                        name="career_percentage"
                        label="Porcentaje de la Carrera:"
                        placeholder="Ingresé Porcentaje"
                        min="1"
                        max="100"
                        step="0.1"
                        :default-value="$student->career_percentage"

                    />

                    {{-- ENROLLED --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="is_enrolled" class="d-block">Inscrito:</label>
                        </div>
                        <div class="col-md-9">
                            <input
                                type="checkbox"
                                id="is_enrolled"
                                name="is_enrolled"
                                @if (old('is_enrolled', $student->is_enrolled)) checked @endif
                            >
                        </div>
                    </div>

                    {{-- SOCIAL SERVICE CONCLUDED --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="is_social_service_concluded" class="d-block">Servicio Social Concluido:</label>
                        </div>
                        <div class="col-md-9">
                            <input
                                type="checkbox"
                                id="is_social_service_concluded"
                                name="is_social_service_concluded"
                                @if (old('is_social_service_concluded', $student->is_social_service_concluded)) checked @endif
                            >
                        </div>
                    </div>
                    {{-- REGULATE --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="regulate" class="d-block">Regular:</label>
                        </div>
                        <div class="col-md-9">
                            <input
                                type="checkbox"
                                id="regulate"
                                name="regulate"
                                @if (old('regulate', $student->regulate)) checked @endif
                            >
                        </div>
                    </div>

                    {{-- PHONE NUMBER --}}
                    <x-inputs.text-field-row
                        name="phone_number"
                        label="Teléfono:"
                        placeholder="Ingresé Número de Teléfono"
                        :default-value="$student->phone_number"

                    />
                    
                    <div class="text-right">
                        <a href="{{ route('students.index') }}" class="btn  btn-warning btn-sm mr-3">
                            <i class="material-icons">cancel</i><b> Cancelar</b> </a>
                        <button class="btn  btn-success btn-sm"><i class="material-icons">save</i><b> Guardar</b></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title text-white"><b>Cambiar Contraseña</b> </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('students.updatePassword', $student) }}" method="POST">
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
                        <a href="{{ route('students.index') }}" class="btn btn-sm btn-warning mr-3">
                            <i class="material-icons">cancel</i><b> Cancelar</b> </a>
                        <button class="btn  btn-success btn-sm"><i class="material-icons">save</i><b> Guardar</b></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const currentCareerId = @json(old('career_id', $student->career_id));

        const teachers = @json($teachers);

        $(() => {

            if(currentCareerId){
                const teachersFiltered = teachers.map((teacher) => {
                        if(teacher?.career_id === currentCareerId){
                            return `<option value="${teacher.user_id}" ${teacher.user_id == @json(old('teacher_id', $student->teacher_id)) ? 'selected' : ''}>${teacher.first_name} ${teacher.fathers_last_name} ${teacher.mothers_last_name}</option>`
                        }
                        return '';
                    })
                    .join('');

                    $('#teacher_id').html(`
                    <option value="" selected disabled>Seleccione una opción</option>
                    ${teachersFiltered}
                `);
            }


            $('#career_id').change((e) => {
                const careerId = Number(e.target.value);                
                if(careerId){
                    const teachersFiltered = teachers.map((teacher) => {
                        if(teacher?.career_id === careerId){
                            return `<option value="${teacher.user_id}" ${teacher.user_id == @json(old('teacher_id', $student->teacher_id)) ? 'selected' : ''}>${teacher.first_name} ${teacher.fathers_last_name} ${teacher.mothers_last_name}</option>`
                        }
                        return '';
                    })
                    .join('');

                    $('#teacher_id').html(`
                    <option value="" selected disabled>Seleccione una opción</option>
                    ${teachersFiltered}
                `);
                }
            })            
        });
    </script>
@endpush
