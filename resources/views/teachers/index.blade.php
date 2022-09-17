@extends('layouts.main', ['activePage' => 'teachers', 'title' => __(''), 'titlePage' => 'Profesores'])

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
                <h4 class="card-title text-white"><b>Profesores</b> </h4>
                <p class="card-category text-white"><b>Lista de Profesores</b> </p>
            </div>
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('teachers.create') }}" class="btn btn-sm btn-warning btn-round"><i class="material-icons">person_add</i> Nuevo</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary text-center">
                            <tr class="text-dark">
                                <th> # </th>
                                <th> E-mail </th>
                                <th> Nombre </th>
                                <th> Apellido Paterno </th>
                                <th> Apellido Materno </th>
                                <th> Sexo </th>
                                <th> CURP </th>
                                <th> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr class="text-dark text-center">
                                    <td>{{ $teacher->user_id }} </td>
                                    <td>{{ $teacher->email }} </td>
                                    <td>{{ $teacher->first_name }} </td>
                                    <td>{{ $teacher->fathers_last_name }} </td>
                                    <td>{{ $teacher->mothers_last_name }} </td>
                                    <td>{{ $teacher->sex_text }} </td>
                                    <td>{{ $teacher->curp }} </td>
                                    <td class="td-actions text-nowrap">
                                        <a href="" class="btn btn-sm btn-info" title="Ver detalles">
                                            <i class="material-icons">details</i>
                                        </a>
                                        <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-sm btn-info btn-success" title="Editar" >
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