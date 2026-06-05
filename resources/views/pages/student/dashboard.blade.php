@extends('layouts.app')
@section('title', 'My Academic Report Card')

@section('content')
<div class="app-content-header py-4 bg-light border-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <span class="badge bg-primary px-3 py-2 mb-2 rounded-pill text-uppercase tracking-wide">Student Portal</span>
                <h2 class="fw-bold text-dark mb-1">Welcome back, {{ $user->name }}!</h2>
                <p class="text-muted mb-0">Academic Performance & Quarterly Evaluations</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <div class="p-3 bg-white rounded-3 shadow-sm border text-center d-inline-block">
                    <span class="text-secondary small text-uppercase fw-semibold d-block">General Average</span>
                    <h3 class="fw-bold mb-0 {{ ($gpa && $gpa < 75) ? 'text-danger' : 'text-success' }}">
                        {{ $gpa ?? 'N/A' }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="app-content-body py-5">
    <div class="container">
        
        <div class="card border-0 shadow-sm rounded-3 bg-white">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold text-dark mb-0">
                    <i class="text-warning me-2"></i>Subject Report Card
                </h5>
            </div>

            <div class="card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle mb-0 text-center">
                        <thead class="table-dark fw-semibold">
                            <tr>
                                <th scope="col" class="py-3 text-start ps-3" style="width: 35%;">Subject / Course</th>
                                <th scope="col" class="py-3" style="width: 12%;">1st Sem</th>
                                <th scope="col" class="py-3" style="width: 12%;">2nd Quarter</th>
                                <th scope="col" class="py-3" style="width: 12%;">3rd Quarter</th>
                                <th scope="col" class="py-3" style="width: 12%;">4th Quarter</th>
                                <th scope="col" class="py-3" style="width: 17%;">Final Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($grades as $grade)
                                <tr>
                                    <td class="text-start ps-3 fw-medium text-dark">
                                        <span class="badge bg-secondary me-2 text-xs">{{ $grade->subject->subject_code ?? 'N/A' }}</span>
                                        {{ $grade->subject->name ?? $grade->subject->subject_name ?? 'Subject' }}
                                    </td>
                                    <td class="text-secondary fw-semibold">{{ $grade->q1 ?? '-' }}</td>
                                    <td class="text-secondary fw-semibold">{{ $grade->q2 ?? '-' }}</td>
                                    <td class="text-secondary fw-semibold">{{ $grade->q3 ?? '-' }}</td>
                                    <td class="text-secondary fw-semibold">{{ $grade->q4 ?? '-' }}</td>
                                    <td class="fw-bold {{ ($grade->final_grade < 75) ? 'text-danger' : 'text-success' }}">
                                        {{ $grade->final_grade ?? 'Pending' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-exclamation-circle fs-2 d-block mb-2 text-secondary opacity-50"></i>
                                        No academic evaluations have been recorded for your account yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection