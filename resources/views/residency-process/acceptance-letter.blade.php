<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CARTA DE ACEPTACIÓN</title>
    <link rel="stylesheet" href="{{ asset('css/document-header.css') }}">
    <style>
        .request-date {
            text-align: right;
            margin-top: 0px;
            padding: 0 3rem;
        }

        .presente {
            text-align: left;
            margin-top: 0px;
            padding: 0 3rem;
        }

        .e {
            text-align: left;
            margin-top: 0px;
            padding: 0 5.5rem;
            font-size: 0.7rem;
        }

        .person {
            text-align: left;
            padding: 0 3rem;
            margin-top: 0px;
        }

        .tc {
            text-align: center;
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

    </style>
</head>

<body>
    <div class="document-name letra" style="color: red;">(Hoja membretada de la empresa)</div>
    <p class="document-name letra">CARTA DE ACEPTACIÓN</p>
    <br>
    <div class="request-date letra"><b style="color: red;">(Número de oficio de la empresa)</b> </div>
    <div class="request-date letra"><b style="color: red;">Fecha: {{ $acceptanceLetter->request_date_formatted }}</b> </div>

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
        <b>{{ $student->account_number }}</b> quien cursa la carrera de <b>{{ $student->career->name }}</b>,
        fue aceptada en esta empresa para desarrollar un proyecto perfectamente definido, viable y dentro del área de especialidad a su carrera,
        denominado <b>{{ $student->project->title }}</b>, en la modalidad de Residencia por Proyecto; 
        se asignó como su asesor a <b style="color: red;">el/la nombre completo</b> y cubrirá un horario de <b style="color: red;">00:00 a 00:00 horas</b>, 
        los días <b style="color: red;">anotar los días</b>, en un periodo comprendido del <b style="color: red;">00</b> de <b style="color: red;">mes</b> de {{ date('Y') }} al <b style="color: red;">00</b> de <b style="color: red;">mes</b> de {{ date('Y') }}.
    </p>
    <p class="note letra">Lo anterior, con el fin de dar cumplimiento al proyecto de Residencia Profesional, 
        mismo que acordamos llevar a efecto en los términos del convenio número <b>(Núm. Convenio)</b> con fecha <b>(Fecha de Convenio)</b>. 
        <b style="color: red;">Solo si hay convenio-Si no borrar este párrafo.</b></p>
        <p class="note letra">
            Sin más por el momento, reiteramos nuestro apoyo y colaboración
        @if ($student->sex == 'm')
        al alumno antes mencionado,
        @else
        a la alumna antes mencionada,
        @endif 
        así como a la institución a la que usted pertenece, 
        para la consecución de los objetivos propuestos.
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
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="c"> C.c.p. Residente</div>
    <div class="c1"> Expediente</b> </div>
</body>
</html>