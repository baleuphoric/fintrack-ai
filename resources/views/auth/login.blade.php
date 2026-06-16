<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FinTrack AI</title>

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

.login-card{
    width:100%;
    max-width:450px;
    border:none;
    border-radius:24px;
    box-shadow:0 20px 40px rgba(0,0,0,.08);
}

.logo{
    font-size:32px;
    font-weight:700;
    letter-spacing:-1px;
    color:#111111;
}

.form-control{
    border-radius:12px;
    padding:12px;
    border:1px solid #e5e7eb;
}

.form-control:focus{
    border-color:#111111;
    box-shadow:none;
}

.btn-dark{
    border-radius:12px;
    padding:12px;
}

a{
    color:#111111;
    text-decoration:none;
}

a:hover{
    color:#444;
}

@media (max-width:576px){

    .login-card{
        max-width:100%;
        margin:15px;
    }

    .card-body{
        padding:25px 20px !important;
    }

    .logo{
        font-size:26px;
    }
}
    </style>
</head>
<body>

<div class="card login-card">

    <div class="card-body p-4">

        <div class="text-center mb-4">

            <h2 class="logo">
                FinTrack AI
            </h2>

            <p class="text-muted">
                Masuk ke akun Anda
            </p>

        </div>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">

                <label class="mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    required>

            </div>

            <div class="mb-4">

                <label class="mb-2">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required>

            </div>

            <button
                type="submit"
                class="btn btn-dark w-100">

                Masuk

            </button>

        </form>

        <div class="text-center mt-4">

            Belum punya akun?

            <a href="{{ route('register') }}">
                Daftar
            </a>

        </div>

        <div class="text-center mt-3">

            <a href="/">
                ← Kembali ke Landing Page
            </a>

        </div>

    </div>

</div>

</body>
</html>