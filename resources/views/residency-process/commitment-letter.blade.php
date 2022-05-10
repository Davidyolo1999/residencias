<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CARTA COMPROMISO</title>
    <link rel="stylesheet" href="{{ asset('css/document-header.css') }}">
    <style>
        .request-date {
            text-align: right;
            margin-top: 0px;
            padding: 0 1rem;
        }

        .note {
            padding: 0 1rem;
            text-align: justify;
        }

        .subtitle {
            margin-top: 1;
            font-size: 1rem;
        }

        .c {
            text-align: left;
            margin-top: 0px;
            padding: 0 1rem;
            font-size: 0.7rem;
        }

        .person {
            text-align: left;
            padding: 0 1rem;
            margin-top: 0px;
        }

        .cargo {
            text-align: left;
            padding: 0 1rem;
            margin-top: 0px;
        }

        .presente {
            text-align: left;
            padding: 0 1rem;
            margin-top: 0px;
        }
        .mayus{
            text-transform:uppercase;
        }

    </style>
</head>

<body>
    @include('residency-process.partials.header', ['title' => 'CARTA COMPROMISO'])
    <div class="request-date"><b>No. RPA/
            {{ $student->career->abreviation }}/{{ str_pad($student->user_id, 4, '0', STR_PAD_LEFT) }}/{{ date('Y') }}</b>
    </div>
    <div class="request-date"><b>{{ $commitmentLetter->request_date_formatted }} </b> </div>

    <div class="person"><b>{{ $externalCompany->person_in_charge }}</b></div>
    <div class="cargo"><b>{{ $externalCompany->person_in_charge_position }}</b></div>
    <br>
    <div class="presente"><b>PRESENTE:</b></div>
    <p class="note">
        Por este medio me permito saludarle atentamente y presentar a Usted

        @if ($student->sex == 'm')
            al
        @else
            a la
        @endif
        C. <b>{{ $student->full_name }}</b>, con
        número de Cuenta <b>{{ $student->account_number }}</b>,
        @if ($student->sex == 'm')
            alumno
        @else
            alumna
        @endif
        de nuestra casa de estudios de la
        <b>{{ $student->career->name }}</b> , quien
        desea realizar su Residencia Profesional por Proyecto.
        <br>
        <br>
        En espera de su amable respuesta, agradezco de antemano su fina atención a la presente; sabedora de su gran
        apoyo e impulso a la juventud en pro del desarrollo de nuestro país.
    </p>
    <br><br><br><br><br>
    <p class="subtitle"> <b>ATENTAMENTE</b> </p>
    <br>
    <div class="subtitle">
        <p class="mayus"> <b>
            {{ $configuration->person_in_charge }}
            <br>
            <table cellspacing="0" border="0" width="60%" align="center">
                <td width="10%" align="center"> {{ $configuration->person_in_charge_position}}      </td>
            </table>
            <br>
        </b>
        </p>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="c"> C.c.p. Residente.</b> </div>
    <div class="c"> Expediente/Minutario</b> </div>
</body>

</html>
