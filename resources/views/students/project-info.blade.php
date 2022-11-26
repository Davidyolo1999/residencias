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
                            <h3 class="card-title text-white"><b>Información del Proyecto. @if ($period) Periodo: {{$period->name}} @endif</b> </h3>
                        </div>
                        @if ($project->title)
                        <div class="col-md-2">
                            <a href="{{route('students.viewProjectProgress', $project)}}" class="btn btn-primary">
                                Ver Avances
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('students.loadProjectProgress', $project)}}" class="btn btn-primary">
                                Cargar Avances
                            </a>
                        </div>                    
                        @endif
                    </div>
                </div>                
            </div>
            <div class="card-body">

                <form action="{{ route('students.updateProjectInfo') }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    {{-- TITLE --}}
                    <x-inputs.text-field-row name="title" label="Título del Proyecto:" class="bmd-label-floating"
                        placeholder="Ingresé el Título del Proyecto" :default-value="$project->title" />

                    {{-- START DATE --}}
                    <x-inputs.text-field-row name="start_date" label="Fecha de Inicio:"
                        placeholder="Ingresé la Fecha de Inicio" type="date" :default-value="optional($project->start_date)->format('Y-m-d')" />

                    {{-- END DATE --}}
                    <x-inputs.text-field-row name="end_date" label="Fecha de Término:"
                        placeholder="Ingresé la Fecha de Término" type="date" :default-value="optional($project->end_date)->format('Y-m-d')" />

                    {{-- SCHEDULE --}}
                    <x-inputs.text-field-row name="schedule" label="Horario Requerdido:" class="bg-dark"
                        placeholder="Ingresé el Horario" :default-value="$project->schedule" />

                    {{-- GENERAL OBJECTIVE --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="general_objective" class="d-block letter text-dark">Objetivo General:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic has-warning">
                                <textarea class="form-control text-justify" name="general_objective" id="general_objective"
                                    rows="4">{{ old('general_objective', $project->general_objective) }}</textarea>
                            </div>
                            @error('general_objective')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- SPECIFIC OBJECTIVES --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="letter text-dark">Objetivos Específicos:</label>
                        </div>
                        <div class="col-md-9 td-actions" id="specific-obj-container">
                            @if ($project->specificObjectives->isNotEmpty())
                                @foreach ($project->specificObjectives as $obj)
                                    <div class="d-flex">
                                        <div class="input-group input-group-dynamic has-warning">
                                            <input type="text" class="form-control" name="specific_objectives[]"
                                                placeholder="Ingresé el Objetivo" value="{{ $obj->name }}">
                                        </div>
                                        <button type="button" title="Eliminar" class="btn btn-danger btn-sm btn-remove-obj">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex">
                                    <div class="input-group input-group-dynamic has-warning">
                                        <input type="text" class="form-control" name="specific_objectives[]"
                                            placeholder="Ingresé el Objetivo">
                                    </div>
                                    <button type="button" title="Eliminar" class="btn btn-danger btn-sm btn-remove-obj">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </div>
                            @endif

                            <button type="button" class="btn btn-success btn-sm" id="btn-add-specific-obj">
                                <i class="material-icons">add</i>
                                <span class="d-inline-block ml-2">Agregar Objetivo Específico</span>
                            </button>
                            <div>
                                @error('specific_objectives')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                @error('specific_objectives.*')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- JUSTIFICATION --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="justification" class="d-block letter text-dark">Justificación:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic has-warning">
                                <textarea class="form-control text-justify" name="justification" id="justification"
                                    rows="5">{{ old('justification', $project->justification) }}</textarea>
                            </div>
                            @error('justification')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- ACTIVITY SCHEDULE IMAGE --}}
                    <x-inputs.text-field-row name="activity_schedule_image" label="Imagen del Cronograma de Actividades:"
                        placeholder="Ingresé la imagen" type="file" accept="image/*" />

                    @if ($project->activity_schedule_image)
                        <div class="row">
                            <div class="col-md-12 ">
                                <img src="{{ $project->activity_schedule_image_url }}" alt="" class="image-responsive mx-auto d-block"
                                    style="max-height: 400px">
                            </div>
                        </div>
                    @endif
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


@push('js')
    <script>
        $('#btn-add-specific-obj').on('click', function() {
            $(this).before(`
                <div class="d-flex">
                    <div class="input-group input-group-dynamic has-warning">
                        <input
                            type="text"
                            class="form-control"
                            name="specific_objectives[]"
                            placeholder="Ingresé el Objetivo"
                        >
                    </div>
                    <button title="Eliminar" type="button" class="btn btn-danger btn-sm btn-remove-obj">
                        <i class="material-icons">delete</i>
                    </button>
                </div>
            `);
        });

        $('#specific-obj-container').on('click', '.btn-remove-obj', function() {
            $(this).parent().remove();
        });
    </script>
@endpush
