<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CONSTANCIA DE ENTREGA DE PROYECTO</title>
    <link rel="stylesheet" href="{{ asset('css/document-header.css') }}">
    <style>
        .request-date {
            text-align: right;
            margin-top: 0px;
            padding: 0 3rem;
        }

        .person {
            text-align: left;
            padding: 0 3rem;
            margin-top: 0px;
        }

        .cargo {
            text-align: left;
            padding: 0 3rem;
            margin-top: 0px;
        }

        .note {
            padding: 0 3rem;
            text-align: justify;
        }

        .subtitle {
            margin-top: 1;
            font-size: 1rem;
        }
        .mayus {
            text-transform: uppercase;
        }

        .letra {
            font-family: 'Gill Sans', 'Gill Sans MT';
            font-size: 14px;
        }
        .presente {
            text-align: left;
            margin-top: 0px;
            padding: 0 3rem;
        }
        .tc {
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="document-name letra">CONSTANCIA DE ENTREGA DE PROYECTO</div>
    <br>
    <br>
    <div class="request-date letra mayus"><b>{{ $submissionLetter->request_date_formatted }}</b> </div>
    <p class="mayus letra"> <b>
        <table cellspacing="0" border="0" width="100%">
            <tr>
                <td class="person">{{ $configuration->person_in_charge }}</td>
            </tr>
            <tr>
                <td class="cargo"> {{ $configuration->person_in_charge_position }}</td>
            </tr>
            <tr>
                <td class="cargo">UNIVERSIDAD MEXIQUENSE DEL BICENTENARIO</td>
            </tr>
        </table>

    </b>
<p class="presente letra"><b>P R E S E N T E:</b></p>
</p>
    <p class="note letra">
        Hago de su conocimiento que 
        @if ($student->sex == 'm')
            el alumno
        @else
            la alumna
        @endif
        <b>{{ $student->full_name }}</b> con número de cuenta
        <b>{{ $student->account_number }}</b>, quien cursa la carrera de <b>{{ $student->career->name }}</b>,
        elaboró un proyecto
        durante su Residencia Profesional, para el Área de {{ $externalCompany->Department_requesting_project}} de la empresa denominada: <b>{{ $externalCompany->business_name }}</b>,
        <b>{{ $project->title }}</b> el cual por su cumplimiento en tiempo y forma ante los
        requerimientos solicitados, a través de este documento se hace CONSTAR que dicho
        proyecto fue entregado y aceptado en esta empresa el día <b>{{ $submissionLetter->request_date_formatted }}</b>.
        <br>
        <br>
        Sin más por el momento y por la atención brindada al presente, quedo a sus órdenes para
        cualquier duda y/o aclaración al respecto.
    </p>
    <br><br><br><br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <p class="subtitle letra"> <b>ATENTAMENTE</b> </p>
    <br>
    <div class="subtitle letra">
        <p class="mayus"> <b>
                _________________________________
                <br>
                {{ $externalCompany->person_in_charge }}
                <br>
                <table cellspacing="0" border="0" width="55%" align="center">
                    <td class="tc">{{ $externalCompany->person_in_charge_position }}</td>
                </table>
                <br>
        </p>
    </div>
</body>

</html>
