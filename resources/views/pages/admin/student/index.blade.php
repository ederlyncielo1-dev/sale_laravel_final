@extends('layouts.app')
@section('title', 'Manage Students')

@section('content')
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 fw-bold text-dark">Student Management</h3>
                    <p class="text-muted small mb-0">Student system profiles.</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0 bg-transparent p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"
                                class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Students</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content-body py-4">
        <div class="container-fluid">

            <!-- Main Directory Table Container -->
            <div class="card border-0 shadow-sm rounded-3 bg-white">
                <div
                    class="card-header bg-transparent border-0 pt-4 px-4 d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold text-dark mb-0">Student Registry</h5>
<a href="{{ route('admin.student.create') }}" class="btn btn-sm btn-success rounded-2 fw-medium px-3">
    <i class="bi bi-person-plus-fill me-1"></i> Register Student
</a>
                </div>

                <div class="card-body px-4 pb-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 text-sm">
                            <thead class="table-light text-secondary text-uppercase"
                                style="font-size: 0.75rem; letter-spacing: 0.05em;">
                                <tr>
                                    <th scope="col" class="py-3 border-0 ps-3">ID No.</th>
                                    <th scope="col" class="py-3 border-0">Student Full Name</th>
                                    <th scope="col" class="py-3 border-0">Email Address</th>
                                    <th scope="col" class="py-3 border-0">Registration Date</th>
                                    <th scope="col" class="py-3 border-0 text-end pe-3">Record Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                    <tr>
                                        <td class="text-secondary py-3 ps-3 fw-mono">
                                            #{{ str_pad($student->id, 5, '0', STR_PAD_LEFT) }}</td>
                                        <td>
                                            <div class="fw-semibold text-dark">{{ $student->name }}</div>
                                        </td>
                                        <td class="text-muted">{{ $student->email }}</td>
                                        <td class="text-muted">{{ $student->created_at->format('M d, Y') }}</td>
                                        <td class="text-end pe-3">
                                            <div class="btn-group" role="group">
                                                <!-- Edit Button pointing to the new grades sub-page -->
                                                <a href="{{ route('admin.student.edit', $student->id) }}"
                                                    class="btn btn-sm btn-outline-secondary px-2.5" title="Modify Details">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <!-- Delete Form wrapped with an explicit identification footprint -->
                                                <form id="delete-form-{{ $student->id }}"
                                                    action="{{ route('admin.student.destroy', $student->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger px-2.5 rounded-start-0"
                                                        title="Revoke Access"
                                                        onclick="confirmDeletion('{{ $student->id }}', '{{ $student->name }}')">
                                                        <i class="bi bi-trash3-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="bi bi-people fs-1 d-block mb-3 opacity-25 text-secondary"></i>
                                            <span class="fs-6 fw-medium d-block">No Student Accounts Registered</span>
                                            <p class="small text-muted mb-0 mt-1">When students create public credentials,
                                                they will populate this database layout.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Custom Bootstrap 5 Pagination Interface -->
                    @if ($students->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <div class="text-muted small">
                                Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of
                                {{ $students->total() }} students
                            </div>
                            <div>
                                {{ $students->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

    <script>
    function confirmDeletion(studentId, studentName) {
        Swal.fire({
            title: 'Are you absolute sure?',
            text: `You are about to remove ${studentName}. This action cannot be reversed!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete record!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the specific form targeting this student ID directly
                document.getElementById('delete-form-' + studentId).submit();
            }
        });
    }
</script>

<!-- Catch the success message if redirected back here -->
@if(session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
    </script>
@endif
@endsection
