@extends('layouts.main', ['activePage' => 'residency-process', 'title' => __(''), 'titlePage' => 'Estudiantes'])

@section('content')
    <div class="content">
        @if ($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        @if ($errors->isNotEmpty())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title text-white"><b>Proceso de Residencia Profesional</b></h4>
            </div>

            <div class="card-body">
                {{-- Solicitud de residencias --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.residency-request-btn')
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-info" data-target="#residencyRequestUploadDocModal"
                            data-toggle="modal" @if ($student->residencyRequest->signed_document) disabled @endif>
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a @if ($student->residencyRequest->signed_document)
                            href="{{ route('students.residencyRequestDownloadSignedDoc', $student) }}"
                            @endif
                            class="btn btn-block btn-success @if (!$student->residencyRequest->signed_document) disabled @endif"
                            target="_blank"
                            >
                            Ver documento
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-warning" data-toggle="modal"
                            data-target="#residencyRequestCorrectionsModal">
                            Ver correcciones
                        </button>
                    </div>
                </div>
                {{-- Solicitud de residencias end --}}

                {{-- Carta de presentación --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.presentation-letter-btn')
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-info" data-target="#presentationLetterUploadDocModal"
                            data-toggle="modal" @if ($student->presentationLetter->signed_document) disabled @endif>
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a @if ($student->presentationLetter->signed_document)
                            href="{{ route('students.presentationLetterDownloadSignedDoc', $student) }}"
                            @endif
                            class="btn btn-block btn-success @if (!$student->presentationLetter->signed_document) disabled @endif"
                            target="_blank"
                            >
                            Ver documento
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-warning" data-toggle="modal"
                            data-target="#presentationLetterCorrectionsModal">
                            Ver correcciones
                        </button>
                    </div>

                </div>
                {{-- Carta de presentación end --}}

                {{-- Carta de compromiso --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.commitment-letter-btn')
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-info" data-target="#commitmentLetterUploadDocModal"
                            data-toggle="modal" @if ($student->commitmentLetter->signed_document) disabled @endif>
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a @if ($student->commitmentLetter->signed_document)
                            href="{{ route('students.commitmentLetterDownloadSignedDoc', $student) }}"
                            @endif
                            class="btn btn-block btn-success @if (!$student->commitmentLetter->signed_document) disabled @endif"
                            target="_blank"
                            >
                            Ver documento
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-warning" data-toggle="modal"
                            data-target="#commitmentLetterCorrectionsModal">
                            Ver correcciones
                        </button>
                    </div>
                </div>
                {{-- Carta de compromiso end --}}

                {{-- Carta de aceptación --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.acceptance-letter-btn')
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-info" data-target="#acceptanceLetterUploadDocModal"
                            data-toggle="modal" @if ($student->acceptanceLetter->signed_document) disabled @endif>
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a @if ($student->acceptanceLetter->signed_document)
                            href="{{ route('students.acceptanceLetterDownloadSignedDoc', $student) }}"
                            @endif
                            class="btn btn-block btn-success @if (!$student->acceptanceLetter->signed_document) disabled @endif"
                            target="_blank"
                            >
                            Ver documento
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-warning" data-toggle="modal"
                            data-target="#acceptanceLetterCorrectionsModal">
                            Ver correcciones
                        </button>
                    </div>
                </div>
                {{-- Carta de aceptación end --}}

                {{-- Carta de asignación --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.assignment-letter-btn')
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-info" data-target="#assignmentLetterUploadDocModal"
                            data-toggle="modal" @if ($student->assignmentLetter->signed_document) disabled @endif>
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a @if ($student->assignmentLetter->signed_document)
                            href="{{ route('students.assignmentLetterDownloadSignedDoc', $student) }}"
                            @endif
                            class="btn btn-block btn-success @if (!$student->assignmentLetter->signed_document) disabled @endif"
                            target="_blank"
                            >
                            Ver documento
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-warning" data-toggle="modal"
                            data-target="#assignmentLetterCorrectionsModal">
                            Ver correcciones
                        </button>
                    </div>
                </div>
                {{-- Carta de asignación end --}}

                {{-- Anteproyecto --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.preliminary-letter-btn')
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-info" data-target="#preliminaryLetterUploadDocModal"
                            data-toggle="modal" @if ($student->preliminaryLetter->signed_document) disabled @endif>
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a @if ($student->preliminaryLetter->signed_document)
                            href="{{ route('students.preliminaryLetterDownloadSignedDoc', $student) }}"
                            @endif
                            class="btn btn-block btn-success @if (!$student->preliminaryLetter->signed_document) disabled @endif"
                            target="_blank"
                            >
                            Ver documento
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-warning" data-toggle="modal"
                            data-target="#preliminaryLetterCorrectionsModal">
                            Ver correcciones
                        </button>
                    </div>
                </div>
                {{-- Anteproyecto end --}}

                {{-- Estructura de informe --}}
                <div class="row">
                    <div class="col-md-8">
                        @if (!$student->paperStructure->exists)
                            <button class="btn btn-block btn-info" data-target="#paperStructureUploadDocModal"
                                data-toggle="modal" @if (!$student->approvedPreliminaryletter) disabled @endif>
                                Cargar Estructura del informe final
                            </button>
                        @else
                            <a href="{{ route('students.paperStructureDownloadSignedDoc', $student) }}"
                                class="btn btn-block btn-{{ $student->paperStructure->btn_color }}" target="_blank">
                                Estructura del informe final
                            </a>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-block btn-warning" data-toggle="modal"
                            data-target="#paperStructureCorrectionsModal">
                            Ver correcciones
                        </button>
                    </div>
                </div>
                {{-- Estructura de informe end --}}

                {{-- Cédula de cumplimiento RP --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.compliance-letter-btn')
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-info" data-target="#complianceLetterUploadDocModal"
                            data-toggle="modal" @if ($student->complianceLetter->signed_document) disabled @endif>
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a @if ($student->complianceLetter->signed_document)
                            href="{{ route('students.complianceLetterDownloadSignedDoc', $student) }}"
                            @endif
                            class="btn btn-block btn-success @if (!$student->complianceLetter->signed_document) disabled @endif"
                            target="_blank"
                            >
                            Ver documento
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-warning" data-toggle="modal"
                            data-target="#complianceLetterCorrectionsModal">
                            Ver correcciones
                        </button>
                    </div>
                </div>
                {{-- Cédula de cumplimiento RP end --}}

                {{-- Acta de calificación --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.qualification-letter-btn')
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-info" data-target="#qualificationLetterUploadDocModal"
                            data-toggle="modal" @if ($student->qualificationLetter->signed_document) disabled @endif>
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a @if ($student->qualificationLetter->signed_document)
                            href="{{ route('students.qualificationLetterDownloadSignedDoc', $student) }}"
                            @endif
                            class="btn btn-block btn-success @if (!$student->qualificationLetter->signed_document) disabled @endif"
                            target="_blank"
                            >
                            Ver documento
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-block btn-warning" data-toggle="modal"
                            data-target="#qualificationLetterCorrectionsModal">
                            Ver correcciones
                        </button>
                    </div>
                </div>
                {{-- Acta de calificación end --}}

                {{-- Carta de Término --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.completion-letter-btn')
                    </div>

                    <div class="col-md-2">
                        <button 
                            class="btn btn-block btn-info" 
                            data-target="#completionLetterUploadDocModal"
                            data-toggle="modal" @if ($student->completionLetter->signed_document) disabled @endif>
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a 
                            @if ($student->completionLetter->signed_document)
                            href="{{ route('students.completionLetterDownloadSignedDoc', $student) }}"
                            @endif
                            class="btn btn-block btn-success @if (!$student->completionLetter->signed_document) disabled @endif"
                            target="_blank"
                            >
                            Ver documento
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button 
                        class="btn btn-block btn-warning" 
                        data-toggle="modal"
                        data-target="#completionLetterCorrectionsModal">
                            Ver correcciones
                        </button>
                    </div>
                </div>
                {{-- Carta de Término end --}}

                {{-- Carta de Entrega de Proyecto --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.submission-letter-btn')
                    </div>

                    <div class="col-md-2">
                        <button 
                            class="btn btn-block btn-info" 
                            data-target="#submissionLetterUploadDocModal"
                            data-toggle="modal" @if ($student->submissionLetter->signed_document) disabled @endif>
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a 
                            @if ($student->submissionLetter->signed_document)
                            href="{{ route('students.submissionLetterDownloadSignedDoc', $student) }}"
                            @endif
                            class="btn btn-block btn-success @if (!$student->submissionLetter->signed_document) disabled @endif"
                            target="_blank"
                            >
                            Ver documento
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button 
                        class="btn btn-block btn-warning" 
                        data-toggle="modal"
                        data-target="#submissionLetterCorrectionsModal">
                            Ver correcciones
                        </button>
                    </div>
                </div>
                {{-- Carta de Entrega de Proyecto end --}}

                {{-- Autorización de uso de Información --}}
                <div class="row">
                    <div class="col-md-6">
                        @include('residency-process.partials.authorization-letter-btn')
                    </div>
                    <div class="col-md-2">
                        <button 
                            class="btn btn-block btn-info" 
                            data-target="#authorizationLetterUploadDocModal"
                            data-toggle="modal" @if ($student->authorizationLetter->signed_document) disabled @endif>
                            Cargar documento
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a 
                            @if ($student->authorizationLetter->signed_document)
                            href="{{ route('students.authorizationLetterDownloadSignedDoc', $student) }}"
                            @endif
                            class="btn btn-block btn-success @if (!$student->authorizationLetter->signed_document) disabled @endif"
                            target="_blank"
                            >
                            Ver documento
                        </a>
                    </div>
                    <div class="col-md-2">
                        <button 
                        class="btn btn-block btn-warning" 
                        data-toggle="modal"
                        data-target="#authorizationLetterCorrectionsModal">
                            Ver correcciones
                        </button>
                    </div>
                </div>
                {{-- Autorización de uso de Información end --}}
            </div>
        </div>
    </div>
@endsection


@push('modals')
    {{-- CORRECTIONS MODAL --}}
    @if ($student->residencyRequest->corrections->isNotEmpty())
        <div class="modal" tabindex="-1" id="residencyRequestCorrectionsModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('students.residencyRequestMarkCorrectionsAsSolved') }}" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Enviar correcciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <ul>
                                @foreach ($student->residencyRequest->corrections as $correction)
                                    <li>{{ $correction->content }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" @if (!$student->residencyRequest->needsCorrections()) disabled @endif>Marcar como corregida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- UPLOAD DOC MODAL --}}
    <div class="modal" tabindex="-1" id="residencyRequestUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.residencyRequestUploadSignedDoc', $student) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar documento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="signed_document_rr">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_rr"
                                accept="application/pdf" required>
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

    {{-- UPLOAD DOC PRESENTATION LETTER MODAL --}}
    <div class="modal" tabindex="-1" id="presentationLetterUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.presentationLetterUploadSignedDoc', $student) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar documento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-file-upload" >
                            <label for="signed_document_pl">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_pl"
                                accept="application/pdf" required>
                        </div>

                        {{-- <div class="form-group form-file-upload form-file-multiple">
                            <input type="file" id="document_input" class="inputFileHidden">
                            <div class="input-group">
                                <label for="document_input" class="form-control inputFileVisible">Cargar archivo</label>
                                <span class="input-group-btn">
                                    <label for="document_input" type="button" class="btn btn-fab btn-round btn-primary">
                                        <i class="material-icons">attach_file</i>
                                    </label>
                                </span>
                            </div>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- UPLOAD DOC COMMITMENT LETTER MODAL --}}
    <div class="modal" tabindex="-1" id="commitmentLetterUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.commitmentLetterUploadSignedDoc', $student) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar documento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="signed_document_cl">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_cl"
                                accept="application/pdf" required>
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

    {{-- UPLOAD DOC ACCEPTANCE LETTER MODAL --}}
    <div class="modal" tabindex="-1" id="acceptanceLetterUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.acceptanceLetterUploadSignedDoc', $student) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar carta de aceptación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="signed_document_al">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_al"
                                accept="application/pdf" required>
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
    {{-- UPLOAD DOC PAPER STRUCTURE MODAL --}}
    <div class="modal" tabindex="-1" id="paperStructureUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.paperStructureUploadSignedDoc', $student) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar estructura del informe final</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="signed_document_ps1">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_ps1"
                                accept="application/pdf" required>
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

    {{-- UPLOAD DOC ASSIGNMENT LETTER MODAL --}}
    <div class="modal" tabindex="-1" id="assignmentLetterUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.assignmentLetterUploadSignedDoc', $student) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar asignación de asesor interno</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="signed_document_asl">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_asl"
                                accept="application/pdf" required>
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

    {{-- UPLOAD DOC PRELIMINARY LETTER MODAL --}}
    <div class="modal" tabindex="-1" id="preliminaryLetterUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.preliminaryLetterUploadSignedDoc', $student) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar anteproyecto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="signed_document_prl">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_prl"
                                accept="application/pdf" required>
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

    {{-- UPLOAD DOC COMPLIANCE LETTER MODAL --}}
    <div class="modal" tabindex="-1" id="complianceLetterUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.complianceLetterUploadSignedDoc', $student) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar cedula de cumpliento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="signed_document_crl">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_crl"
                                accept="application/pdf" required>
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

    {{-- UPLOAD DOC QUALIFICATION LETTER MODAL --}}
    <div class="modal" tabindex="-1" id="qualificationLetterUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.qualificationLetterUploadSignedDoc', $student) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar carta de calificación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="signed_document_qrl">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_qrl"
                                accept="application/pdf" required>
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
    {{-- UPLOAD DOC COMPLETION LETTER MODAL --}}
    <div class="modal fade" tabindex="-1" id="completionLetterUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.completionLetterUploadSignedDoc', $student) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar carta de término</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="signed_document_ct1">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_ct1"
                                accept="application/pdf" required>
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
    {{-- UPLOAD DOC SUBMISSION LETTER MODAL --}}
    <div class="modal" tabindex="-1" id="submissionLetterUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.submissionLetterUploadSignedDoc', $student) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar carta de entrega de proyecto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="signed_document_sl1">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_sl1"
                                accept="application/pdf" required>
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
    {{-- UPLOAD DOC AUTHORIZATION LETTER MODAL --}}
    <div class="modal" tabindex="-1" id="authorizationLetterUploadDocModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('students.authorizationLetterUploadSignedDoc', $student) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Cargar carta de autorización de uso de Información</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="signed_document_al1">Documento</label>
                            <input type="file" class="form-control" name="signed_document" id="signed_document_al1"
                                accept="application/pdf" required>
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

    {{-- CORRECTIONS MODAL --}}
    @if ($student->presentationLetter->corrections->isNotEmpty())
        <div class="modal" tabindex="-1" id="presentationLetterCorrectionsModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('students.presentationLetterMarkCorrectionsAsSolved', $student) }}"
                        method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Enviar correcciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <ul>
                                @foreach ($student->presentationLetter->corrections as $correction)
                                    <li>{{ $correction->content }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" @if (!$student->presentationLetter->needsCorrections()) disabled @endif>Marcar como corregida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- CORRECTIONS MODAL --}}
    @if ($student->commitmentLetter->corrections->isNotEmpty())
        <div class="modal" tabindex="-1" id="commitmentLetterCorrectionsModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('students.commitmentLetterMarkCorrectionsAsSolved', $student) }}"
                        method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Enviar correcciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <ul>
                                @foreach ($student->commitmentLetter->corrections as $correction)
                                    <li>{{ $correction->content }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" @if (!$student->commitmentLetter->needsCorrections()) disabled @endif>Marcar como corregida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    {{-- CORRECTIONS MODAL --}}
    @if ($student->acceptanceLetter->corrections->isNotEmpty())
        <div class="modal" tabindex="-1" id="acceptanceLetterCorrectionsModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('students.acceptanceLetterMarkCorrectionsAsSolved', $student) }}"
                        method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Enviar correcciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <ul>
                                @foreach ($student->acceptanceLetter->corrections as $correction)
                                    <li>{{ $correction->content }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" @if (!$student->acceptanceLetter->needsCorrections()) disabled @endif>Marcar como corregida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    {{-- CORRECTIONS MODAL --}}
    @if ($student->paperStructure->corrections->isNotEmpty())
        <div class="modal" tabindex="-1" id="paperStructureCorrectionsModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('students.paperStructureMarkCorrectionsAsSolved', $student) }}" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Enviar correcciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <ul>
                                @foreach ($student->paperStructure->corrections as $correction)
                                    <li>{{ $correction->content }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" @if (!$student->paperStructure->needsCorrections()) disabled @endif>Marcar como corregida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- CORRECTIONS MODAL --}}
    @if ($student->assignmentLetter->corrections->isNotEmpty())
        <div class="modal" tabindex="-1" id="assignmentLetterCorrectionsModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('students.assignmentLetterMarkCorrectionsAsSolved') }}" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Enviar correcciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <ul>
                                @foreach ($student->assignmentLetter->corrections as $correction)
                                    <li>{{ $correction->content }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" @if (!$student->assignmentLetter->needsCorrections()) disabled @endif>Marcar como corregida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- CORRECTIONS MODAL --}}
    @if ($student->preliminaryLetter->corrections->isNotEmpty())
        <div class="modal" tabindex="-1" id="preliminaryLetterCorrectionsModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('students.preliminaryLetterMarkCorrectionsAsSolved') }}" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Enviar correcciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <ul>
                                @foreach ($student->preliminaryLetter->corrections as $correction)
                                    <li>{{ $correction->content }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" @if (!$student->preliminaryLetter->needsCorrections()) disabled @endif>Marcar como corregida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- CORRECTIONS MODAL --}}
    @if ($student->complianceLetter->corrections->isNotEmpty())
        <div class="modal" tabindex="-1" id="complianceLetterCorrectionsModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('students.complianceLetterMarkCorrectionsAsSolved') }}" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Enviar correcciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <ul>
                                @foreach ($student->complianceLetter->corrections as $correction)
                                    <li>{{ $correction->content }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" @if (!$student->complianceLetter->needsCorrections()) disabled @endif>Marcar como corregida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- CORRECTIONS MODAL --}}
    @if ($student->submissionLetter->corrections->isNotEmpty())
        <div class="modal" tabindex="-1" id="submissionLetterCorrectionsModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('students.submissionLetterMarkCorrectionsAsSolved') }}" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Enviar correcciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <ul>
                                @foreach ($student->submissionLetter->corrections as $correction)
                                    <li>{{ $correction->content }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" @if (!$student->submissionLetter->needsCorrections()) disabled @endif>Marcar como corregida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    {{-- CORRECTIONS MODAL --}}
    @if ($student->authorizationLetter->corrections->isNotEmpty())
        <div class="modal" tabindex="-1" id="authorizationLetterCorrectionsModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('students.authorizationLetterMarkCorrectionsAsSolved') }}" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Enviar correcciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <ul>
                                @foreach ($student->authorizationLetter->corrections as $correction)
                                    <li>{{ $correction->content }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" @if (!$student->authorizationLetter->needsCorrections()) disabled @endif>Marcar como corregida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- CORRECTIONS MODAL --}}
    @if ($student->qualificationLetter->corrections->isNotEmpty())
        <div class="modal" tabindex="-1" id="qualificationLetterCorrectionsModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('students.qualificationLetterMarkCorrectionsAsSolved') }}" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Enviar correcciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <ul>
                                @foreach ($student->qualificationLetter->corrections as $correction)
                                    <li>{{ $correction->content }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" @if (!$student->qualificationLetter->needsCorrections()) disabled @endif>Marcar como corregida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- CORRECTIONS MODAL --}}
    @if ($student->completionLetter->corrections->isNotEmpty())
        <div class="modal" tabindex="-1" id="completionLetterCorrectionsModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('students.completionLetterMarkCorrectionsAsSolved') }}" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Enviar correcciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <ul>
                                @foreach ($student->completionLetter->corrections as $correction)
                                    <li>{{ $correction->content }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" @if (!$student->completionLetter->needsCorrections()) disabled @endif>Marcar como corregida</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

@endpush
