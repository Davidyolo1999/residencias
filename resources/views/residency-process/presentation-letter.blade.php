<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CARTA PRESENTACIÓN</title>
    <link rel="stylesheet" href="{{ asset('css/document-header.css') }}">
    <style>
        .request-date {
            text-align: right;
            margin-top: 0px;
            padding: 0 1rem;
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

        .debajo {
            font-size: 0.5rem;
            text-align: center;
            margin-top: 0px;
        }

        .mayus {
            text-transform: uppercase;
        }

        .tc {
            text-align: center;
        }

        .letra {
            font-family: 'Gill Sans', 'Gill Sans MT';
            font-size: 14px;
        }

        .tablita {
            font-family: 'Gill Sans', 'Gill Sans MT';
            font-size: 14px;
        }

        .footer {
            position: fixed;
            bottom: -30px;
            right: 0;
            left: 0;
            height: 100px;
        }

    </style>
</head>

<body>
    @include('residency-process.partials.header', ['title' => 'CARTA PRESENTACIÓN'])
    <div class="request-date letra"><b>No. RPA/
            {{ $student->career->abreviation }}/{{ str_pad($student->user_id, 4, '0', STR_PAD_LEFT) }}/{{ date('Y') }}</b>
    </div>
    <div class="request-date letra mayus"><b>{{ $presentationLetter->request_date_formatted }}</b></div>

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

    <p class="note letra">
        Por medio de la presente, me permito enviarle un cordial saludo y presentar a usted

        @if ($student->sex == 'm')
            al
        @else
            a la
        @endif

        C. <b>{{ $student->full_name }}</b>
        con número de cuenta <b>{{ $student->account_number }}</b>,

        @if ($student->sex == 'm')
            alumno de nuestra casa de estudios e inscrito
        @else
            alumna de nuestra casa de estudios e inscrita
        @endif

        en la carrera de <b>{{ $student->career->name }}</b>, quien desea realizar su Residencia Profesional en la
        institución a su digno cargo, con un proyecto
        perfectamente definido, viable y dentro del área de especialidad afín a su carrera, debiendo cubrir un total de
        640 hrs.
        durante un período mínimo de cuatro meses y máximo de seis.
        <br>
        <br>
        En espera de su amable respuesta, agradezco de antemano su fina atención a la presente; sabedor de su gran apoyo
        e
        impulso a la juventud en pro del desarrollo de nuestro país.
    </p>
    <br>
    <br>
    <br>
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
    <div class="c"> c.c.p. Alumno(a) </div>
    <div class="c1"> Expediente/Minutario </div>
    <div class="footer">
        <table class="debajo" border="0" align="center">
            <tr>
                <td align="right"><b>SECRETARÍA DE EDUCACIÓN</b> </td>
                <td width="5"></td>
                <td align="right"><b>UNIVERSIDAD MEXIQUENSE DEL BICENTENARIO</b></td>
            </tr>
            <tr>
                <td align="right">SUBSECRETARÍA DE EDUCACIÓN MEDIA SUPERIOR Y SUPERIOR</td>
                <td width="5"></td>
                <td align="left">CARRETERA MÉXICO-TOLUCA KM.43.5</td>
            </tr>
            <tr>
                <td align="right">DIRECCIÓN GENERAL DE EDUCACIÓN SUPERIOR</td>
                <td width="5"></td>
                <td align="left">OCOYOACAC, MÉXICO. C.P. 52300</td>
            </tr>
            <tr>
                <td align="right"></td>
                <td width="5"></td>
                <td align="left">Correo E.: u.mexiquense.bicentenario@gmail.com</td>
            </tr>
        </table>
    </div>
</body>
</html>
