<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Student;
use Illuminate\Http\Request;

class ChartsController extends Controller
{
    public function index(Request $request)
    {
        $careers = Career::all();

        $studentsQuery = Student::when($request->start, fn ($query, $start) => $query->whereDate('created_at', '>=', $start))
            ->when($request->end, fn ($query, $end) => $query->whereDate('created_at', '<=', $end))
            ->when($request->career_id, fn ($query, $carrerId) => $query->where('career_id', $carrerId))
            ->groupBy('sex');

        $maleStudents = (clone $studentsQuery)->where('sex', 'm')->count();

        $femaleStudents = (clone $studentsQuery)->where('sex', 'f')->count();

        $students = [
            'hombres' => $maleStudents,
            'mujeres' => $femaleStudents
        ];

        return view('charts.index', [
            'students' => $students,
            'careers' => $careers
        ]);
    }
}
