<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject; // Assuming your subject model name
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Fetch live metrics counts
        $totalStudents = User::where('user_type', 'Student')->count();
        $activeSubjects = Subject::count(); // Adjust conditions if you have an 'is_active' column

        // 2. Calculate dynamic grade completion rate if applicable
        // For now, keeping a hardcoded calculation or fallback placeholder variable
        $gradesEncodedPercent = 94.2; 

        // 3. Fetch the 5 most recent registrations where user_type is 'Student'
        $recentStudents = User::where('user_type', 'Student')
            ->latest()
            ->take(5)
            ->get();

        return view('pages.admin.dashboard', compact(
            'totalStudents', 
            'activeSubjects', 
            'gradesEncodedPercent', 
            'recentStudents'
        ));
    }
}