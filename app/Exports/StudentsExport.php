<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet; 

class StudentsExport implements FromView, ShouldAutoSize, WithTitle, WithStyles, WithColumnWidths
{
    private $students;
    private $configuration;
    private $withNotes;
    private $covenants;

    public function __construct($students, $configuration, $withNotes, $covenants)
    {
        $this->students = $students;
        $this->configuration = $configuration;
        $this->withNotes = $withNotes ? true : false;
        $this->covenants = $covenants ? true : false;
    }

    public function view(): View
    {
        return view('excel.students.exports', [
            'students' => $this->students,
            'configuration' => $this->configuration,
            'withNotes' => $this->withNotes,
            'covenants' => $this->covenants
        ]);
    }
    public function title() : string
    {
        return 'Residencias Profesionales';
    }

    public function styles(Worksheet $sheet)
    {
        return 
            // Corrección del comentario anterior. Para columnas completas debería ser de la siguiente manera
            // $sheet->getStyle('A1:B' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
            //$sheet->getStyle('A1:B5' , $sheet->getHighestRow())->getAlignment()->setWrapText(true);
            //y para rangos de celda específica lo siguiente
            //$sheet->getStyle('D1:E999')->getAlignment()->setWrapText(true);
            $sheet->getStyle('A1:U' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
    }
    public function columnWidths(): array
    {
        return [
            'M' => 60,
            'k' => 60,
            'H' => 60,
            'D' => 4,
            'E' => 4,
            'C' => 15,
            'R' => 12,
            'S' => 12,
            'T' => 12,
            'U' => 12,
        ];
    }
}
