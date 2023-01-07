<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formato Evalución Externo</title>
    <style>
        .request-date {
            text-align: right;
            margin-top: 0px;
            padding: 0 1rem;
        }
        .letra {
            font-family: 'Gill Sans', 'Gill Sans MT';
            font-size: 14px;
        }
        .note {
            padding: 0 1rem;
            text-align: justify;
        }
        .tabla{
            padding: 0 1rem;
        }
        .verticalText {
            -webkit-transform: rotate(-90deg);
            -moz-transform: rotate(-90deg);
        }
        .f{
            margin-top:0px; 
            margin-bottom: 0px;
        }
        .footer {
            

            position: fixed;
            bottom: -30px;
            right: 0;
            left: 0;
            height: 100px;
        }
        .justify {
            text-align: justify;
        }
        .table {
            width: 100%;
            padding: 0 1rem;
            margin-bottom: 30px;
        }
        .student-signature,
        .person-in-charge-signature {
            width: 40%;
            text-align: center;
            padding: 5px 0 0;
            border-top: 1px solid black;
            float: left;
            font-weight: bold;
        }
        .person-in-charge-signature {
            float: right;
        }
    </style>
</head>
<body>
    <div>
        <img src="{{ asset('img/escudo-mexico.jpg') }}" alt="" style="height: 80px;">
        <img src="{{ asset('img/umb-logo.jpg') }}" alt="" style="height: 50px; float:right;">
    </div>
    <br>
    <div class="request-date letra"><b>Fecha: {{ $externalQualificationLetter->request_date_formatted }}</b> </div>

    <p class="note letra">El presente documento tiene por objetivo evaluar el desempeño del residente profesional durante 
        su estancia en la organización donde Usted funge como asesor externo; es por ello que le solicito atentamente 
        disponga de unos minutos y lo pueda contestar lo más objetivamente posible.
    </p>

        <table border="1" cellspacing="0" width="100%" class="letra tabla">
            <tr>
                <td colspan="2">
                    Nombre de la organización: {{ $externalCompany->business_name }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Nombre del Residente: {{ $student->full_name }} 
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Área de trabajo: {{ $externalCompany->Department_requesting_project}}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Título del proyecto: {{ $project->title }}
                </td>
            </tr>
            <tr>
                <td>
                    Fecha de Inicio: <br> {{ $student->project->start_date_formatted }}
                </td>
                <td>Fecha de Término: <br> {{ $student->project->end_date_formatted }}</td>
            </tr>
        </table>
        <p class="note letra">
            Seleccione la casilla que considere más adecuada para cada una de las cuestiones.
        </p>
        <table border="1" cellspacing="0" width="100%" class="letra tabla">
            <tr>
                <th width="80%"></th>
                <th height="8%"><p class="verticalText">Excelente</p></th>
                <th><p class="verticalText">Bueno</p></th>
                <th><p class="verticalText">Regular</p></th>
                <th><p class="verticalText">Malo</p></th>
                <th><p class="verticalText">Deficiente</p></th>
            </tr>
            <tr>
                <td height="4%">1. ¿Cómo evalúa la disposición del residente ante la asignación de una actividad encomendada?</td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->first_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[0])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->first_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[1])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->first_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[2])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->first_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[3])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->first_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[4])
                        X
                    @endif
                </td>
            </tr>
            <tr>
                <td height="4%">2. ¿Cómo califica la actitud mostrada del residente durante su estancia dentro de la organización?</td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->second_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[0])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->second_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[1])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->second_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[2])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->second_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[3])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->second_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[4])
                        X
                    @endif
                </td>
            </tr>
            <tr>
                <td height="4%">3. Evalúe los valores (responsabilidad, respeto y honestidad) mostrados por el residente.</td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->third_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[0])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->third_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[1])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->third_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[2])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->third_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[3])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->third_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[4])
                        X
                    @endif
                </td>
            </tr>
            <tr>
                <td height="4%">4. Evalúe la disposición del residente ante el trabajo en equipo.</td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->fourth_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[0])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->fourth_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[1])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->fourth_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[2])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->fourth_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[3])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->fourth_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[4])
                        X
                    @endif
                </td>
            </tr>
            <tr>
                <td height="4%">5. Evalúe la aplicación de conocimientos de su formación profesional.</td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->fifth_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[0])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->fifth_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[1])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->fifth_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[2])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->fifth_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[3])
                        X
                    @endif
                </td>
                <td style="text-align: center;">
                    @if ($student->externalQualificationLetter && $student->externalQualificationLetter->fifth_answer === App\Models\ExternalQualificationLetter::RESPONSE_TYPE[4])
                        X
                    @endif
                </td>
            </tr>
        </table>
        <table  border="0" cellspacing="0"  class="letra table" >
            <tr>
                <td>Observaciones: </td>
            </tr>
            <tr height="85%">
                <td  class="justify"><u>{{$student->externalQualificationLetter ? $student->externalQualificationLetter->observations : '--'}}</u></td>
            </tr>
        </table>
        <div class="footer letra">
            <p class="student-signature">{{ $student->externalAdvisor->full_name }} <br>Asesor Externo</p>
            <p class="person-in-charge-signature">
                {{ $student->teacher->full_name }}
                <br>
                Asesor Interno
            </p>
            
        </div>
        
</body>
</html>