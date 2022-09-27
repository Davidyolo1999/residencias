@extends('layouts.main', ['activePage' => 'students', 'title' => __(''), 'titlePage' => 'Detalles de Estudiante'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        @if ($errors->isNotEmpty())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- STUDENT DETAILS CARD --}}
        <div class="card mb-5">
            <div class="card-header card-header-warning">
                <h4 class="card-title text-white"><b>Datos de {{ $student->full_name }}</b> </h4>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    {{-- CURP --}}
                    <div class="col-md-12">
                        <p class="mb-0"><b>CURP:</b></p>
                        {{ $student->curp }}
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- NAMES --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Nombre(s):</b></p>
                        {{ $student->first_name }}
                    </div>
                    {{-- FATHER'S LAST NAME --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Apellido paterno:</b></p>
                        {{ $student->fathers_last_name }}
                    </div>
                    {{-- MOTHERS'S LAST NAME --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Apellido materno:</b></p>
                        {{ $student->mothers_last_name }}
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- SEX --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Sexo:</b></p>
                        {{ $student->sex_text }}
                    </div>
                    {{-- CAREER --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Carrera:</b></p>
                        {{ $student->career->name }}
                    </div>
                    {{-- ACCOUNT NUMBER --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Número de cuenta:</b></p>
                        {{ $student->account_number }}
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- IS ENROLLED --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Inscrito:</b></p>
                        {{ $student->is_enrolled  ? 'Si' : 'No' }}
                    </div>
                    {{-- IS SOCIAL SERVICE CONCLUDED --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Servicio social concluido:</b></p>
                        {{ $student->is_social_service_concluded  ? 'Si' : 'No' }}
                    </div>
                    {{-- CAREER PERCENTAGE --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Porcentaje de la carrera:</b></p>
                        {{ $student->career_percentage }}%
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- STATE --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Estado:</b></p>
                        {{ $student->state->name }}
                    </div>
                    {{-- MUNICIPALITY --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Municipio:</b></p>
                        {{ $student->municipality->name }}
                    </div>
                    {{-- LOCALITY --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Localidad:</b></p>
                        {{ $student->locality->name }}
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- PHONE NUMBER --}}
                    <div class="col-md-4">
                        <p class="mb-0"><b>Teléfono:</b></p>
                        {{ $student->phone_number }}
                    </div>
                </div>
            </div>
        </div>
        {{-- STUDENT DETAILS CARD END --}}

        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title text-white"><b>Proceso de Residencia Profesional</b> </h4>
            </div>

            <div class="card-body">
                {{-- Solicitud de residencias --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.residency-request-btn')
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('students.residencyRequestMarkAsApproved', $student) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-block btn-success" @if (!$student->inProcessResidencyRequest) disabled @endif>
                                Aprobar documento
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-danger"
                            data-toggle="modal"
                            data-target="#residencyRequestCorrectionsModal"
                            @if (!$student->inProcessResidencyRequest) disabled @endif
                        >
                            Enviar correcciones
                        </button>
                    </div>
                </div>
                {{-- Solicitud de residencias end --}}

                {{-- Carta de presentación --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.presentation-letter-btn')
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('students.presentationLetterMarkAsApproved', $student) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-block btn-success" @if (!$student->inProcessPresentationLetter) disabled @endif>
                                Aprobar documento
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-danger"
                            data-toggle="modal"
                            data-target="#presentatioLetterCorrectionsModal"
                            @if (!$student->inProcessPresentationletter) disabled @endif
                        >
                            Enviar correcciones
                        </button>
                    </div>
                </div>
                {{-- Carta de presentación end --}}

                {{-- Carta de compromiso --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.commitment-letter-btn')
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('students.commitmentLetterMarkAsApproved', $student) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-block btn-success" @if (!$student->inProcessCommitmentLetter) disabled @endif>
                                Aprobar documento
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-danger"
                            data-toggle="modal"
                            data-target="#commitmentLetterCorrectionsModal"
                            @if (!$student->inProcessCommitmentLetter) disabled @endif
                        >
                            Enviar correcciones
                        </button>
                    </div>
                </div>
                {{-- Carta de compromiso end --}}

                {{-- Carta de aceptación --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.acceptance-letter-btn')
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('students.acceptanceLetterMarkAsApproved', $student) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-block btn-success" @if (!$student->inProcessAcceptanceLetter) disabled @endif>
                                Aprobar documento
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-danger"
                            data-toggle="modal"
                            data-target="#acceptanceLetterCorrectionsModal"
                            @if (!$student->inProcessAcceptanceLetter) disabled @endif
                        >
                            Enviar correcciones
                        </button>
                    </div>
                </div>
                {{-- Carta de aceptación end --}}

                {{-- Carta de asignación --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.assignment-letter-btn')
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('students.assignmentLetterMarkAsApproved', $student) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-block btn-success" @if (!$student->inProcessAssignmentLetter) disabled @endif>
                                Aprobar documento
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-danger"
                            data-toggle="modal"
                            data-target="#assignmentLetterCorrectionsModal"
                            @if (!$student->inProcessAssignmentLetter) disabled @endif
                        >
                            Enviar correcciones
                        </button>
                    </div>
                </div>
                {{-- Carta de asignación end --}}

                {{-- Anteproyecto --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.preliminary-letter-btn')
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('students.preliminaryLetterMarkAsApproved', $student) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-block btn-success" @if (!$student->inProcessPreliminaryLetter) disabled @endif>
                                Aprobar documento
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-danger"
                            data-toggle="modal"
                            data-target="#preliminaryLetterCorrectionsModal"
                            @if (!$student->inProcessPreliminaryLetter) disabled @endif
                        >
                            Enviar correcciones
                        </button>
                    </div>
                </div>
                {{-- Anteproyecto end --}}

                {{-- Estructura de informe --}}
                <div class="row">
                    <div class="col-md-6">
                        <a
                            href="{{ route('students.paperStructureDownloadSignedDoc', $student) }} "
                            class="btn btn-block btn-{{ $student->paperStructure->btn_color }}"
                            target="_blank"
                        >
                            Estructura del informe final
                        </a>
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('students.paperStructureMarkAsApproved', $student) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-block btn-success" @if (!$student->inProcessPaperStructure) disabled @endif>
                                Aprobar documento
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-danger"
                            data-toggle="modal"
                            data-target="#paperStructureCorrectionsModal"
                            @if (!$student->inProcessPaperStructure) disabled @endif
                        >
                        Enviar correcciones
                        </button>
                    </div>
                </div>
                {{-- Estructura de informe end --}}

                {{-- Carta de cumplimiento --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.compliance-letter-btn')
                    </div>
                    @if(auth()->user()->isTeacher() || auth()->user()->isAdmin())
                        <div class="col-md-3">
                            <form action="{{ route('students.complianceLetterMarkAsApproved', $student) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-block btn-success" @if (!$student->inProcessComplianceLetter) disabled @endif>
                                    Aprobar documento
                                </button>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <button
                                class="btn btn-block btn-danger"
                                data-toggle="modal"
                                data-target="#complianceLetterCorrectionsModal"
                                @if (!$student->inProcessComplianceLetter) disabled @endif
                            >
                                Enviar correcciones
                            </button>
                        </div>
                    @else
                        <div class="col-md-6">
                            <button
                                type="button"
                                class="btn btn-block btn-info"
                                data-toggle="modal"
                                data-target="#complianceLetterQuestionsModal"
                                @if (!$student->complianceLetter->exists || $student->approvedComplianceLetter) disabled @endif
                            >
                                Responder preguntas
                            </button>
                        </div>
                    @endif
                </div>
                {{-- Carta de cumplimiento end --}}

                {{-- Acta de calificación --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.qualification-letter-btn')
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-success"
                            @if (!$student->inProcessQualificationLetter) disabled @endif
                            data-toggle="modal"
                            data-target="#qualificationLetterApprovalModal"
                        >
                            Aprobar documento
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-danger"
                            data-toggle="modal"
                            data-target="#qualificationLetterCorrectionsModal"
                            @if (!$student->inProcessQualificationLetter) disabled @endif
                        >
                            Enviar correcciones
                        </button>
                    </div>
                </div>
                {{-- Acta de calificación end --}}

            {{--  Carta de Término --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.completion-letter-btn')
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('students.completionLetterMarkAsApproved', $student) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-block btn-success" @if (!$student->inProcessCompletionLetter) disabled @endif>
                                Aprobar documento
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-danger"
                            data-toggle="modal"
                            data-target="#completionLetterCorrectionsModal"
                            @if (!$student->inProcessCompletionLetter) disabled @endif
                        >
                            Enviar correcciones
                        </button>
                    </div>
                </div>
                {{-- Carta de Término end --}}

            {{--  Carta de Entrega de Proyecto --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.submission-letter-btn')
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('students.submissionLetterMarkAsApproved', $student) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-block btn-success" @if (!$student->inProcessSubmissionLetter) disabled @endif>
                                Aprobar documento
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-danger"
                            data-toggle="modal"
                            data-target="#submissionLetterCorrectionsModal"
                            @if (!$student->inProcessSubmissionLetter) disabled @endif
                        >
                            Enviar correcciones
                        </button>
                    </div>
                </div>
                {{-- Carta de Entrega de Proyecto end --}}
                {{--  Carta Autorización de uso de Información --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.authorization-letter-btn')
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('students.authorizationLetterMarkAsApproved', $student) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-block btn-success"@if (!$student->inProcessAuthorizationLetter) disabled @endif>
                                Aprobar documento
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-danger"
                            data-toggle="modal"
                            data-target="#authorizationLetterCorrectionsModal"
                            @if (!$student->inProcessAuthorizationLetter) disabled @endif
                        >
                            Enviar correcciones
                        </button>
                    </div>
                </div>
                {{-- Carta Autorización de uso de Información  end --}}
                {{--  Formato Evaluación Externo --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.external-qualifiquation-letter-btn')
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('students.externalQualificationLetterMarkAsApproved', $student) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-block btn-success"@if (!$student->inProcessExternalQualificationLetter) disabled @endif>
                                Aprobar documento
                            </button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-block btn-danger"
                            data-toggle="modal"
                            data-target="#externalQualificationLetterCorrectionsModal"
                            @if (!$student->inProcessExternalQualificationLetter) disabled @endif
                        >
                            Enviar correcciones
                        </button>
                    </div>
                </div>
                {{-- Formato Evalución Externo  end --}}
            </div>
        </div>
    </div>
@endsection

@push('modals')
    {{-- RESIDENCY REQUEST CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="residencyRequestCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.residencyRequestCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group has-warning">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- RESIDENCY REQUEST CORRECTIONS MODAL END --}}


    {{-- PRESENTATION LETTER CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="presentatioLetterCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.presentatioLetterCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group has-warning">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- PRESENTATION LETTER CORRECTIONS MODAL END --}}

    {{-- COMMITMENT LETTER CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="commitmentLetterCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.commitmentLetterCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group has-warning">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- COMMITMENT CORRECTIONS MODAL END --}}

    {{-- ACCEPTANCE LETTER CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="acceptanceLetterCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.acceptanceLetterCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group has-warning">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- ACCEPTANCE LETTER CORRECTIONS MODAL END --}}

    {{-- PAPER STRUCTURE CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="paperStructureCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.paperStructureCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group has-warning">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- ACCEPTANCE LETTER CORRECTIONS MODAL END --}}

    {{-- ASSIGNMENT LETTER CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="assignmentLetterCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.assignmentLetterCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group has-warning">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- ASSIGNMENT LETTER CORRECTIONS MODAL END --}}

    {{-- PRELIMINARY LETTER CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="preliminaryLetterCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.preliminaryLetterCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group has-warning">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- PRELIMINARY LETTER CORRECTIONS MODAL END --}}

    {{-- COMPLIANCE LETTER CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="complianceLetterCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.complianceLetterCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group has-warning">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- COMPLIANCE LETTER CORRECTIONS MODAL END --}}

    {{-- QUALIFICATION LETTER CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="qualificationLetterCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.qualificationLetterCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group has-warning">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- QUALIFICATION  LETTER CORRECTIONS MODAL END --}}

    {{-- COMPLETION LETTER CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="completionLetterCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.completionLetterCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group has-warning">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- COMPLETION LETTER CORRECTIONS MODAL END --}}

    {{-- SUBMISSION LETTER CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="submissionLetterCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.submissionLetterCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group has-warning">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- SUBMISSION LETTER CORRECTIONS MODAL END --}}
    
    {{-- AUTHORIZATION LETTER CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="authorizationLetterCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.authorizationLetterCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group has-warning">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- AUTHORIZATION LETTER CORRECTIONS MODAL END --}}
    {{-- EXTERNAL QUALIFICATION LETTER CORRECTIONS MODAL --}}
    <div class="modal" tabindex="-1" id="externalQualificationLetterCorrectionsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.externalQualificationLetterCorrections', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Enviar correcciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group has-warning">
                            <label for="corrections">Correciones</label>
                            <textarea name="corrections" id="corrections" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- EXTERNAL QUALIFICATION LETTER CORRECTIONS MODAL END --}}

    {{-- QUALIFICATION LETTER APPROVAL MODAL --}}
    <div class="modal" tabindex="-1" id="qualificationLetterApprovalModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.qualificationLetterMarkAsApproved', [$student]) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Aprobar documento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <p class="description text-center">Calificación mínima aprobatoria 70</p>
                        <div class="form-group has-warning">
                            <div class="mb-0">
                            <label for="qualification" class="d-block text-dark letter">Calificacion</label>
                            </div>
                            <input placeholder="Ejemplo: 100" type="number" class="form-control" min="0" max="100" id="qualification" name="qualification">
                        </div>
                        <div class="form-group has-warning">
                            <div class="mb-0">
                            <label for="qualification_text" class="d-block text-dark letter">Calificación en letras</label>
                            </div>
                            <input placeholder="Ejemplo: Cien" type="text" class="form-control" maxlength="255" id="qualification_text" name="qualification_text">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- QUALIFICATION LETTER APPROVAL MODAL END --}}

    {{-- COMPLIANCE LETTER QUESTIONS MODAL --}}
    <div class="modal fade" tabindex="-1" id="complianceLetterQuestionsModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('students.complianceLetterAnswerQuestions', $student) }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Preguntas de carta de cumplimiento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @foreach ($student->complianceLetter->parentQuestions as $question)
                            <div class="form-group pb-0">
                                <label>
                                    <input type="checkbox" value="on" name="questions[{{ $question->id }}]" @if($question->is_fulfilled) checked @endif>
                                    {{ $question->name }}
                                </label>
                            </div>
                            <div class="form-group mb-4 has-warning">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Observación"
                                    name="observations[{{ $question->id }}]"
                                    value="{{ $question->observation }}"
                                />
                            </div>
                            @foreach ($question->children as $childQuestion)
                                <div class="form-group pl-3 pb-0 has-warning">
                                    <label>
                                        <input type="checkbox" value="on" name="questions[{{ $childQuestion->id }}]" @if($childQuestion->is_fulfilled) checked @endif>
                                        {{ $childQuestion->name }}
                                    </label>
                                </div>
                                <div class="form-group mb-4 pl-3 has-warning">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Observación"
                                        name="observations[{{ $childQuestion->id }}]"
                                        value="{{ $childQuestion->observation }}"
                                    />
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- COMPLIANCE LETTER QUESTIONS MODAL END --}}
@endpush
