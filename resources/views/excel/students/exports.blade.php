<table>
    <thead>
    <tr>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">No.</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">UES</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">MATRÍCULA</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" colspan="2">SEXO</th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">NOMBRE DEL ALUMNO <br>Nombre(s)/Paterno/Materno </th>
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
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">CALIFICACIÓN OBTENIDA</th>
        @endif
        @if ($covenants)
        <th style="background-color: #92d050; border: 1px solid black; text-align: center;" rowspan="2">CONVENIOS <br> Núm. Convenio, Fecha de Convenio</th>
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
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">{{$loop->index + 1}}</td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    {{$configuration->unit}}
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    {{$student->account_number}}
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    @if ($student->sex === 'm')
                        X
                    @endif
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    @if ($student->sex === 'f')
                        X
                    @endif
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    {{$student->first_name}} {{$student->fathers_last_name}} {{$student->mothers_last_name}}
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    {{$student->career->name ?? '--'}}
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    {{$student->project->title ?? '--'}}
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    {{$student->teacher->first_name ?? '--'}} {{$student->teacher->fathers_last_name ?? '--'}} {{$student->teacher->mothers_last_name ?? '--'}}
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    {{$student->externalAdvisor->first_name ?? '--'}} {{$student->externalAdvisor->fathers_last_name ?? '--'}} {{$student->externalAdvisor->mothers_last_name ?? '--'}}
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    {{$student->company->business_name ?? '--'}}
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    {{$student->company->person_in_charge ?? '--'}}
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    {{$student->company ? $student->company->address_name : '' }} {{$student->company ? ", C.P. {$student->company->zip_code}" : '' }} {{$student->company ? ", TE. {$student->company->office_phone_number}" : '' }} {{$student->company ? ", E-mail: {$student->company->email}" : '' }}                    
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    {{$student->project ? $student->project->start_date->format('d/m/Y') : '--'}}
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    {{$student->project ? $student->project->end_date->format('d/m/Y') : '--'}}
                </td>
                @if ($withNotes)
                    <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                        {{$student->qualificationLetter->qualification ?? '--'}}
                    </td>
                @endif
                @if ($covenants)
                    <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                        N.C {{$student->company->number_of_agreement ?? '--'}}, F.C {{$student->company->date->format('d/m/Y') ?? '--'}}
                    </td>
                @endif
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    @if ($student->company && $student->company->sector === 'educativo')
                        X
                    @endif
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    @if ($student->company && $student->company->sector === 'publico')
                        X
                    @endif
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    @if ($student->company && $student->company->sector === 'privado')
                        X
                    @endif
                </td>
                <td style="background-color: #ffff00; text-align: center; border: 1px solid black;">
                    @if ($student->company && $student->company->sector === 'social')
                        X
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>