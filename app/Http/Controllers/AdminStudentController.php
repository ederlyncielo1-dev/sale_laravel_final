<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminStudentController extends Controller
{
    public function index()
    {
        $students = User::where('user_type', 'Student')->latest()->paginate(10);

        return view('pages.admin.student.index', compact('students'));
    }

    /**
     * Show the form for registering a new student.
     */
    public function create()
    {
        return view('pages.admin.student.create');
    }

    /**
     * Store a newly registered student in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'Student', // Automatically flag them as a student
        ]);

        return redirect()->route('admin.student.index')->with('success', 'Student account registered successfully.');
    }

    /**
     * Show all subjects and grades for input.
     */
    public function edit(User $user)
    {
        if ($user->user_type !== 'Student') {
            abort(403, 'Unauthorized action.');
        }

        $subjects = Subject::all();
        $existingGrades = $user->grades()->get()->keyBy('subject_id');

        return view('pages.admin.student.edit', compact('user', 'subjects', 'existingGrades'));
    }

    /**
     * Update or create the quarterly grades.
     */

    public function update(Request $request, User $user)
    {
        if ($user->user_type !== 'Student') {
            abort(403, 'Unauthorized action.');
        }

        // Validate both User Data and Grades Array simultaneously
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'grades' => 'required|array',
            'grades.*.q1' => 'nullable|numeric|min:0|max:100',
            'grades.*.q2' => 'nullable|numeric|min:0|max:100',
            'grades.*.q3' => 'nullable|numeric|min:0|max:100',
            'grades.*.q4' => 'nullable|numeric|min:0|max:100',
        ]);

        // 1. Update Profile Fields
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        // 2. Loop and Update Grade Evaluation Matrix
        foreach ($request->input('grades') as $subjectId => $quarterGrades) {
            $q1 = $quarterGrades['q1'] ?? null;
            $q2 = $quarterGrades['q2'] ?? null;
            $q3 = $quarterGrades['q3'] ?? null;
            $q4 = $quarterGrades['q4'] ?? null;

            $gradesArray = array_filter([$q1, $q2, $q3, $q4], 'is_numeric');
            $finalGrade = count($gradesArray) > 0 ? round(array_sum($gradesArray) / count($gradesArray), 2) : null;

            Grade::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'subject_id' => $subjectId,
                ],
                [
                    'q1' => $q1,
                    'q2' => $q2,
                    'q3' => $q3,
                    'q4' => $q4,
                    'final_grade' => $finalGrade,
                ],
            );
        }

        return redirect()->back()->with('success', 'Student profile and academic records updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->user_type !== 'Student') {
            abort(403, 'Unauthorized action.');
        }

        $user->grades()->delete();
        $user->delete();

        return redirect()->route('admin.student.index')->with('success', 'Student account removed clean from system records.');
    }
}
