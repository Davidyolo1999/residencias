@extends('layouts.main', ['activePage' => 'project-info', 'title' => __(''), 'titlePage' => 'Información del Proyecto'])

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
                            <div class="container">
                                <div class="row container">
                                    <div class="col-md-8">
                                        <h5 class="card-title text-white"><b>Avances del proyecto:
                                                "{{ $project->title }}"</b></h5>
                                    </div>
                                    @if ($project->title)
                                        <div class="col-md-2">
                                            <a href="{{ route('students.projectInfo', $project) }}"
                                                class="btn btn-sm btn-round btn-secondary">
                                                Volver al detalle
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('students.loadProjectProgress', $project) }}"
                                                data-toggle-second="tooltip" data-placement="left"
                                                title="Aquí puedes agregar un nuevo avance."
                                                class="btn btn-sm btn-round btn-secondary">
                                                <span class="material-icons">
                                                    upload
                                                </span>
                                                Cargar Avances
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-right mb-4">
                                <div class="dropdown d-inline">
                                    <button class="btn btn-sm btn-round btn-outline-secondary dropdown-toggle"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        data-toggle-second="tooltip" data-placement="left"
                                        title="Aquí puedes exportar los avances a PDF." aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="material-icons">save</i> Exportar
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a href="{{ route('students.exportProjectProgress', $project) }}" target="_blank"
                                            class="dropdown-item" style="background: #fff ; color: black; cursor: pointer;">
                                            <i class="material-icons">picture_as_pdf</i>
                                            Avances
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th>
                                                Número
                                            </th>
                                            <th>
                                                Descripción
                                            </th>
                                            <th>
                                                Fecha
                                            </th>
                                            <th>
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($project->projectProgress as $progress)
                                            <tr>
                                                <td>
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td>
                                                    {{ $progress->description }}
                                                </td>
                                                <td>
                                                    {{ $progress->created_at->format('d/m/Y') }}
                                                </td>
                                                <td class="text-right td-actions">
                                                    <a href="{{ route('students.editProjectProgress', [$project, $progress]) }}"
                                                        data-toggle-second="tooltip" data-placement="top"
                                                        title="Aquí puedes editar el avance."
                                                        class="btn btn-sm btn-info btn-success" title="Editar">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <form action="{{ route('students.deleteProjectProgress', $progress) }}"
                                                        method="POST" class="d-inline-block delete-progress-form"
                                                        data-toggle-second="tooltip" data-placement="top"
                                                        title="Aquí puedes eliminar el avance.">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-danger">Sin Avances</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        const deleteProgressForms = document.querySelectorAll('.delete-progress-form');

        deleteProgressForms.forEach(form => form.addEventListener('submit', function(e) {
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
