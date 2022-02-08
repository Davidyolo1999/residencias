<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carta de cumplimiento</title>
    <link rel="stylesheet" href="{{ asset('css/document-header.css') }}">
    <style>
        @page {
            margin: 0cm 0cm;
        }

        body {
            margin: 370px 40px 160px;
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
        .cuenta {
            text-align: left;
            margin-top: 0px;
        }
        .presente {
            text-align: left;
            margin-top: 0px;
            padding: 0 3rem;
        }
        .note {
            padding: 0 3rem;
            text-align: justify;
        }
        .subtitle {
            margin-top: 1;
            margin-bottom: 10px;
            font-size: 1rem;
        }
        .c {
            text-align: left;
            margin-top: 0px;
            padding: 0 3rem;
            font-size: 0.7rem;
        }

        .imagen{
            background-size: cover;
            background-size: 10rem;
            background-attachment: fixed;
        }

        .green-border {
            border: 1px dashed green;
        }

        .no-bt {
            border-top: none;
        }

        .mb {
            margin-bottom: 15px;
        }

        .padding {
            padding: 7px;
        }

        .no-m {
            margin: 0;
        }

        .table {
            width: 100%;
            border-collapse:collapse;
            border-bottom: 1px dashed #247A00;
            border-right: 1px dashed #247A00;
            font-size: 14px;
        }

        .table th, .table td {
            border-top: 1px dashed #247A00;
            border-left: 1px dashed #247A00;
            padding: 5px;
        }

        .table th {
            background-color: #2fa100;
            color: #000000;
        }

        .table .child {
            padding-left: 20px;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="mb">
            <img src="{{ asset('img/encabezado3.jpg') }}" align="top" alt="" style="height: 65px;">
        </div>

        <div class="green-border padding">
            <h1 class="title no-m">UNIVERSIDAD MEXIQUENSE DEL BICENTENARIO</h1>
            <h2 class="subtitle">DIRECCIÓN ACADÉMICA</h2>

            <div><b> Nombre del estudiante: </b>{{ $student->full_name }}</div>
            <div><b> Carrera: </b>{{ $student->career->name }}</div>
            <div><b> Unidad de Estudios Superiores de adscripción: </b>Unidad de Estudios Superiores Villa Victoria</div>
            <div><b> No. de Matricula: </b>{{ $student->account_number }}</div>
            <div><b> Nombre del Proyecto: </b>{{ $project->title }}</div>
        </div>
        <div class="green-border no-bt padding mb">
            <div><b> Unidad de Estudios Superiores receptora: </b>{{ $externalCompany->business_name }}</div>
            <div><b> Nombre del asesor externo: </b>{{ $student->externalAdvisor->full_name }}</div>
            <div><b> Carrera: </b>{{ $student->externalAdvisor->career }}</div>
        </div>
    </div>

    <div class="footer">
        <img src="{{ asset('img/abajo.jpg') }}" style="height: 120px; width: 100%;">
    </div>

    <main>
        <table class="table mb">
            <thead>
                <tr>
                    <th rowspan="2" width="40%">Requisito</th>
                    <th colspan="2">Cumple</th>
                    <th rowspan="2" width="40%">Observación</th>
                </tr>
                <tr>
                    <th>Si</th>
                    <th>No</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($complianceLetter->parentQuestions as $question)
                    <tr>
                        <td>{{ $question->name }}</td>
                        <td>
                            @if ($question->is_fulfilled)
                                <div class="text-center">&times;</div>
                            @endif
                        </td>
                        <td>
                            @if (!$question->is_fulfilled)
                                <div class="text-center">&times;</div>
                            @endif
                        </td>
                        <td>{{ $question->observation }}</td>
                    </tr>
                    @foreach ($question->children as $childQuestion)
                        <tr>
                            <td class="child">{{ $childQuestion->name }}</td>
                            <td>
                                @if ($childQuestion->is_fulfilled)
                                    <div class="text-center">&times;</div>
                                @endif
                            </td>
                            <td>
                                @if (!$childQuestion->is_fulfilled)
                                    <div class="text-center">&times;</div>
                                @endif
                            </td>
                            <td>{{ $childQuestion->observation }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <table class="table" style="text-align: center;">
            <tr>
                <td><b>Revisó</b></td>
                <td width="2%" style="border-top: 1px solid #fff;"></td>
                <td colspan="2"><b>Vo. Bo.</b></td>
            </tr>

            <tr>
                <td height="120px"></td>
                <td width="2%" style="border-top: 1px solid #fff;"></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td><b>{{ $student->externalAdvisor->full_name }}</b></td>
                <td width="2%" style="border-top: 1px solid #fff;border-bottom: 1px solid #fff;"></td>
                <td><b>{{ $externalCompany->person_in_charge }}</b></td>
                <td><b>Sello</b></td>
            </tr>
        </table>
    </main>
</body>
</html>
