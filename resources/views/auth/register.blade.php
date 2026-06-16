<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FinTrack AI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background:#f8f9fa;
            font-family:'Segoe UI',sans-serif;
        }

        @media (max-width:576px){
        .register-card{
            width:100%;
            max-width:100%;
            margin:15px;
            border:none;
            border-radius:24px;
            box-shadow:0 20px 40px rgba(0,0,0,.08);
        }

        .card-body{
        padding:25px 20px !important;
        }
        
        .logo{
            font-size:26px;
            font-weight:700;
            letter-spacing:-1px;
            color:#111111;
        }

        .form-control{
            border-radius:12px;
            padding:10px 12px;
            border:1px solid #e5e7eb;
        }

        .form-control:focus{
            border-color:#111111;
            box-shadow:none;
        }

        .btn-dark{
            border-radius:12px;
            padding:10px;
        }

        a{
            color:#111111;
            text-decoration:none;
        }

        a:hover{
            color:#444;
        }

        label{
            font-size:14px;
            font-weight:500;
        }
}
    </style>
</head>
<body>

<div class="card register-card">

    <div class="card-body p-4">

        <div class="text-center mb-3">

            <h2 class="logo">
                FinTrack AI
            </h2>

            <p class="text-muted mb-0">
                Buat akun baru
            </p>

        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-2">
                <label class="mb-1">
                    Nama
                </label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    required>
            </div>

            <div class="mb-2">
                <label class="mb-1">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    required>
            </div>

            <div class="row mb-3">

                <div class="col-12 col-md-6">
                    <label class="mb-1">
                        Password
                    </label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required>
                </div>

                <div class="col-12 col-md-6">
                    <label class="mb-1">
                        Konfirmasi Password
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        required>
                </div>

            </div>

            <button
                type="submit"
                class="btn btn-dark w-100">

                Buat Akun

            </button>

        </form>

        <div class="text-center mt-3">

            Sudah punya akun?

            <a href="{{ route('login') }}">
                Masuk
            </a>

        </div>

        <div class="text-center mt-2">

            <a href="/">
                ← Kembali ke Landing Page
            </a>

        </div>

    </div>

</div>

</body>
</html>