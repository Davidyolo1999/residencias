<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SOLICITUD DE RESIDENCIAS PROFESIONALES DE {{ $student->full_name }} </title>
    <style>
        .title, .subtitle {
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

        .document-name, .table-title {
            font-weight: bold;
            text-align: center;
        }

        .request-date {
            text-align: right;
            margin-top: 30px;
        }

        .table-title {
            margin-bottom: 5px;
        }

        .table {
            width: 100%;
            margin-bottom: 30px;
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

        .student-signature, .person-in-charge-signature {
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
    @include('residency-process.partials.header', ['title' => 'SOLICITUD DE RESIDENCIAS PROFESIONALES'])

    <p class="request-date"><b>Fecha de solicitud:</b> {{ $residencyRequest->request_date_formatted }}.</p>

    <p class="table-title">DATOS DEL ALUMNO</p>

    <table border="2" cellspacing="0" cellpadding="2" class="table">
        <tbody>
            <tr>
                <td width="12%">Nombre:</td>
                <td colspan="3">{{ $student->first_name }} {{ $student->fathers_last_name }} {{ $student->mothers_last_name }}</td>
            </tr>
            <tr>
                <td>Carrera:</td>
                <td>{{ $student->career->name }}</td>
                <td width="13%">No. Cuenta</td>
                <td width="15%">{{ $student->account_number }}</td>
            </tr>
        </tbody>
    </table>

    <p class="table-title">DATOS DE LA EMPRESA</p>

    <table border="2" cellspacing="0" cellpadding="1" class="table">
        <tbody>
            <tr>
                <td width="12%">Razón Social:</td>
                <td colspan="3">{{ $externalCompany->business_name }}</td>
            </tr>
            <tr>
                <td width="12%">Dirección:</td>
                <td colspan="3">{{ $externalCompany->address_name }}</td>
            </tr>
            <tr>
                <td width="12%">Dirigir carta a:</td>
                <td colspan="3">{{ $externalCompany->person_in_charge }}</td>
            </tr>
            <tr>
                <td>Cargo:</td>
                <td>{{ $externalCompany->person_in_charge_position }}</td>
                <td width="13%">E-mail:</td>
                <td width="20%">{{ $externalCompany->email }}</td>
            </tr>
            <tr>
                <td>Teléfono Oficina:</td>
                <td>{{ $externalCompany->office_phone_number }}</td>
                <td>Teléfono celular:</td>
                <td width="20%">{{ $externalCompany->personal_phone_number }}</td>
            </tr>
        </tbody>
    </table>

    <p class="table-title">DATOS DEL PROYECTO</p>

    <table border="2" cellspacing="0" cellpadding="2" class="table">
        <tbody>
            <tr>
                <td width="20%">Título del proyecto:</td>
                <td>{{ $project->title }}</td>
            </tr>
        </tbody>
    </table>

    <p class="note">
        El Proyecto en cita se realizará a distancia en atención a las políticas de
        salud emitidas por las instancias federal y estatal con motivo de la
        pandemia causada por el coronavirus SARS-COV2 (enfermedad
        denominada como COVID 19), por lo que no asistiré en ningún momento
        y bajo cualquier circunstancia a la institución. Asumo la responsabilidad
        total y absoluta en relación a mi estado de salud en el caso de
        contravenir lo señalado, deslindado de cualquier situación a la
        Universidad.
    </p>

    <div class="footer">
        <p class="student-signature">{{ $student->first_name }} {{ $student->fathers_last_name }} {{ $student->mothers_last_name }}</p>
        <p class="person-in-charge-signature">
            LCDA. Brenda González Pacheco
            <br>
            Coordinadora de la UES Villa Victoria
        </p>
    </div>
</body>
</html>
