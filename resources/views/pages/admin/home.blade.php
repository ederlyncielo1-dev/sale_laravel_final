@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<div class="app-content-header py-3">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0 fw-bold text-dark">System Overview</h3>
                <p class="text-muted small mb-0">Welcome back, Root Administrator.</p>
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
                            <h3 class="fw-bold text-dark mb-0">1,248</h3>
                        </div>
                        <div class="p-3 bg-primary bg-opacity-10 rounded-3 text-primary">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                    </div>
                    <span class="text-success small fw-medium mt-2"><i class="bi bi-arrow-up-short"></i> +12% this month</span>
                </div>
            </div>

            <!-- Total Subjects Card -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-3 p-3 bg-white h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-secondary fw-semibold small text-uppercase d-block mb-1">Active Subjects</span>
                            <h3 class="fw-bold text-dark mb-0">42</h3>
                        </div>
                        <div class="p-3 bg-success bg-opacity-10 rounded-3 text-success">
                            <i class="bi bi-book-half fs-4"></i>
                        </div>
                    </div>
                    <span class="text-muted small d-block mt-2">Across 4 curriculum tracks</span>
                </div>
            </div>

            <!-- System Utilization Card -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-3 p-3 bg-white h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-secondary fw-semibold small text-uppercase d-block mb-1">Grades Encoded</span>
                            <h3 class="fw-bold text-dark mb-0">94.2%</h3>
                        </div>
                        <div class="p-3 bg-warning bg-opacity-10 rounded-3 text-warning">
                            <i class="bi bi-check-circle-fill fs-4"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 5px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 94.2%" aria-valuenow="94.2" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

        <div class="row g-4">
            <!-- Table: Recent Student Signups -->
            <div class="col-12 col-lg-8">
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
                                        <th scope="col" class="py-3 border-0">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-semibold text-dark py-3">Juan Dela Cruz</td>
                                        <td class="text-muted">juan.delacruz@school.edu.ph</td>
                                        <td class="text-muted">May 23, 2026</td>
                                        <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2.5 py-1 text-xs">Active</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark py-3">Maria Santos</td>
                                        <td class="text-muted">maria.santos@school.edu.ph</td>
                                        <td class="text-muted">May 22, 2026</td>
                                        <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2.5 py-1 text-xs">Active</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold text-dark py-3">Mark Villanueva</td>
                                        <td class="text-muted">mark.v@school.edu.ph</td>
                                        <td class="text-muted">May 20, 2026</td>
                                        <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-2.5 py-1 text-xs">Pending Review</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Quick Control Panel -->
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 bg-white h-100">
                    <div class="card-header bg-transparent border-0 pt-4 px-4">
                        <h5 class="fw-bold text-dark mb-0">Quick Management</h5>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="d-grid gap-2">
                            <button class="btn btn-light border text-start py-2.5 px-3 rounded-3 d-flex align-items-center justify-content-between">
                                <span class="small fw-semibold text-secondary"><i class="bi bi-plus-circle me-2 text-primary"></i> Add New Student Account</span>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </button>
                            <button class="btn btn-light border text-start py-2.5 px-3 rounded-3 d-flex align-items-center justify-content-between">
                                <span class="small fw-semibold text-secondary"><i class="bi bi-journal-plus me-2 text-success"></i> Encode Course Grades</span>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </button>
                            <button class="btn btn-light border text-start py-2.5 px-3 rounded-3 d-flex align-items-center justify-content-between">
                                <span class="small fw-semibold text-secondary"><i class="bi bi-file-earmark-pdf me-2 text-danger"></i> Generate Analytics Report</span>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </button>
                            <button class="btn btn-light border text-start py-2.5 px-3 rounded-3 d-flex align-items-center justify-content-between">
                                <span class="small fw-semibold text-secondary"><i class="bi bi-gear-fill me-2 text-dark"></i> Core System Configuration</span>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </button>
                        </div>

                        <hr class="text-muted my-4">

                        <!-- Informational Alert -->
                        <div class="alert alert-secondary border-0 rounded-3 bg-light p-3 mb-0" role="alert">
                            <div class="d-flex">
                                <i class="bi bi-info-circle-fill text-secondary fs-5 me-2.5"></i>
                                <div>
                                    <h6 class="alert-heading fw-bold text-dark text-sm mb-1">End of Term Processing</h6>
                                    <p class="text-muted text-xs mb-0">Grade submission pipelines will auto-lock on Friday at 5:00 PM.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection