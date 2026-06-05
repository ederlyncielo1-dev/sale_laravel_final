<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display the authenticated student's academic report card.
     */
    public function dashboard()
    {
        $user = Auth::user();

        // Pull grade records with accompanying master subject fields
        $grades = $user->grades()->with('subject')->get();

        // Calculate general weighted running average for all graded subjects
       $filledGrades = $grades->pluck('final_grade')->filter(fn($value) => is_numeric($value));
        $gpa = $filledGrades->count() > 0 ? round($filledGrades->average(), 2) : null;

        return view('pages.student.dashboard', compact('user', 'grades', 'gpa'));
    }
}