@extends('layouts.app')
@section('title', 'Register Student')

@section('content')
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 fw-bold text-dark">Register Student</h3>
                    <p class="text-muted small mb-0">Create a new student account profile.</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0 bg-transparent p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.student.index') }}" class="text-decoration-none">Students</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Register</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content-body py-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-3 bg-white">
                        <div class="card-header bg-transparent border-0 pt-4 px-4">
                            <h5 class="fw-bold text-dark mb-0">Student Profile Information</h5>
                        </div>

                        <div class="card-body px-4 pb-4">
                            <form action="{{ route('admin.student.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label small fw-semibold text-secondary">Full Name</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="John Doe" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label small fw-semibold text-secondary">Email Address</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="johndoe@example.com" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimum 8 characters" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label small fw-semibold text-secondary">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-type password" required>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.student.index') }}" class="btn btn-sm btn-light border rounded-2 fw-medium px-3">Cancel</a>
                                    <button type="submit" class="btn btn-sm btn-success rounded-2 fw-medium px-3">
                                        <i class="bi bi-check-circle-fill me-1"></i> Register Student
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection