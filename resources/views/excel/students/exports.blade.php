<table>
    <thead>
        <tr>
            <td style="text-align: center; font-size: 30px;" colspan="20" > <h1>RESIDENCIAS PROFESIONALES PERIODO </h1></td>
        </tr>
    <tr>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="2"><b>No.</b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="2"><b>UES</b></th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="2"><b>MATRÍCULA</b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" colspan="2"><b> SEXO</b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="2"><b> NOMBRE DEL ALUMNO <br>Nombre(s)/Paterno/Materno </b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="2"><b> INGENIERÍA / LICENCIATURA</b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="2"><b> NOMBRE DEL PROYECTO DE RESIDENCIAS PROFESIONALES</b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="2"><b> NOMBRE DEL ASESOR INTERNO</b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="2"><b> NOMBRE DEL ASESOR EXTERNO</b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="2"><b> NOMBRE DE LA EMPRESA O INSTITUCIÓN</b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="2"><b> CONTACTO EN LA EMPRESA</b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="2"><b> DATOS DE LA EMPRESA O INSTITUCIÓN, DIRECCIÓN, CP, TELÉFONO</b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="2"><b> INICIO DE RESIDENCIAS  (FECHA)</b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="2"><b> TÉRMINO DE RESIDENCIAS (FECHA)</b> </th>
        @if ($withNotes)
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="2"><b> CALIFICACIÓN OBTENIDA</b> </th>
        @endif
        @if ($covenants)
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" rowspan="2"><b> CONVENIOS <br> Núm. Convenio, Fecha de Convenio</b> </th>
        @endif
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;" colspan="4"><b> SECTOR</b> </th>
    </tr>
    <tr>        
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;"><b> M</b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;"><b> F</b> </th>        
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;"><b> EDUCATIVO</b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;"><b> PÚBLICO</b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;"><b> PRIVADO</b> </th>
        <th style="background-color: #92d050; border: 1px solid black; text-align: center; vertical-align: middle;"><b> SOCIAL</b> </th>
    </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
            <tr>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">{{$loop->index + 1}}</td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    {{$configuration->unit}}
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    {{$student->account_number}}
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    @if ($student->sex === 'm')
                        X
                    @endif
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    @if ($student->sex === 'f')
                        X
                    @endif
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    {{$student->first_name}} {{$student->fathers_last_name}} {{$student->mothers_last_name}}
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    {{$student->career->name ?? '--'}}
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    {{$student->project->title ?? '--'}}
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    {{$student->teacher->first_name ?? '--'}} {{$student->teacher->fathers_last_name ?? '--'}} {{$student->teacher->mothers_last_name ?? '--'}}
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    {{$student->externalAdvisor->first_name ?? '--'}} {{$student->externalAdvisor->fathers_last_name ?? '--'}} {{$student->externalAdvisor->mothers_last_name ?? '--'}}
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    {{$student->company->business_name ?? '--'}}
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    {{$student->company->person_in_charge ?? '--'}}
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    {{$student->company ? $student->company->address_name : '' }} {{$student->company ? ", C.P. {$student->company->zip_code}" : '' }} {{$student->company ? ", TE. {$student->company->office_phone_number}" : '' }} {{$student->company ? ", E-mail: {$student->company->email}" : '' }}                    
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    {{$student->project ? $student->project->start_date->format('d/m/Y') : '--'}}
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    {{$student->project ? $student->project->end_date->format('d/m/Y') : '--'}}
                </td>
                @if ($withNotes)
                    <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                        {{$student->qualificationLetter ? $student->qualificationLetter->qualification : '--'}}
                    </td>
                @endif
                @if ($covenants)
                    <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                        {{$student->company && $student->company->number_of_agreement ? "N.C {$student->company->number_of_agreement}" : '--'}} {{$student->company && $student->company->date ? ", F.C {$student->company->date->format('d/m/Y')}" : '--'}}
                    </td>
                @endif
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    @if ($student->company && $student->company->sector === 'educativo')
                        ✔
                    @endif
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    @if ($student->company && $student->company->sector === 'publico')
                        ✔
                    @endif
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    @if ($student->company && $student->company->sector === 'privado')
                        ✔
                    @endif
                </td>
                <td style="background-color: #ffff00; text-align: center; vertical-align: middle; border: 1px solid black;">
                    @if ($student->company && $student->company->sector === 'social')
                        ✔
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>