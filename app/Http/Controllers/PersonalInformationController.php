<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Configuration;
use App\Models\ExternalAdvisor;
use App\Models\Location;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class PersonalInformationController extends Controller
{
    public function personalInformation(Student $student, Request $request)
    {
        $configuration = Configuration::firstOrfail();

        $pdf = PDF::loadView('residency-process.personal-information', [
            'student' => $student,
            'careers' => Career::get(),
            'configuration' => $configuration,
            'password' => $request->password ?? '--'
        ]);

        $customReportName = 'Registro Sistema Control de Residencias Profesionales-' . $student->full_name . '_' . Carbon::now()->format('d-m-Y') . '.pdf';
        return $pdf->stream($customReportName);
    }
}
