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
     .c{
            text-align: left;
            margin-top: 0px;
            padding: 0 1rem;
            font-size: 0.8rem;
        }
    .c1{
            text-align: left;
            margin-top: 0px;
            padding: 0 3.5rem;
            font-size: 0.8rem;
        }
    .debajo{
        font-size: 0.5rem;
        text-align: center;
        margin-top: 0px;
        }
    </style>
</head>
<body>
@include('residency-process.partials.header', ['title' => 'CARTA PRESENTACIÓN'])
<div class="request-date"><b>No. RPA/ {{ $student->career->abreviation }}/{{str_pad($student->user_id, 4,'0',STR_PAD_LEFT) }}/{{ date('Y') }}</b> </div>
<div class="request-date"><b>{{$presentationLetter->request_date_formatted}} </b> </div>
<div class="person"><b>{{ $externalCompany->person_in_charge }}</b></div>
<div class="cargo"><b>{{ $externalCompany->person_in_charge_position }}</b></div>
<div class="presente"><b>PRESENTE:</b></div>
<p class="note">
Por medio de la presente, me permito enviarle un cordial saludo y presentar a usted al (la) C. <b>{{$student->full_name}}</b> 
con número de cuenta <b>{{$student->account_number}}</b> , alumno(a) de nuestra casa de estudios e inscrito(a) en la carrera de  <b>{{$student->career->name}}</b>, quien desea realizar su Residencia Profesional en la institución a su digno cargo, con un proyecto
perfectamente definido, viable y dentro del área de especialidad afín a su carrera, debiendo cubrir un total de 640 hrs.
durante un período mínimo de cuatro meses y máximo de seis. 
<br>
<br>
En este sentido, el proyecto se realizará a distancia en atención a las políticas de salud emitidas por las instancias federal y
estatal con motivo de la pandemia causada por el coronavirus SARS-COV2 (enfermedad denominada como COVID 19).
Por lo tanto, el C. <b>{{$student->full_name}}</b>  no asistirá en ningún momento, ni bajo cualquier circunstancia, a las
instalaciones de la institución que usted representa.
<br>
<br>
En espera de su amable respuesta, agradezco de antemano su fina atención a la presente; sabedor de su gran apoyo e
impulso a la juventud en pro del desarrollo de nuestro país.
</p>
<br>
<br>
<p class="subtitle"> <b>ATENTAMENTE</b> </p>
<br>
    <div class="subtitle">
        <p > <b>
            LCDA. BRENDA GONZALEZ PACHECO
            <br>
            COORDINADORA DE LA UNIDAD DE ESTUDIOS        
            
            <br>
            SUPERIORES VILLA VICTORIA
        </b>
        </p>
    </div>
    <br>
    <br>
    <br>
    <div class="c"> c.c.p. Alumno(a) </div>
    <div class="c1"> Expediente/Minutario </div>
    <br>
    <br>
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
        <td  align="right">DIRECCIÓN GENERAL DE EDUCACIÓN SUPERIOR</td>
        <td width="5"></td>
        <td align="left">OCOYOACAC, MÉXICO. C.P. 52300</td>
    </tr>
    <tr>
        <td align="right"></td>
        <td width="5"></td>
        <td align="left">Correo E.: u.mexiquense.bicentenario@gmail.com</td>
    </tr>
</table>
</body>
</html>