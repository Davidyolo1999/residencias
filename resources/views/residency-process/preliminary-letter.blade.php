<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ANTEPROYECTO DE RESIDENCIAS PROFESIONALES</title>
    <link rel="stylesheet" href="{{ asset('css/document-header.css') }}">

    <style>
        .info {
            text-align: center;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .table {
            width: 100%;
            margin-bottom: 30px;
        }

        .table div {
            font-size: 1.5em;
        }

        .justify {
            text-align: justify;
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

        .foo {
            position: fixed;
            bottom: -20px;
            right: 0;
            left: 0;
            height: 120px;
        }
        .letra {
            font-family: 'Gill Sans', 'Gill Sans MT';
            font-size: 14px;
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
    <main>
        <p class="document-name">ANTEPROYECTO DE RESIDENCIAS PROFESIONALES</p>
        <section>
        <p class="info"> <b> DATOS DEL ALUMNO </b></p>
        
        
        <table border="1" cellspacing="2" cellpadding="0" class="table letra">
            <tbody>
                <tr>
                    <td width="12%" height="4%" class="tc">Nombre:</td>
                    <td colspan="3">&nbsp;{{ $student->first_name }} {{ $student->fathers_last_name }}
                        {{ $student->mothers_last_name }}</td>
                </tr>
                <tr>
                    <td height="4%" class="tc">Carrera:</td>
                    <td> &nbsp;{{ $student->career->name }}</td>
                    <td width="13%" class="tc">No. Cuenta</td>
                    <td width="20%" class="tc"> {{ $student->account_number }}</td>
                </tr>
            </tbody>
        </table>

        <p class="info"> <b> DATOS DE LA EMPRESA O INSTITUCIÓN </b></p>
        
        <table border="1" cellspacing="2" cellpadding="0" class="table letra">
            <tr>
                <td width="17%" height="4%" class="tc">Razón Social:</td>
                <td colspan="5"> &nbsp;{{ $externalCompany->business_name }}</td>
            </tr>

            <tr>
                <td height="4%" class="tc">Giro Comercial:</td>
                <td colspan="5"> &nbsp;{{ $externalCompany->commercial_business }}</td>
            </tr>

            <tr>
                <td height="9%" class="tc">Domicilio:</td>
                <td colspan="3" style="text-align: justify;"> {{ $externalCompany->address_name }}</td>
                <td width="8%" class="tc">C.P:</td>
                <td width="10%" style="text-align: center;"> {{ $externalCompany->zip_code }}</td>
            </tr>

            <tr>
                <td width="17%" height="4%" colspan="2" class="tc">Departamento solicitante del proyecto:</td>
                <td width="60%" colspan="4"> &nbsp;{{ $externalCompany->Department_requesting_project}}</td>
            </tr>

            <tr>
                <td width="17%" height="4%" colspan="2" class="tc">Nombre y cargo del responsable directo del Departamento:</td>
                <td width="60%" colspan="4"> {{ $externalCompany->person_in_charge }} ,
                    {{ $externalCompany->person_in_charge_position }}</td>
            </tr>

            <tr>
                <td height="4%" class="tc">Teléfono:</td>
                <td class="tc">{{ $externalCompany->office_phone_number }}</td>
                <td width="10%" class="tc">Ext.:</td>
                <td> </td>
                <td class="tc">E-mail:</td>
                <td class="tc">{{ $externalCompany->email }}</td>
            </tr>

        </table>
    </section>
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
    <section>
        <p class="info"> <b> DATOS DEL PROYECTO </b></p>
        <table border="1" cellspacing="2" cellpadding="0" class="table letra">
            <tr>
                <td width="20%" height="8%" class="tc">Titulo del proyecto:</td>
                <td colspan="3" class="tc">{{ $project->title }}</td>
            </tr>
            <tr>
                <td height="11%" class="tc">Objetivo General:</td>
                <td colspan="3" class="justify">{{ $project->general_objective }}</td>
            </tr>
            <tr>
                <td height="35%" class="tc">Objetivos Específicos:</td>
                <td colspan="3" class="justify">
                    <ol type=”A”>
                        @foreach ($project->specificObjectives as $obj)
                            <li>{{ $obj->name }}</li>
                        @endforeach
                    </ol>
                </td>
            </tr>
            <tr>
                <td height="85%" class="tc">Justificación del proyecto:</td>
                <td colspan="3" class="justify">{{ $project->justification }}</td>
            </tr>
        </table>
    </section>
        <br>
        <br>
        <br>
        <br>
    <section>
        <table border="1" cellspacing="2" cellpadding="0" class="table letra">
            <tr>
                <td height="8%" class="tc">Horario requerido de trabajo:</td>
                <td colspan="3">&nbsp;{{ $project->schedule }}</td>
            </tr>
            <tr>
                <td height="4%" class="tc">Fecha de Inicio:</td>
                <td style="text-align:center;">{{ $student->project->start_date_formatted }}</td>
                <td width="20%" class="tc">Fecha de Término:</td>
                <td style="text-align:center;">{{ $project->end_date->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td height="4%" class="tc">Nombre del Asesor Interno:</td>
                <td colspan="3">&nbsp;{{ $student->teacher->full_name }}</td>
            </tr>
            <tr>
                <td height="4%" class="tc">Nombre del Asesor Externo:</td>
                <td colspan="3">&nbsp;{{ $student->externalAdvisor->full_name }}</td>
            </tr>
            <tr>
                <td height="45%" colspan="4" class="tc">
                    <p>Anexar: Cronograma de Actividades
                        <img src="{{ asset($project->activity_schedule_image_url) }}" alt="" style="height: 455px">
                    </p>
                </td>

            </tr>
        </table>
    </section>
        <div class="foo letra">
            <b>
                <table border="0" cellspacing="0" cellpadding="0" style="width: 100%; text-align:center;">
                    <tr>
                        <td width="33.3333%">
                            _______________________
                            <br>
                            {{ $student->full_name }}
                            <br>
                            Alumno
                        </td>
                        <td width="33.3333%">
                            _______________________
                            <br>
                            {{ $student->teacher->full_name }}
                            <br>
                            Asesor Interno
                        </td>
                        <td width="33.3333%">
                            _______________________
                            <br>
                            {{ $student->externalAdvisor->full_name }}
                            <br>
                            Asesor Externo
                        </td>
                    </tr>
                </table>
            </b>
        </div>
    </main>
</body>

</html>
