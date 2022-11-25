<table>
    <thead>
    <tr>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">No.</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">UES</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">Matrícula</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" colspan="2">Sexo</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">Nombre del alumno</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">INGENIERÍA / LICENCIATURA</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">NOMBRE DEL PROYECTO DE RESIDENCIAS PROFESIONALES</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">NOMBRE DEL ASESOR INTERNO</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">NOMBRE DEL ASESOR EXTERNO</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">NOMBRE DE LA EMPRESA O INSTITUCIÓN</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">CONTACTO EN LA EMPRESA</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">DATOS DE LA EMPRESA O INSTITUCIÓN, DIRECCIÓN, CP, TELÉFONO</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">INICIO DE RESIDENCIAS  (FECHA)</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">TÉRMINO DE RESIDENCIAS (FECHA)</th>
        @if ($withNotes)
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">CALIFICACION OBTENIDA</th>
        @endif
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" colspan="4">SECTOR</th>
    </tr>
    <tr>        
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;">M</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;">F</th>        
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;">EDUCATIVO</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;">PÚBLICO</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;">PRIVADO</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;">SOCIAL</th>
    </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
            <tr>
                <td style="text-align: center; border: 1px solid black;">{{$loop->index + 1}}</td>
                <td style="text-align: center; border: 1px solid black;">
                    {{$configuration->unit}}
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    {{$student->account_number}}
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    @if ($student->sex == 'f')
                        X
                    @endif
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    @if ($student->sex == 'm')
                        X
                    @endif
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    {{$student->first_name}} {{$student->fathers_last_name}} {{$student->mothers_last_name}}
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    {{$student->career->name ?? '--'}}
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    {{$student->project->name ?? '--'}}
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    {{$student->teacher->name ?? '--'}}
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    {{$student->externalAdvisor->name ?? '--'}}
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    {{$student->company->business_name ?? '--'}}
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    {{$student->company->person_in_charge ?? '--'}}
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    {{$student->company ? $student->company->address_name : '' }} {{$student->company ? $student->company->zip_code : '' }} {{$student->company ? $student->company->office_phone_number : '' }}                    
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    {{$student->project->start_date->format('d/m/Y') ?? '--'}}
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    {{$student->project->end_date->format('d/m/Y') ?? '--'}}
                </td>
                @if ($withNotes)
                    <td style="text-align: center; border: 1px solid black;">
                        {{$student->qualificationLetter->qualification ?? '--'}}
                    </td>
                @endif
                <td style="text-align: center; border: 1px solid black;">
                    @if ($student->company->sector === 'educativo')
                        X
                    @endif
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    @if ($student->company->sector === 'publico')
                        X
                    @endif
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    @if ($student->company->sector === 'privado')
                        X
                    @endif
                </td>
                <td style="text-align: center; border: 1px solid black;">
                    @if ($student->company->sector === 'social')
                        X
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>