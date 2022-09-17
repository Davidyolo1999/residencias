@extends('layouts.main', ['activePage' => 'students', 'title' => __(''), 'titlePage' => 'Estudiantes'])

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
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="card-title text-white"><b>Estudiantes</b> </h4>
                                    <p class="card-category text-white"><b>Lista de Estudiantes</b> </p>
                                </div>

                                <form action="{{ route('students.index') }}">
                                    <div class="form-group text-center text-dark search">
                                        <label for="document" class="text-white">
                                            Filtrar por</label>
                                        <select class="text-center text-dark selectpicker show-tick"
                                            data-style="btn btn-sm btn-success btn-round" name="document" id="document"
                                            onchange="$(this).closest('form').submit()" data-size="5" data-width="fit">
                                            
                                            <option style="background: #fff ; color: black;" selected>
                                                Selecciona una Opción</option>
                                            <option value="residencyRequest" style="background: #fff ; color: black;"
                                                @if (request('document') === 'residencyRequest') selected @endif>PETICIÓN DE RESIDENCIA
                                            </option>
                                            <option value="presentationLetter" style="background: #fff ; color: black;"
                                                @if (request('document') === 'presentationLetter') selected @endif>CARTA DE PRESENTACIÓN
                                            </option>
                                            <option value="commitmentLetter" style="background: #fff ; color: black;"
                                                @if (request('document') === 'commitmentLetter') selected @endif>CARTA DE COMPROMISO
                                            </option>
                                            <option value="acceptanceLetter" style="background: #fff ; color: black;"
                                                @if (request('document') === 'acceptanceLetter') selected @endif>CARTA DE ACEPTACIÓN
                                            </option>
                                            <option value="assignmentLetter" style="background: #fff ; color: black;"
                                                @if (request('document') === 'assignmentLetter') selected @endif>CARTA DE ASIGNACIÓN
                                            </option>
                                            <option value="preliminaryLetter" style="background: #fff ; color: black;"
                                                @if (request('document') === 'preliminaryLetter') selected @endif>ANTEPROYECTO</option>
                                            <option value="paperStructure" style="background: #fff ; color: black;"
                                                @if (request('document') === 'paperStructure') selected @endif>ESTRUCTURA DEL INFORME
                                                FINAL</option>
                                            <option value="complianceLetter" style="background: #fff ; color: black;"
                                                @if (request('document') === 'complianceLetter') selected @endif>CÉDULA DE CUMPLIMIENTO
                                            </option>
                                            <option value="qualificationLetter" style="background: #fff ; color: black;"
                                                @if (request('document') === 'qualificationLetter') selected @endif>ACTA DE CALIFICACIÓN
                                            </option>
                                            <option value="completionLetter" style="background: #fff ; color: black;"
                                                @if (request('document') === 'completionLetter') selected @endif>CARTA DE TÉRMINO</option>
                                            <option value="submissionLetter" style="background: #fff ; color: black;"
                                                @if (request('document') === 'submissionLetter') selected @endif>CARTA DE ENTREGA DE
                                                PROYECTO</option>
                                        </select>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-right">
                                @can('create', App\Models\Student::class)
                                    <a href="{{ route('students.create') }}" class="btn btn-sm btn-warning btn-round"><i
                                            class="material-icons">person_add</i> Nuevo</a>
                                @endcan
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr class="text-dark">
                                            <th class="text-center"># </th>
                                            <th class="text-center">E-mail </th>
                                            <th class="text-center">Nombre </th>
                                            <th class="text-center">Apellido Paterno </th>
                                            <th class="text-center">Apellido Materno </th>
                                            <th class="text-center">Sexo </th>
                                            <th class="text-center">Matrícula </th>
                                            <th class="text-center">Carrera </th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td class="text-center"> {{ $student->user_id }} </td>
                                                <td class="text-center"> {{ $student->email }} </td>
                                                <td class="text-center"> {{ $student->first_name }} </td>
                                                <td class="text-center"> {{ $student->fathers_last_name }} </td>
                                                <td class="text-center"> {{ $student->mothers_last_name }} </td>
                                                <td class="text-center"> {{ $student->sex_text }} </td>
                                                <td class="text-center"> {{ $student->account_number }} </td>
                                                <td class="text-center"> {{ $student->career->name }} </td>
                                                <td class="td-actions text-nowrap text-center">
                                                    <a href="{{ route('students.show', $student) }}"
                                                        class="btn btn-sm btn-info" title="Ver detalles">
                                                        <i class="material-icons">details</i>
                                                    </a>
                                                    <a href="{{ route('students.personalInformation', $student) }}"
                                                        class="btn btn-sm btn-dark" title="Generar Pdf" target="_blank">
                                                        <i class="material-icons">picture_as_pdf</i>
                                                    </a>

                                                    @can('update', $student)
                                                        <a href="{{ route('students.edit', $student) }}"
                                                            class="btn btn-sm btn-success" title="Editar">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                    @endcan

                                                    @can('destroy', $student)
                                                        <form action="{{ route('students.destroy', $student) }}"
                                                            method="POST" class="d-inline-block delete-student-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger" title="Eliminar">
                                                                <i class="material-icons">delete</i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ $students->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const deleteStudentForms = document.querySelectorAll('.delete-student-form');

        deleteStudentForms.forEach(form => form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Está seguro?',
                text: "Esta acción es irreversible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        }))
        
        $(document).ready(function(){
        $('.search select').selectpicker();
        })
    </script>
@endpush
