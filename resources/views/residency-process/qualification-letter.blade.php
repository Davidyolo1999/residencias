<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acta de calificación</title>
    <link rel="stylesheet" href="{{ asset('css/document-header.css') }}">
    <style>
        .footer {
            bottom: -30px;
            right: 0;
            left: 0;
            height: 100px;
        }

        .student-signature, .person-in-charge-signature {
            width: 40%;
            text-align: center;
            padding: 5px 0 0;
            border-top: 1px solid black;
            float: left;
            font-weight: bold;
        }
        .person-in-charge-signature {
            float: right;
        }
        .request-date {
            text-align: right;
            margin-top: 30px;
        }
    </style>
</head>
<body>
        @include('residency-process.partials.header', ['title' => 'ACTA DE CALIFICACIÓN DE RESIDENCIAS PROFESIONALES'])
        <br>
        <table border="1" width="100%">
            <tr>
                <td colspan="2">Nombre del Alumno (a): {{ $student->full_name }} </td>
                <td>No. de Cuenta: {{ $student->account_number }}</td>
            </tr>
            <tr>
                <td colspan="3" height="4%">Nombre de la Empresa, Organismo o Dependencia: {{ $externalCompany->business_name }}</td>
            </tr>
            <tr>
                <td colspan="3">Nombre del Proyecto:{{ $project->title }}</td>
            </tr>
            <tr>
                <td align="center">Fecha de Inicio <br> {{ $project->start_date->format('Y-m-d') }}</td>
                <td align="center">Fecha de Terminación <br> {{ $project->start_date->format('Y-m-d') }}</td>
                <td align="center">No. de Control: <br> RPA/ {{ $student->career->abreviation }}/{{str_pad($student->user_id, 4,'0',STR_PAD_LEFT) }}/{{ date('Y') }}
                </td>
            </tr>
            <tr>
                <td widht="50%" colspan="2">Nombre del Asesor Externo: <br> {{ $student->externalAdvisor->full_name }}</td>
                <td widht="50%" align="center">Cargo: <br> {{ $student->externalAdvisor->charge }}</td>
            </tr>
            <tr>
                <td colspan="3">Nombre del Asesor Interno: <br> {{ $student->teacher->full_name }}  </td>
            </tr>
        </table>
        <br>
        <table border="1" width="50%" align="center">

            <tr>
                <td colspan="2" align="center" height="4%"><b>Calificación</b></td>
            </tr>
            <tr>
                <td align="center"><b>No.</b></td>
                <td align="center"><b>Letra</b></td>
            </tr>
            <tr>
                <td align="center"><b>{{ $qualificationLetter->qualification }}</b></td>
                <td align="center"><b>{{ $qualificationLetter->qualification_text }}</b></td>
            </tr>
        </table>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="footer">
            <p class="student-signature">{{ $student->teacher->full_name }}</p>
            <p class="person-in-charge-signature">
                {{ $configuration->person_in_charge }}
                <br>
                {{ $configuration->person_in_charge_position_abbreviation }}
            </p>
        </div>
        <div class="request-date">Villa Victoria, México a {{ $qualificationLetter->request_date_formatted }}.</div>


</body>
</html>
