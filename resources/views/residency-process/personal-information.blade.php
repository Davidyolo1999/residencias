<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISTEMA CONTROL DE RESIDENCIAS PROFESIONALES</title>
    <link rel="stylesheet" href="{{ asset('css/document-header.css') }}">
    <style>
        .letra {
            font-family: 'Gill Sans', 'Gill Sans MT';
            font-size: 14px;
        }

        .note {
            padding: 0 1rem;
            text-align: justify;
        }

        .table {
            width: 100%;
            margin-bottom: 30px;
        }

        .tc{
            text-align: center;
        }
        .table-title {
            margin-bottom: 5px;
        }

    </style>
</head>

<body>

    @include('residency-process.partials.header', [
        'title' => 'SISTEMA CONTROL DE RESIDENCIAS PROFESIONALES',
    ])

    <br>

    <p class="note letra">
        La Unidad de Estudios Superiores Villa Victoria a través del Sistema Control de Residencias Profesionales,
        informa que haz sido registrado correctamente! por favor verifica que la información sea correcta.
    </p>
    <br>
    <p class="table-title letra">DATOS DEL ALUMNO</p>

    <table border="2" cellspacing="0" cellpadding="2" class="table letra">
        <tbody>
            <tr>
                <td width="12%" class="tc"><b>Nombre:</b></td>
                <td colspan="3" class="letra">&nbsp;{{ $student->first_name }} {{ $student->fathers_last_name }} {{ $student->mothers_last_name }}</td>
            </tr>
            <tr>
                <td class="tc"><b>Carrera:</b></td>
                <td class="letra">&nbsp;{{ $student->career->name }}</td>
                <td width="13%" class="tc"><b>No. de Cuenta</b></td>
                <td width="15%" class="tc letra">&nbsp;{{ $student->account_number }}</td>
            </tr>
        </tbody>
    </table>
    <p class="table-title letra">DATOS DE  ACCESO</p>
    <table border="1" width="100%" cellspacing="0" align="center" class="letra">

        <tr>
            <td  width="30%" align="center"><b>Fecha de Registro:</b></td>
            <td align="center"> {{\Carbon\Carbon::parse($student->user->created_at)->format('d-M-Y g:i:s a')}}</td>
        </tr>
        <tr>
            <td align="center"><b>Usuario:</b></td>
            <td align="center">{{$student->user->email}}</td>
        </tr>
        <tr>
            <td align="center"><b>Contraseña:</b></td>
            <td align="center">{{$student->user->password}}</td>
        </tr>
    </table>
</body>

</html>
