<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinTrack AI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>

        :root{
        --primary:#111111;
        --secondary:#2d2d2d;
        --light:#f8f9fa;
        --border:#e5e7eb;
    }

        body{
            background:#f3f4f6;
            font-family:'Segoe UI',sans-serif;
            transition:.3s;
        }

        .sidebar{
            width:250px;
            min-height:100vh;
            background:#111111;
            color:white;
            position:fixed;
            left:0;
            top:0;
            padding:20px;
        }

        .sidebar-copyright{
            position:absolute;
            bottom:15px;
            left:20px;
            font-size:12px;
            color:rgba(255,255,255,.45);
        }

        .sidebar a{
            color:white;
            text-decoration:none;
            display:block;
            padding:12px 15px;
            border-radius:12px;
            margin-bottom:6px;
            transition:.25s;
            font-weight:500;
        }

        .sidebar a:hover{
            background:rgba(255,255,255,.15);
            color:white;
        }

        .sidebar-divider{
            border: none;
            height: 1.5px;
            background:#ffffff;
            margin: 18px 0 22px;
        }

        .active-menu{
            background:#ffffff !important;
            color:#111111 !important;
            font-weight:600;
        }

        .main-content{
            margin-left:250px;
            padding:25px;
        }

        .navbar-custom{
            background:white;
            border-radius:15px;
            padding:15px 20px;
            box-shadow:0 5px 15px rgba(0,0,0,.05);
            margin-bottom:25px;
            border:1px solid #eee;
        }

        .card{
            border:none;
            border-radius:16px;
            box-shadow:
            0 4px 20px rgba(0,0,0,.06);
        }

        .user-avatar{
            width:45px;
            height:45px;
            border-radius:50%;
            background:#111111;
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:bold;
        }


        /* DARK MODE */
        .dark-mode{
            background:#121212 !important;
            color:#f1f1f1 !important;
        }

        .dark-mode .navbar-custom{
            background:#1e1e1e !important;
            color:white !important;
        }

        .dark-mode .card{
            background:#1e1e1e !important;
            color:white !important;
        }

        .dark-mode .sidebar{
            background:#0f0f0f !important;
        }

        .dark-mode .dropdown-menu{
            background:#1e1e1e !important;
        }

        .dark-mode .dropdown-item{
            color:white !important;
        }

        .dark-mode .dropdown-item:hover{
            background:#333 !important;
        }

        .dark-mode .form-control,
        .dark-mode .form-select{
            background:#2a2a2a !important;
            color:white !important;
            border-color:#444 !important;
        }

        .dark-mode .table{
            color:white !important;
        }

        .dark-mode .text-muted{
            color:#cfcfcf !important;
        }

        .dark-mode .alert{
            color:white !important;
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <h3 class="fw-bold mb-1">
        FinTrack AI
    </h3>

    <small class="text-secondary d-block">
    AI Finance Assistant
    </small>

    <hr class="sidebar-divider">

    <a href="/dashboard"
       class="{{ request()->is('dashboard') ? 'active-menu' : '' }}">
        Dashboard
    </a>

    <a href="/transactions"
       class="{{ request()->is('transactions*') ? 'active-menu' : '' }}">
        Transaksi
    </a>

    <a href="/savings"
       class="{{ request()->is('savings*') || request()->is('savings-goals*') ? 'active-menu' : '' }}">
        Target Tabungan
    </a>

    <a href="/insight"
       class="{{ request()->is('insight') ? 'active-menu' : '' }}">
        AI Insight
    </a>

     <small class="sidebar-copyright">
        © 2026 FinTrack AI. All Rights Reserved.
    </small>
</div>


<!-- MAIN CONTENT -->
<div class="main-content">

    <!-- TOPBAR -->
    <div class="navbar-custom d-flex justify-content-between align-items-center">

        <div>

            @if(request()->is('dashboard'))
                <h4 class="mb-0">
                    Dashboard
                </h4>
                <small class="text-muted">
                    Selamat Datang, {{ Auth::user()->name }}
                </small>
            @elseif(request()->is('transactions*'))
                <h4 class="mb-0">
                    Transaksi
                </h4>
            @elseif(request()->is('savings*') || request()->is('savings-goals*'))
                <h4 class="mb-0">
                    Target Tabungan
                </h4>
            @elseif(request()->is('insight'))
                <h4 class="mb-0">
                    AI Insight
                </h4>
            @elseif(request()->is('profile'))
                <h4 class="mb-0">
                    Profil Saya
                </h4>
            @endif

        </div>

        <div class="d-flex align-items-center">

    <button
        id="themeToggle"
        class="btn btn-outline-secondary me-2">
        ☾
    </button>

        <div class="dropdown">

            <button
                class="btn btn-light dropdown-toggle d-flex align-items-center gap-2"
                data-bs-toggle="dropdown">

                @if(Auth::user()->avatar)
    <img
        src="{{ asset('storage/' . Auth::user()->avatar) }}"
        width="45"
        height="45"
        class="rounded-circle"
        style="object-fit:cover;">
@else
    <div class="user-avatar">
        {{ strtoupper(substr(Auth::user()->name,0,1)) }}
    </div>
@endif

                <span>
                    {{ Auth::user()->name }}
                </span>

            </button>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>
                    <a class="dropdown-item" href="{{ route('profile') }}">
                    Profil Saya
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="dropdown-item text-danger">
                            Logout
                        </button>
                    </form>
                </li>

            </ul>

        </div>

    </div>

</div>

    @if(session('success'))
    <div
        id="successAlert"
        class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
    </div>
@endif

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

<script>
document.addEventListener(
    "DOMContentLoaded",
    function(){

        const btn =
        document.getElementById(
            "themeToggle"
        );

        if(
            localStorage.getItem(
                "theme"
            ) === "dark"
        ){
            document.body.classList.add(
                "dark-mode"
            );

            btn.innerHTML =
            "☾";
        }

        btn.addEventListener(
            "click",
            function(){

                document.body.classList.toggle(
                    "dark-mode"
                );

                if(
                    document.body.classList.contains(
                        "dark-mode"
                    )
                ){
                    localStorage.setItem(
                        "theme",
                        "dark"
                    );

                    btn.innerHTML =
                    "☀";

                }else{

                    localStorage.setItem(
                        "theme",
                        "light"
                    );

                    btn.innerHTML =
                    "☾";
                }
            }
        );
    }
);
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const alertBox = document.getElementById('successAlert');

    if (alertBox) {

        setTimeout(() => {

            alertBox.classList.remove('show');

            setTimeout(() => {
                alertBox.remove();
            }, 500);

        }, 3000);

    }

});
</script>
</body>
</html>