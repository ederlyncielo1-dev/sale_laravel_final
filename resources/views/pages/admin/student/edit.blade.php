@extends('layouts.app')
@section('title', 'Academic Record - ' . $user->name)

@section('content')
<div class="app-content-header py-3">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0 fw-bold text-dark">Academic Evaluation</h3>
                <p class="text-muted small mb-0">Managing profiles for: <strong>{{ $user->name }}</strong> ({{ $user->email }})</p>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0 bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.student.index') }}" class="text-decoration-none">Students</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Grades</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content-body py-4">
    <div class="container-fluid">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- SINGLE UNIFIED FORM FOR EVERYTHING -->
        <form action="{{ route('admin.student.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- SECTION 1: Student Core Profile Information -->
            <div class="card border-0 shadow-sm rounded-3 bg-white mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold text-dark mb-0"><i class="text-success me-2"></i>Profile Information</h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="name" class="form-label small fw-semibold text-secondary">Student Full Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label small fw-semibold text-secondary">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: Subject Report Card -->
            <div class="card border-0 shadow-sm rounded-3 bg-white">
                <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold text-dark mb-0"><i class="text-primary me-2"></i>Subject Report Card</h5>
                    <a href="{{ route('admin.student.index') }}" class="btn btn-sm btn-light border px-3">
                        <i class=" me-1"></i> Return to List
                    </a>
                </div>

                <div class="card-body px-4 pb-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0 text-sm text-center">
                            <thead class="table-light text-secondary fw-semibold">
                                <tr>
                                    <th scope="col" class="py-3 text-start ps-3" style="width: 35%;">Subject / Course Descriptor</th>
                                    <th scope="col" class="py-3" style="width: 12%;">1st Quarter</th>
                                    <th scope="col" class="py-3" style="width: 12%;">2nd Quarter</th>
                                    <th scope="col" class="py-3" style="width: 12%;">3rd Quarter</th>
                                    <th scope="col" class="py-3" style="width: 12%;">4th Quarter</th>
                                    <th scope="col" class="py-3 text-dark fw-bold" style="width: 17%;">Final Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subjects as $subject)
                                    @php
                                        $gradeRecord = $existingGrades->get($subject->id);
                                    @endphp
                                    <tr>
                                        <td class="text-start ps-3 fw-medium text-dark">
                                            {{ $subject->subject_code }} - {{ $subject->name ?? $subject->subject_name }}
                                        </td>
                                        <td>
                                            <input type="number" step="0.01" min="0" max="100" 
                                                   name="grades[{{ $subject->id }}][q1]" 
                                                   value="{{ old('grades.'.$subject->id.'.q1', $gradeRecord->q1 ?? '') }}" 
                                                   class="form-control form-control-sm text-center">
                                        </td>
                                        <td>
                                            <input type="number" step="0.01" min="0" max="100" 
                                                   name="grades[{{ $subject->id }}][q2]" 
                                                   value="{{ old('grades.'.$subject->id.'.q2', $gradeRecord->q2 ?? '') }}" 
                                                   class="form-control form-control-sm text-center">
                                        </td>
                                        <td>
                                            <input type="number" step="0.01" min="0" max="100" 
                                                   name="grades[{{ $subject->id }}][q3]" 
                                                   value="{{ old('grades.'.$subject->id.'.q3', $gradeRecord->q3 ?? '') }}" 
                                                   class="form-control form-control-sm text-center">
                                        </td>
                                        <td>
                                            <input type="number" step="0.01" min="0" max="100" 
                                                   name="grades[{{ $subject->id }}][q4]" 
                                                   value="{{ old('grades.'.$subject->id.'.q4', $gradeRecord->q4 ?? '') }}" 
                                                   class="form-control form-control-sm text-center">
                                        </td>
                                        <td class="fw-bold {{ ($gradeRecord && $gradeRecord->final_grade < 75) ? 'text-danger' : 'text-success' }}">
                                            {{ $gradeRecord->final_grade ?? 'Pending' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="bi bi-calendar-x fs-2 d-block mb-2 opacity-50"></i>
                                            No basic subjects found in the database system. Run your SubjectSeeder first.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="bi bi-save me-2"></i> Save Changes & Evaluation
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection