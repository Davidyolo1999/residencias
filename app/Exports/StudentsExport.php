<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class StudentsExport implements FromView, ShouldAutoSize, WithTitle
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
}
