<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ACTA DE CALIFICACIÓN DE RESIDENCIAS PROFESIONALES</title>
    <link rel="stylesheet" href="{{ asset('css/document-header.css') }}">
    <style>
        .footer {
            

            position: fixed;
            bottom: -30px;
            right: 0;
            left: 0;
            height: 100px;
        }

        .student-signature,
        .person-in-charge-signature {
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
            margin-top: 0px;
            padding: 0 1rem;
        }

        .tc {
            text-align: center;
        }

        .letra {
            font-family: 'Gill Sans', 'Gill Sans MT';
            font-size: 14px;
        }
        .mayus {
            text-transform: uppercase;
        }

    </style>
</head>

<body>
    
    @include('residency-process.partials.header', [
        'title' => 'ACTA DE CALIFICACIÓN DE RESIDENCIAS PROFESIONALES',
    ])
    <br>
    <p class="request-date letra"><b>Villa Victoria, México a {{ $qualificationLetter->request_date_formatted }}</b></p>
    
    <table border="1" cellspacing="0" width="100%" class="letra">
        <tr>
            <td colspan="2">
        @if ($student->sex == 'm')
        Nombre del Alumno:
        @else
        Nombre de la alumna:
        @endif
        {{ $student->full_name }} </td>
            <td class="tc">No. de Cuenta: {{ $student->account_number }}</td>
        </tr>
        <tr>
            <td colspan="3" height="4%">Nombre de la Empresa, Organismo o Dependencia:
                {{ $externalCompany->business_name }}</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: justify;">Nombre del Proyecto: {{ $project->title }}</td>
        </tr>
        <tr>
            <td align="center">Fecha de Inicio <br> {{ $student->project->start_date_formatted }}</td>
            <td align="center">Fecha de Terminación <br> {{ $student->project->end_date_formatted }}</td>
            <td align="center">No. de Control: <br> RPA/
                {{ $student->career->abreviation }}/{{ str_pad($student->user_id, 4, '0', STR_PAD_LEFT) }}/{{ date('Y') }}
            </td>
        </tr>
        <tr>
            <td widht="50%" colspan="2">Nombre del Asesor Externo: <br> {{ $student->externalAdvisor->full_name }}
            </td>
            <td widht="50%" align="center">Cargo: <br> {{ $student->externalAdvisor->charge }}</td>
        </tr>
        <tr>
            <td colspan="3">Nombre del Asesor Interno: <br> {{ $student->teacher->full_name }} </td>
        </tr>
    </table>
    <br>
    <br>
    <table border="1" width="50%" cellspacing="0" align="center" class="letra">

        <tr>
            <td colspan="2" align="center"  height="4%"><b>Calificación</b></td>
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
    <div class="footer letra">
        <p class="student-signature">{{ $student->teacher->full_name }} <br>Asesor Interno</p>
        <p class="person-in-charge-signature">
            {{ $configuration->person_in_charge }}
            <br>
            {{ $configuration->person_in_charge_position_abbreviation }}
        </p>
        
    </div>
    

</body>

</html>
