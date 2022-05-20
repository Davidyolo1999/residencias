<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ASIGNACIÓN DE ASESOR INTERNO</title>
    <link rel="stylesheet" href="{{ asset('css/document-header.css') }}">
    <style>
        .request-date {
            text-align: right;
            margin-top: 0px;
            padding: 0 3rem;
        }

        .cuenta {

            padding: 0 1rem;
            margin-top: 0px;
        }

        .presente {
            text-align: left;
            padding: 0 3rem;
            margin-top: 10px;
        }

        .note {
            padding: 0 3rem;
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

        .table {
            width: 100%;
            padding: 0 3rem;
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

        @page {
            margin: 0cm 0cm;
        }

        body {
            margin: 200px 40px 160px;
        }

        .header {
            position: fixed;
            top: 35px;
            right: 40px;
            left: 40px;
        }

        .footer {
            position: fixed;
            bottom: 20px;
            right: 20px;
            left: 20px;
            height: 120px;
        }

        .mb {
            margin-bottom: 15px;
        }

    </style>
</head>

<body>
    <div class="header">
        <div class="mb">
            <img src="{{ asset('img/encabezado3.jpg') }}" align="top" alt="" style="height: 65px;">
        </div>

        <h1 class="title">UNIVERSIDAD MEXIQUENSE DEL BICENTENARIO</h1>
        <h2 class="subtitle">DIRECCIÓN ACADÉMICA</h2>
        <div class="internal-company-name">{{ $configuration->unit }}</div>
    </div>

    <div class="footer">
        <img src="{{ asset('img/abajo.jpg') }}" style="height: 120px; width: 100%;">
    </div>

    <main>
        <p class="document-name letra">ASIGNACIÓN DE ASESOR INTERNO</p>
        <div class="request-date letra mayus"><b>{{ $assignmentLetter->request_date_formatted }}</b> </div>

        <p class="letra">
        <table cellspacing="0" border="0" class="table">
            <tr>
                <td colspan="4"><b>Nombre del (a) Alumno(a):</b> {{ $student->full_name }} </td>
            </tr>
            <tr>
                <td><b>No. de Cuenta:</b> </td>
                <td class="tc">{{ $student->account_number }}</td>
                <td class="tc"><b>Carrera:</b> </td>
                <td class="tc">{{ $student->career->name }}</td>
            </tr>
        </table>
        <p class="presente letra"><b>P R E S E N T E:</b></p>
        </p>
        <p class="note letra">
            Por medio del presente le informo que el Profesor <b>{{ $student->teacher->full_name }}</b>
            será su asesor interno en la Residencia Profesional que realizará en el
            <b>{{ $externalCompany->business_name }}</b>,
            con el proyecto titulado <b>{{ $student->project->title }}</b>.
        </p>
        <p class="note letra">
            El avance del proyecto se revisará cada semana por parte del asesor interno,
            el cual emitirá una calificación. Dicha evaluación se registrará en el acta correspondiente que será
            proporcionada
            por el Departamento de Control Escolar.
            <br> <br>


            Sin otro asunto en particular, quedo de usted para cualquier aclaración, esperando contar con su valiosa
            participación y entrega puntual.
        </p>
        <br><br><br><br><br>
        <p class="subtitle letra"> <b>A T E N T A M E N T E</b> </p>
        <br>
        <div class="subtitle letra">
            <p class="mayus"> <b>
                    _________________________________
                    <br>
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
        <div class="c"> C.c.p. <b>{{ $student->teacher->full_name }} </b> .- Para su conocimiento.
        </div>
        <div class="c1"> Expediente/Minutario</b> </div>
    </main>
</body>

</html>
