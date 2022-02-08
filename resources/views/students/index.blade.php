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
                <h4 class="card-title text-white"><b>Estudiantes</b> </h4>
                <p class="cart-category text-white"><b>Lista de Estudiantes</b> </p>
            </div>

            <div class="card-body">
                <div class="text-right">
                    @can('create', App\Models\Student::class)
                    <a href="{{ route('students.create') }}" class="btn btn-sm btn-warning"><i class="material-icons">person_add</i>  Añadir estudiante</a>
                    @endcan
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <tr class="text-dark">
                                <th class="text-center"><b>#</b> </th>
                                <th class="text-center"><b>E-mail</b> </th>
                                <th class="text-center"><b>Nombre(s)</b> </th>
                                <th class="text-center"><b>Apellido Paterno</b> </th>
                                <th class="text-center"><b>Apellido Materno</b> </th>
                                <th class="text-center"><b>Sexo</b> </th>
                                <th class="text-center"><b>CURP</b> </th>
                                <th class="text-center"><b>Carrera</b> </th>
                                <th class="text-center"><b>Acciones</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td  class="text-center"><b> {{ $student->user_id }} </b></td>
                                    <td class="text-center"><b> {{ $student->email }} </b></td>
                                    <td class="text-center"><b> {{ $student->first_name }} </b></td>
                                    <td class="text-center"><b> {{ $student->fathers_last_name }} </b></td>
                                    <td class="text-center"><b> {{ $student->mothers_last_name }} </b></td>
                                    <td class="text-center"><b> {{ $student->sex_text }} </b></td>
                                    <td class="text-center"><b> {{ $student->curp }} </b></td>
                                    <td class="text-center"><b> {{ $student->career->name }} </b></td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info" title="Ver detalles">
                                            <i class="material-icons">details</i>
                                        </a>

                                        @can('update', $student)
                                        <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-info" title="Editar" >
                                            <i class="material-icons">edit</i>
                                        </a>
                                        @endcan

                                        @can('destroy', $student)
                                        <form
                                            action="{{ route('students.destroy', $student) }}"
                                            method="POST"
                                            class="d-inline-block delete-student-form"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
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
    </script>
@endpush