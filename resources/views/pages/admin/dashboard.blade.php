@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<div class="app-content-header py-3">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0 fw-bold text-dark">System Overview</h3>
                <p class="text-muted small mb-0">Welcome back, Administrator.</p>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0 bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content-body py-4">
    <div class="container-fluid">
        
        <!-- Metric Cards Grid -->
        <div class="row g-3 mb-4">
            <!-- Total Students Card -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-3 p-3 bg-white h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-secondary fw-semibold small text-uppercase d-block mb-1">Total Students</span>
                            <h3 class="fw-bold text-dark mb-0">{{ number_format($totalStudents) }}</h3>
                        </div>
                        <div class="p-3 bg-primary bg-opacity-10 rounded-3 text-primary">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Subjects Card -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-3 p-3 bg-white h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-secondary fw-semibold small text-uppercase d-block mb-1">Active Subjects</span>
                            <h3 class="fw-bold text-dark mb-0">{{ number_format($activeSubjects) }}</h3>
                        </div>
                        <div class="p-3 bg-success bg-opacity-10 rounded-3 text-success">
                            <i class="bi bi-book-half fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Utilization Card -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-3 p-3 bg-white h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-secondary fw-semibold small text-uppercase d-block mb-1">Grades Encoded</span>
                            <h3 class="fw-bold text-dark mb-0">{{ $gradesEncodedPercent }}%</h3>
                        </div>
                        <div class="p-3 bg-warning bg-opacity-10 rounded-3 text-warning">
                            <i class="bi bi-check-circle-fill fs-4"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 5px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $gradesEncodedPercent }}%" aria-valuenow="{{ $gradesEncodedPercent }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

        <div class="row g-4">
            <!-- Table: Recent Student Signups -->
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex align-items-center justify-content-between">
                        <h5 class="fw-bold text-dark mb-0">Student Registrations</h5>
                        <button class="btn btn-sm btn-outline-secondary rounded-2 fw-medium text-xs">View All</button>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 text-sm">
                                <thead class="table-light text-secondary">
                                    <tr>
                                        <th scope="col" class="py-3 border-0">Student Name</th>
                                        <th scope="col" class="py-3 border-0">Email</th>
                                        <th scope="col" class="py-3 border-0">Registration Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentStudents as $student)
                                        <tr>
                                            <td class="fw-semibold text-dark py-3">{{ $student->name }}</td>
                                            <td class="text-muted">{{ $student->email }}</td>
                                            <td class="text-muted">
                                                {{ $student->created_at ? $student->created_at->format('M d, Y') : 'N/A' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">
                                                <i class="bi bi-people text-secondary fs-3 d-block mb-2 opacity-50"></i>
                                                No student registrations found in the database.
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

    </div>
</div>
@endsection