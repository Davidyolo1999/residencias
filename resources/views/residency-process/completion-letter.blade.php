<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carta de Término</title>
    <link rel="stylesheet" href="{{ asset('css/document-header.css') }}">
    <style>
        .request-date {
            text-align: right;
            margin-top: 0px;
            padding: 1 1rem;
        }

        .c {
            text-align: left;
            margin-top: 0px;
            padding: 0 3rem;
            font-size: 0.7rem;
        }

        .e {
            text-align: left;
            margin-top: 0px;
            padding: 0 5.5rem;
            font-size: 0.7rem;
        }

        .person {
            text-align: left;
            padding: 1 1rem;
            margin-top: 0px;
        }

        .cargo {
            text-align: left;
            padding: 1 1rem;
            margin-top: 0px;
        }

        .note {
            padding: 1 1rem;
            text-align: justify;
        }

        .subtitle {
            margin-top: 1;
            font-size: 1rem;
        }

    </style>
</head>

<body>

    <div class="document-name">CARTA DE TERMINACIÓN</div>
    <br>
    <div class="request-date"><b>(Número de oficio de la empresa)</b> </div>
        <p class="request-date"><b>(Fecha)</b></p>
        <br>

        <div class="person"><b>XXXXXXXXXXXXXX</b></div>
        <div class="cargo"><b>COORDINADORA DE LA UNIDAD DE ESTUDIOS SUPERIORES XXXXXXXXXXX </b></div>
        <div class="person"><b>UNIVERSIDAD MEXIQUENSE DEL BICENTENARIO</b></div>
        <div class="person"><b>P R E S E N T E:</b></div>
        <br>

        <p class="note">
            Hago de su conocimiento que la alumna <b>{{ $student->full_name }} </b> con número de cuenta
            <b>{{ $student->account_number }}</b> quien cursa la carrera de la <b>{{ $student->career->name }}</b> ,
            terminó el proyecto
            denominado: <b>{{ $student->project->title }}</b> . Cubrió un total de 640 hrs. en un horario
            de <b>{{ $student->project->schedule }}</b> , el cual inició el día
            <b>{{ $student->project->start_date_formatted }} </b> y concluyó el día
            <b>{{ $student->project->end_date_formatted }}</b> .
        </p>

        <p class="note">
            Lo anterior a efecto de dar por concluido el trámite de Residencia Profesional de la alumna en esta empresa.
            <br>
            <br>
            Sin más por el momento, agradezco el apoyo brindado.
        </p>

        <br><br><br><br><br>
        <br><br>
        <p class="subtitle"> <b>ATENTAMENTE</b> </p>
        <br>
        <div class="subtitle">
            <p> <b>
                    _________________________________
                    <br>
                    Nombre completo
                    <br>
                    Cargo
                    <br>
                    Nombre de la Empresa
            </p>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="c"> C.c.p. Residente</div>
        <div class="e"> Expediente</b> </div>

</body>

</html>
