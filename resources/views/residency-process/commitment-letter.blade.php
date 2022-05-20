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
            font-family: 'Gill Sans', 'Gill Sans MT';
            text-align: left;
            margin-top: 0px;
            padding: 0 1rem;
            font-size: 10px;
        }

        .c1 {
            font-family: 'Gill Sans', 'Gill Sans MT';
            text-align: left;
            margin-top: 0px;
            padding: 0 3.5rem;
            font-size: 10px;
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

        .mayus {
            text-transform: uppercase;
        }

        .letra {
            font-family: 'Gill Sans', 'Gill Sans MT';
            font-size: 14px;
        }
        .tc {
            text-align: center;
        }

    </style>
</head>

<body>
    @include('residency-process.partials.header', ['title' => 'CARTA COMPROMISO'])
    <div class="request-date letra"><b>No. RPA/
            {{ $student->career->abreviation }}/{{ str_pad($student->user_id, 4, '0', STR_PAD_LEFT) }}/{{ date('Y') }}</b>
    </div>
    <div class="request-date letra mayus"><b>{{ $commitmentLetter->request_date_formatted }}</b> </div>

    <p class="mayus letra"> <b>
            <table cellspacing="0" border="0" width="60%">
                <tr>
                    <td class="person">{{ $externalCompany->person_in_charge }}</td>
                </tr>
                <tr>
                    <td class="cargo"> {{ $externalCompany->person_in_charge_position }} </td>
                </tr>
            </table>

        </b>
    <p class="presente letra"><b>P R E S E N T E:</b></p>
    </p>
    <br>
    <p class="note letra">
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
    <br><br><br><br><br><br>

    <p class="subtitle letra"> <b>A T E N T A M E N T E</b> </p>
    <br>
    <div class="subtitle letra">
        <p class="mayus"> <b>
                {{ $configuration->person_in_charge }}
                <br>
                <table cellspacing="0" border="0" width="55%" align="center">
                    <td class="tc">{{ $configuration->person_in_charge_position }}</td>
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
    <br>
    <div class="c"> c.c.p. Residente.</b> </div>
    <div class="c1"> Expediente/Minutario.</b> </div>
</body>

</html>
