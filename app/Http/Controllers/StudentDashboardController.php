<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        // Fetches student specific quarterly grade data
        $grades = Auth::user()->grades()->with('subject')->get();

        $totalFinalGrades = 0;
        $subjectCount = 0;

        foreach ($grades as $grade) {
            if (!is_null($grade->final_grade)) {
                $totalFinalGrades += $grade->final_grade;
                $subjectCount++;
            }
        }

        $generalAverage = $subjectCount > 0 ? round($totalFinalGrades / $subjectCount, 2) : null;

        return view('student.home', compact('grades', 'generalAverage'));
    }
}