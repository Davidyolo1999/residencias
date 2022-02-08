<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Constancia de Entrega de Proyecto</title>
    <link rel="stylesheet" href="{{ asset('css/document-header.css') }}">
    <style>
  .request-date {
            text-align: right;
            margin-top: 0px;
            padding: 1 1rem;
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
    <div class="document-name">CONSTANCIA DE ENTREGA DE PROYECTO</div>
    <br>
    <br>
    <div class="request-date"><b>{{$submissionLetter->request_date_formatted}}</b> </div>
    <div class="person"><b>LCDA. BRENDA GONZÁLEZ PACHECO</b></div>
    <div class="cargo"><b>COORDINADORA DE LA UNIDAD DE ESTUDIOS SUPERIORES VILLA VICTORIA</b></div>
    <div class="person"><b>UNIVERSIDAD MEXIQUENSE DEL BICENTENARIO</b></div>
    <div class="person"><b>PRESENTE:</b></div>
    <br>
    <p class="note">
        Hago de su conocimiento que el alumno <b>{{ $student->full_name }}</b>  con número de cuenta
        <b>{{ $student->account_number }}</b>, quien cursa la carrera de <b>{{ $student->career->name }}</b>, elaboró un proyecto
        durante su Residencia Profesional, para el Área de Unidad de Tecnologías de la
        Información de la empresa denominada: <b>{{ $externalCompany->business_name }}</b>,
        <b>{{ $project->title }}</b> el cual por su cumplimiento en tiempo y forma ante los
        requerimientos solicitados, a través de este documento se hace CONSTAR que dicho
        proyecto fue entregado y aceptado en esta empresa el día <b>{{$submissionLetter->request_date_formatted}}</b>.
        <br>
        <br>
        Sin más por el momento y por la atención brindada al presente, quedo a sus órdenes para
        cualquier duda y/o aclaración al respecto.
    </p>
    <br><br><br><br><br>
    <br><br>
    <p class="subtitle"> <b>ATENTAMENTE</b> </p>
    <br>
    <div class="subtitle">
        <p> <b>
                _________________________________
                <br>
                {{ $externalCompany->person_in_charge }}
                <br>
                {{ $externalCompany->person_in_charge_position}}
        </p>
    </div>
</body>

</html>
