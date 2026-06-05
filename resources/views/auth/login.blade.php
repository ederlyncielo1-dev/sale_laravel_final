@extends('layouts.auth')
@section('title', 'Login')

@section('content')
    <!-- Include SweetAlert2 CDN inside your view (or move it to your head layout) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div>
    <h2 class="text-center fw-bold text-dark mb-1">Welcome</h2>
    <p class="text-center text-muted small mb-4">Sign in to check your quarterly grades</p>

    @if ($errors->any())
        <div class="alert alert-danger text-sm py-2 px-3 mb-4" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="form-control bg-light">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold text-secondary small">Password</label>
            <input type="password" name="password" required 
                   class="form-control bg-light">
        </div>

        <div class="mb-4">
            <div class="form-check">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label for="remember" class="form-check-label text-muted small">Remember me</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 fw-medium shadow-sm">
            Sign In
        </button>
    </form>

    <div class="text-center mt-4">
        <p class="small text-muted mb-0">
            Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Register</a>
        </p>
    </div>


    <!-- SweetAlert Toast Engine Logic -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}"
                });
            });
        </script>
    @endif
@endsection