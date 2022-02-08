@extends('layouts.main', ['activePage' => 'teachers', 'title' => __(''), 'titlePage' => 'Profesores'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title text-white"><b>Profesores</b> </h4>
                <p class="cart-category text-white"><b>Lista de Profesores</b> </p>
            </div>

            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('teachers.create') }}" class="btn btn-sm btn-warning"><i class="material-icons">person_add</i> Añadir Profesor</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary text-center">
                            <tr class="text-dark">
                                <th><b> # </b></th>
                                <th><b> E-mail </b></th>
                                <th><b> Nombres </b></th>
                                <th><b> Apellido Paterno </b></th>
                                <th><b> Apellido Materno </b></th>
                                <th><b> Sexo </b></th>
                                <th><b> CURP </b></th>
                                <th><b> Acciones</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr class="text-dark text-center">
                                    <td><b>{{ $teacher->user_id }} </b></td>
                                    <td><b>{{ $teacher->email }} </b></td>
                                    <td><b>{{ $teacher->first_name }} </b></td>
                                    <td><b>{{ $teacher->fathers_last_name }} </b></td>
                                    <td><b>{{ $teacher->mothers_last_name }} </b></td>
                                    <td><b>{{ $teacher->sex_text }} </b></td>
                                    <td><b>{{ $teacher->curp }} </b></td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-info" title="Ver detalles">
                                            <i class="material-icons">details</i>
                                        </a>
                                        <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-sm btn-info" title="Editar" >
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <form
                                            action="{{ route('teachers.destroy', $teacher) }}"
                                            method="POST"
                                            class="d-inline-block delete-teacher-form"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $teachers->links() }}
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>        
        const deleteTeacherForms = document.querySelectorAll('.delete-teacher-form');
        
        deleteTeacherForms.forEach(form => form.addEventListener('submit', function(e) {
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