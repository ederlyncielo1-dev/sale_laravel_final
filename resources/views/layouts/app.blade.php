<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Academic Portal')</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        #sidebar {
            min-width: 260px;
            max-width: 260px;
            background: #1e293b;
            color: #fff;
            min-height: 100vh;
        }
        #sidebar .nav-link {
            color: #94a3b8;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            border-radius: 8px;
            margin: 4px 12px;
        }
        #sidebar .nav-link:hover, #sidebar .nav-link.active {
            color: #fff;
            background: #334155;
        }
        #sidebar .nav-link i {
            font-size: 1.1rem;
            margin-right: 12px;
        }
        #content {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <!-- Sidebar Navigation Layout -->
    <nav id="sidebar" class="d-none d-md-block">
        <div class="p-4 border-bottom border-secondary border-opacity-25">
            <h5 class="mb-0 fw-bold text-white"><i class="bi bi-mortarboard-fill text-success me-2"></i>Portal</h5>
            <small class="text-muted text-xs">Role: {{ Auth::user()->user_type ?? 'User' }}</small>
        </div>

        <div class="py-3">
            <span class="px-4 text-uppercase fw-bold text-secondary text-xs tracking-wider d-block mb-2">Main Menu</span>
            
            @if(Auth::check() && Auth::user()->user_type === 'Root')
                <!-- Root Administrator Links -->
                <a href="{{ route('admin.home') }}" class="nav-link {{ Route::is('admin.home') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('admin.student.index') }}" class="nav-link {{ Route::is('admin.student.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Manage Students
                </a>
            @else
                <!-- Student Links -->
                <a href="{{ route('student.home') }}" class="nav-link {{ Route::is('student.home') ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i> Home Dashboard
                </a>
            @endif

            <hr class="mx-3 my-3 text-secondary opacity-25">
            
            <!-- Quick Link to log out right from the sidebar menu -->
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" class="nav-link text-danger">
                <i class="bi bi-box-arrow-left text-danger"></i> Sign Out
            </a>
            <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </nav>

    <!-- Main Content Area Wrapper Layout -->
    <div id="content">
        <!-- Main Top Bar Navbar Section -->
        <nav class="navbar navbar-expand navbar-light px-4 py-2">
            <div class="container-fluid p-0">
                <span class="navbar-text fw-medium text-dark d-none d-sm-inline">
                    Academic Year 2026 - 2027
                </span>

               <div class="ms-auto d-flex align-items-center">
    <div class="dropdown">
        <a class="nav-link dropdown-toggle fw-semibold text-secondary small d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @if(Auth::check() && Auth::user()->profile_picture)
                <img src="{{ asset(Auth::user()->profile_picture) }}" 
                     alt="User Avatar" 
                     class="rounded-circle object-fit-cover me-2 border" 
                     style="width: 28px; height: 28px;">
            @else
                <i class="bi bi-person-circle fs-5 me-2 align-middle"></i>
            @endif
            {{ Auth::user()->name ?? 'Guest Account' }}
        </a>
        
        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2" style="min-width: 200px;">
            <!-- User Short Summary Header Inside Dropdown -->
            <li class="px-3 py-2 bg-light rounded-top d-flex align-items-center mb-1">
                @if(Auth::check() && Auth::user()->profile_picture)
                    <img src="{{ asset(Auth::user()->profile_picture) }}" 
                         alt="Avatar" 
                         class="rounded-circle object-fit-cover me-2" 
                         style="width: 32px; height: 32px;">
                @else
                    <i class="bi bi-person-circle fs-4 text-secondary me-2"></i>
                @endif
                <div class="lh-sm">
                    <p class="mb-0 small fw-bold text-dark text-truncate" style="max-width: 130px;">{{ Auth::user()->name ?? 'Guest' }}</p>
                    <span class="text-muted" style="font-size: 11px;">Logged In</span>
                </div>
            </li>

            <li><hr class="dropdown-divider my-1 opacity-25"></li>
            <li><a class="dropdown-item small py-2" href="{{ route('student.settings.edit') }}"><i class="bi bi-gear me-2 text-secondary"></i>Settings</a></li>
            <li><hr class="dropdown-divider my-1 opacity-25"></li>
            
            <li>
                <a class="dropdown-item small text-danger py-2" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-top').submit();">
                    <i class="bi bi-box-arrow-left me-2"></i>Sign Out
                </a>
                <form id="logout-form-top" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
            </div>
        </nav>

        <!-- View Content Interceptor Slot Injection Point -->
        <main class="flex-grow-1">
            @yield('content')
        </main>
    </div>
</div>

<!-- Bootstrap 5 Bundle with Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>