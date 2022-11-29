<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REVISIÓN DE AVANCES DE RESIDENCIAS PROFESIONALES DE {{ $student->full_name }} </title>
    <style>
        .title,
        .subtitle {
            text-align: center;
            font-size: 1.3rem;
            margin-bottom: 5px;
        }

        .subtitle {
            margin-top: 0;
            font-size: 1.15rem;
        }

        .internal-company-name {
            text-align: center;
            font-size: 1.15rem;
        }

        .document-name,
        .table-title {
            font-weight: bold;
            text-align: center;
        }

        .table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        .note {
            padding: 0 5rem;
            line-height: 23px;
            text-align: justify;
        }

        .footer {
            position: fixed;
            bottom: -30px;
            right: 0;
            left: 0;
            height: 100px;
        }

        .title-td {
            background: rgb(218, 218, 218);
            color: black;
            font-weight: bold;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
            padding-right: 5px;
            width: 20%;
        }

        
        .head-td {
            border-bottom: 1px solid black;
            text-transform: uppercase;
        }

        .th-progress {
            border: 1px solid black;
            background: rgb(218, 218, 218);
            color: black;
            font-weight: bold;
            text-transform: uppercase;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .progress-td {
            border: 1px solid black;
            padding-top: 15px;
            padding-bottom: 15px;
        }
        
        .justify {
            text-align: justify;
        }
        .center{
            text-align: center;
        }
    </style>
</head>

<body>
    @include('residency-process.partials.header', [
    'title' => 'REVISIÓN DE AVANCES DE RESIDENCIAS PROFESIONALES',
    ])
    <br>
    <table class="table">
        <tbody>
            <tr>
                <td class="title-td">
                    NOMBRE DEL ASESOR:
                </td>
                <td class="head-td">
                    &nbsp;{{$teacher->first_name ?? ''}} {{$teacher->fathers_last_name ?? ''}} {{$teacher->mothers_last_name
                    ?? ''}}
                </td>
                <td class="title-td">
                    FECHA DE INICIO:
                </td>
                <td class="head-td center" style="width: 20%;">
                    {{$project->start_date->format('d')}} de {{$project->start_date->format('F')}}
                    {{$project->start_date->format('Y')}}
                </td>
            </tr>
            <tr>
                <td class="title-td">
                    NOMBRE DEL ALUMNO:
                </td>
                <td class="head-td">
                    &nbsp;{{$student->first_name ?? ''}} {{$student->fathers_last_name ?? ''}} {{$student->mothers_last_name
                    ?? ''}}
                </td>
                <td class="title-td">
                    FECHA DE TÉRMINO:
                </td>
                <td class="head-td center" style="width: 15%;">
                    {{$project->end_date->format('d')}} de {{$project->end_date->format('F')}}
                    {{$project->end_date->format('Y')}}
                </td>
            </tr>
            <tr>
                <td class="title-td">
                    NOMBRE DEL PROYECTO:
                </td>
                <td class="head-td justify">
                    {{$project->title ?? ''}}
                </td>
                <td class="title-td" style="text-align: justify;">
                    MODALIDAD*:
                </td>
                <td class="head-td center" style="width: 15%;">
                    PROYECTO
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table class="table" border="0" style="text-align: center;">
        <tbody>
            <tr>
                <td class="th-progress" style="width: 5%;">
                    NP
                </td>
                <td class="th-progress" style="width: 15%;">
                    FECHA DE REVISIÓN
                </td>
                <td class="th-progress" style="width: 60%;">
                    DESCRIPCIÓN DEL AVANCE
                </td>
                <td class="th-progress" style="width: 20%;">
                    FIRMA DEL ALUMNO
                </td>
            </tr>
            @foreach ($project->projectProgress as $progress)
            <tr>
                <td class="progress-td">
                    {{$loop->index + 1}}
                </td>
                <td class="progress-td">
                    {{$progress->created_at->format('d/m/Y')}}
                </td>
                <td class="progress-td">
                    {{$progress->description}}
                </td>
                <td class="progress-td">

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <table class="debajo" border="0" align="center">
            <tr>
                <td align="right" style="font-size: 8px;">
                    <b>
                        SECRETARÍA DE EDUCACIÓN
                    </b>
                </td>
                <td width="5"></td>
                <td align="left" style="font-size: 8px;">
                    <b>UNIVERSIDAD MEXIQUENSE DEL BICENTENARIO</b>
                </td>
            </tr>
            <tr>
                <td align="right" style="font-size: 8px;">
                    SUBSECRETARÍA DE EDUCACIÓN MEDIA SUPERIOR Y SUPERIOR
                </td>
                <td width="5"></td>
                <td align="left" style="font-size: 8px;">
                    CARRETERA MÉXICO-TOLUCA KM.43.5
                </td>
            </tr>
            <tr>
                <td align="right" style="font-size: 8px;">
                    DIRECCIÓN GENERAL DE EDUCACIÓN SUPERIOR
                </td>
                <td width="5"></td>
                <td align="left" style="font-size: 8px;">
                    OCOYOACAC, MÉXICO. C.P. 52300
                </td>
            </tr>
            <tr>
                <td align="right"></td>
                <td width="5"></td>
                <td align="left" style="font-size: 8px;">
                    Correo E.: u.mexiquense.bicentenario@gmail.com
                </td>
            </tr>
        </table>
    </div>
</body>

</html>