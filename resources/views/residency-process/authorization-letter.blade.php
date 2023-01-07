<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AUTORIZACIÓN DE USO DE iNFORMACIÓN</title>
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
    <div class="document-name letra"></div>
    <br>
    <br>
    <div class="request-date letra"><b style="color: red;">Municipio</b><b>, Edo. Méx. a  {{ $authorizationLetter->request_date_formatted }}</b> </div>
    <br>
    <div class="request-date letra"><b>ASUNTO:</b> <b style="text-decoration: underline;">Autorización de uso de información</b> </div>
    <br>
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
        Por este medio, me permito comunicarle que 
        @if ($student->sex == 'm')
        el alumno
        @else
        la alumna
        @endif
        <b>{{ $student->full_name }}</b> con número de cuenta
        <b>{{ $student->account_number }}</b> 
        @if ($student->sex == 'm')
        adscrito
        @else
        adscrita
        @endif
        en el noveno semestre de la <b>{{ $student->career->name }}</b>, 
        de la <b>{{ $configuration->unit }}</b>, tiene la autorización 
        para hacer el uso de impresión de la información privada (logotipo, nombre de la empresa y datos), 
        exclusivamente para el desarrollo del Proyecto de Residencia titulado: <b>{{ $project->title }}</b> por 
        lo cual se le solicita 
        @if ($student->sex == 'm')
        al alumno
        @else
        a la alumna
        @endif
        el uso correcto de ellos y solo para fines académicos.
    </p>
    <p class="note letra">
        Se extiende la presente para los fines que al interesado convengan. Quedando a sus órdenes para cualquier duda o aclaración.
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
</html>