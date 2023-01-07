@extends('layouts.main', ['activePage' => 'project-info', 'title' => __(''), 'titlePage' => 'Cargar Avances'])

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
                            <div class="row container" style="justify-content: space-between;">
                                <div class="col-md-6">
                                    <h3 class="card-title text-white">Actualizar Avances del Proyecto.</h3>
                                </div>
                                @if ($project->title)
                                <div class="col-md-2">
                                    <a href="{{route('students.projectInfo', $project)}}"
                                        class="btn btn-sm btn-round btn-secondary">
                                        Volver al detalle
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{route('students.viewProjectProgress', $project)}}"
                                        class="btn btn-sm btn-round btn-secondary">
                                        <span class="material-icons">
                                            format_list_bulleted
                                            </span>
                                        Ver Avances
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{route('students.loadProjectProgress', $project)}}"
                                        class="btn btn-sm btn-round btn-secondary">
                                        <span class="material-icons">
                                            upload
                                            </span>
                                        Cargar Nuevo Avance
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('students.updateProjectProgress', $progress) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="project_id" value="{{$project->id}}" />
                            {{-- DESCRIPTION --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="description" class="d-block letter text-dark">Descripción:</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group input-group-dynamic has-warning">
                                        <textarea class="form-control text-justify" name="description" id="description"
                                            rows="5">{{ old('description', $progress->description) }}</textarea>
                                    </div>
                                    @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                @error('project_id')
                                <p class="text-danger">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="text-right">
                                <button class="btn  btn-success">
                                    <i class="material-icons">save</i>
                                    <b>
                                        Guardar
                                    </b>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection