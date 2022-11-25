<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentsExport implements FromView, ShouldAutoSize
{
    private $students;
    private $configuration;
    private $withNotes;

    public function __construct($students, $configuration, $withNotes)
    {
        $this->students = $students;
        $this->configuration = $configuration;
        $this->withNotes = $withNotes ? true : false;
    }

    public function view(): View
    {
        return view('excel.students.exports', [
            'students' => $this->students,
            'configuration' => $this->configuration,
            'withNotes' => $this->withNotes
        ]);
    }
}
