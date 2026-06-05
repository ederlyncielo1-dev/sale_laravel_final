@extends('layouts.auth')
@section('title', 'Create Account')

@section('content')
    <h2 class="text-center fw-bold text-dark mb-1">Create Account</h2>
    <p class="text-center text-muted small mb-4">Register as a student to trace your academic records</p>

    <form action="{{ route('register') }}" method="POST">
        @csrf
        
        <!-- Full Name Input -->
        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required 
                   class="form-control bg-light @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address Input -->
        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required 
                   class="form-control bg-light @error('email') is-invalid @enderror">
            @error('email')
                <div class="invalid-feedback small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password Input -->
        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Password</label>
            <input type="password" name="password" required 
                   class="form-control bg-light @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password Input -->
        <div class="mb-4">
            <label class="form-label fw-semibold text-secondary small">Confirm Password</label>
            <input type="password" name="password_confirmation" required 
                   class="form-control bg-light @error('password_confirmation') is-invalid @enderror">
            @error('password_confirmation')
                <div class="invalid-feedback small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success w-100 py-2 fw-medium shadow-sm">
            Create Account
        </button>
    </form>

    <div class="text-center mt-4">
        <p class="small text-muted mb-0">
            Already registered? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Login</a>
        </p>
    </div>
@endsection