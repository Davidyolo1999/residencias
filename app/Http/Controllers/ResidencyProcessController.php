<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class ResidencyProcessController extends Controller
{
    public function residencyProcess()
    {
        return view('students.residency-process', [
            'student' => Student::where('user_id', Auth::id())->firstOrFail(),
        ]);
    }
}
