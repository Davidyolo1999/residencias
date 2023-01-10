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
                                        <h3 class="card-title text-white"><b>Información del Proyecto. @if ($period)
                                                    Periodo: {{ $period->name }}
                                                @endif
                                            </b> </h3>
                                    </div>
                                    @if ($project->title)
                                        <div class="col-md-2">
                                            <a href="{{ route('students.viewProjectProgress', $project) }}"
                                            data-toggle-second="tooltip" data-placement="left" title="Aquí puedes ver el listado de tus avances."
                                                class="btn btn-sm btn-round btn-secondary">
                                                <span class="material-icons">
                                                    format_list_bulleted
                                                    </span>
                                                Ver Avances
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('students.loadProjectProgress', $project) }}"
                                                class="btn btn-sm btn-round btn-secondary"
                                                data-toggle-second="tooltip" data-placement="left" title="Aquí puedes agregar los avances de acuerdo a las revisión por tu asesor."
                                                >
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

                            <form action="{{ route('students.updateProjectInfo') }}" method="post"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                {{-- TITLE --}}
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="title" class="d-block letter text-dark">
                                            Título del Proyecto:
                                            <i data-toggle-second="tooltip" data-placement="top"
                                                class="align-middle material-icons"
                                                style="cursor: pointer; font-size: 18px;"
                                                data-original-title="
                                                Debe ser conciso e incluir los términos más relevantes del objetivo del trabajo. Se recomienda que no exceda de 18 palabras y no contenga siglas, formulas o abreviaturas. Cuanto más breve, mejor.
                                                            ">
                                                help_outline
                                            </i>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group input-group-dynamic label-floating has-warning">
                                            <input type="text" class="form-control" name="title" id="title"
                                                placeholder="Ingresé el Título del Proyecto"
                                                value="{{ old('title', $project->title) }}">
                                        </div>
                                        @error('title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- START DATE --}}
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="start_date" class="d-block letter text-dark">
                                            Fecha de Inicio:
                                            <i data-toggle-second="tooltip" data-placement="top"
                                                class="align-middle material-icons"
                                                style="cursor: pointer; font-size: 18px;"
                                                data-original-title="Plazo mínimo de 4 meses y máximo de 6 meses.
                                                        ">
                                                help_outline
                                            </i>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group input-group-dynamic label-floating has-warning">
                                            <input type="date" class="form-control" name="start_date" id="start_date"
                                                placeholder="Ingresé la Fecha de Inicio"
                                                value="{{ old('start_date', optional($project->start_date)->format('Y-m-d')) }}">
                                        </div>
                                        @error('start_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- END DATE --}}
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="end_date" class="d-block letter text-dark">
                                            Fecha de Término:
                                            <i data-toggle-second="tooltip" data-placement="top"
                                                class="align-middle material-icons"
                                                style="cursor: pointer; font-size: 18px;"
                                                data-original-title="Plazo mínimo de 4 meses y máximo de 6 meses.
                                                        ">
                                                help_outline
                                            </i>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group input-group-dynamic label-floating has-warning">
                                            <input type="date" class="form-control" name="end_date" id="end_date"
                                                placeholder="Ingresé la Fecha de Término"
                                                value="{{ old('end_date', optional($project->end_date)->format('Y-m-d')) }}">
                                        </div>
                                        @error('end_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- SCHEDULE --}}
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="schedule" class="d-block letter text-dark">Horario Requerdido:
                                            <i data-toggle-second="tooltip" data-placement="top"
                                                class="align-middle material-icons"
                                                style="cursor: pointer; font-size: 18px;"
                                                data-original-title=" De acuerdo a las fechas de inicio y término del proyecto, debera cubrir 640 horas.
                                                Ejemplo: Lunes 7:00 a 18:00 Martes 7:00 a 18:00 Viernes 7:00 a 18:00
                                ">help_outline</i>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group input-group-dynamic label-floating has-warning">
                                            <input type="text" class="form-control" name="schedule" id="schedule"
                                                placeholder="Ingresé el Horario"
                                                value="{{ old('schedule', $project->schedule) }}">
                                        </div>
                                        @error('schedule')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- GENERAL OBJECTIVE --}}
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="general_objective" class="d-block letter text-dark">
                                            Objetivo General:
                                            <i data-toggle-second="tooltip" 
                                                class="align-middle material-icons"
                                                style="cursor: pointer; font-size: 18px;"
                                                data-original-title="
                                Responden a la pregunta: ¿Qué pretendes alcanzar y para qué? Indican el propósito de la investigación. Deben exponer la finalidad del proyecto: qué es lo que se quiere lograr. 
                                ">help_outline</i>

                                        </label>

                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group input-group-dynamic has-warning">
                                            <textarea class="form-control text-justify" name="general_objective" id="general_objective" rows="4">{{ old('general_objective', $project->general_objective) }}</textarea>
                                        </div>
                                        @error('general_objective')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- SPECIFIC OBJECTIVES --}}
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="" class="letter text-dark">Objetivos Específicos:
                                            <i data-toggle-second="tooltip" data-placement="top"
                                                class="align-middle material-icons"
                                                style="cursor: pointer; font-size: 18px;"
                                                data-original-title="
                                ¿Qué acciones específicas requieres para alcanzar el objetivo general?
                                Los objetivos deben redactarse como enunciados claros y precisos de las metas que se persiguen, empleando verbos en infinitivo. 
                                ">help_outline</i>

                                        </label>
                                    </div>
                                    <div class="col-md-9 td-actions" id="specific-obj-container">
                                        @if ($project->specificObjectives->isNotEmpty())
                                            @foreach ($project->specificObjectives as $obj)
                                                <div class="d-flex">
                                                    <div class="input-group input-group-dynamic has-warning">
                                                        <input type="text" class="form-control"
                                                            name="specific_objectives[]" placeholder="Ingresé el Objetivo"
                                                            value="{{ $obj->name }}">
                                                    </div>
                                                    <button type="button" title="Eliminar"
                                                        class="btn btn-danger btn-sm btn-remove-obj">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="d-flex">
                                                <div class="input-group input-group-dynamic has-warning">
                                                    <input type="text" class="form-control"
                                                        name="specific_objectives[]" placeholder="Ingresé el Objetivo">
                                                </div>
                                                <button type="button" title="Eliminar"
                                                    class="btn btn-danger btn-sm btn-remove-obj">
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
                                        <label for="justification" class="d-block letter text-dark">Justificación:
                                            <i data-toggle-second="tooltip" data-placement="bottom"
                                                class="align-middle material-icons"
                                                style="cursor: pointer; font-size: 18px;"
                                                title="¡Extensión máxima: Una cuartilla!
                                Responden a la pregunta: ¿Por qué y para qué vas a hacer tu investigación?, ¿Qué posibilidades existen para que realices tu investigación?
                                Explica de manera lógica y con claridad la relevancia, impacto e innovación que el trabajo aportará al conocimiento del tema.
                                Debe tomarse en cuenta la novedad del material que se quiere investigar o de la visión novedosa que se desea dar. 
                                ">help_outline</i>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group input-group-dynamic has-warning">
                                            <textarea class="form-control text-justify" name="justification" id="justification" rows="5">{{ old('justification', $project->justification) }}</textarea>
                                        </div>
                                        @error('justification')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- ACTIVITY SCHEDULE IMAGE --}}
                                <x-inputs.text-field-row name="activity_schedule_image"
                                    label="Imagen del Cronograma de Actividades:" placeholder="Ingresé la imagen"
                                    type="file" accept="image/*" />

                                @if ($project->activity_schedule_image)
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <img src="{{ $project->activity_schedule_image_url }}" alt=""
                                                class="image-responsive mx-auto d-block" style="max-height: 400px">
                                        </div>
                                    </div>
                                @endif
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
