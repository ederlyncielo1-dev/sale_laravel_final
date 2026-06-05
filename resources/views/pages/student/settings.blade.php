@extends('layouts.app')
@section('title', 'Account Profile Settings')

@section('content')
<div class="app-content-header py-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0 fw-bold text-dark">Account Settings</h3>
                <p class="text-muted small mb-0">Manage your personal details and contact preferences.</p>
            </div>
        </div>
    </div>
</div>

<div class="app-content-body py-4">
    <div class="container-fluid">

        <!-- Status Alerts Notifications Banner -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Multipart Form Data attribute is mandatory to process public folder photo uploads -->
        <form action="{{ route('student.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                
                <!-- Left Sidebar Avatar Upload & Identity Card -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-3 text-center p-4 bg-white h-100">
                        <div class="my-3 position-relative d-inline-block">
                            @if($user->profile_picture)
                                <img src="{{ asset($user->profile_picture) }}" 
                                     alt="Profile Picture" 
                                     class="rounded-circle object-fit-cover shadow-sm border border-2 border-light" 
                                     style="width: 120px; height: 120px;">
                            @else
                                <!-- Standard Initials Fallback if avatar doesn't exist -->
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center text-secondary fw-bold shadow-sm border mx-auto" 
                                     style="width: 120px; height: 120px; font-size: 2.5rem;">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                        
                        <!-- File Upload Selector Controls -->
                        <div class="mb-3 px-2 mt-2">
                            <label Breton for="profile_picture" class="form-label small fw-semibold text-secondary d-block mb-2">Profile Picture</label>
                            <input type="file" name="profile_picture" id="profile_picture" 
                                   class="form-control form-control-sm @error('profile_picture') is-invalid @enderror" 
                                   accept="image/*">
                            <div class="form-text text-muted small mt-1">Supported: JPG, PNG, WebP (Max 2MB)</div>
                            @error('profile_picture') 
                                <div class="invalid-feedback text-start d-block mt-1">{{ $message }}</div> 
                            @enderror
                        </div>

                        <hr class="text-muted opacity-25 my-3">

                        <h5 class="fw-bold text-dark mb-1">{{ $user->name }}</h5>
                        <p class="text-muted small mb-3">{{ $user->email }}</p>
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill small">Active Student Account</span>
                    </div>
                </div>

                <!-- Right Main Interactive Management Forms Panel -->
                <div class="col-lg-8">
                    
                    <!-- Card Block 1: Contact Specific Information -->
                    <div class="card border-0 shadow-sm rounded-3 bg-white mb-4">
                        <div class="card-header bg-transparent border-0 pt-4 px-4">
                            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-person-circle text-primary me-2"></i>Personal Contact Details</h5>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-secondary">Full Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-secondary">Email Address</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-semibold text-secondary">Mobile / Contact Number</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="e.g., +63 912 345 6789" value="{{ old('phone', $user->phone) }}">
                                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-semibold text-secondary">Address</label>
                                    <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Street name, Subdivision, Barangay, City, Province">{{ old('address', $user->address) }}</textarea>
                                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Block 2: Crucial Emergency Contacts Core Data -->
                    <div class="card border-0 shadow-sm rounded-3 bg-white mb-4">
                        <div class="card-header bg-transparent border-0 pt-4 px-4">
                            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-shield-exclamation text-danger me-2"></i>In Case of Emergency Notify</h5>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-secondary">Parent / Guardian Full Name</label>
                                    <input type="text" name="emergency_contact_name" class="form-control @error('emergency_contact_name') is-invalid @enderror" placeholder="Full name" value="{{ old('emergency_contact_name', $user->emergency_contact_name) }}">
                                    @error('emergency_contact_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-secondary">Emergency Hotline / Phone Number</label>
                                    <input type="text" name="emergency_contact_phone" class="form-control @error('emergency_contact_phone') is-invalid @enderror" placeholder="Mobile number" value="{{ old('emergency_contact_phone', $user->emergency_contact_phone) }}">
                                    @error('emergency_contact_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Block 3: Security & Login Parameters -->
                    <div class="card border-0 shadow-sm rounded-3 bg-white mb-4">
                        <div class="card-header bg-transparent border-0 pt-4 px-4">
                            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-key-fill text-warning me-2"></i>Change System Password</h5>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-secondary">New Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="New Password">
                                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold text-secondary">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confrm New Password">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Trigger Button Placement -->
                    <div class="d-flex justify-content-end mb-5">
                        <button type="submit" class="btn btn-success px-5 py-2 shadow-sm fw-medium">
                            <i class="bi bi-check-circle-fill me-2"></i>Apply Changes & Profile Updates
                        </button>
                    </div>

                </div>
            </div>
        </form>

    </div>
</div>
@endsection