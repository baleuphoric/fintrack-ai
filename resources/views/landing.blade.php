<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinTrack AI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            font-family: 'Segoe UI', sans-serif;
        }

        .hero{
            min-height:100vh;
            display:flex;
            align-items:center;
            background:linear-gradient(135deg,#111111,#2d2d2d);
            color:white;
        }
        
        .hero-image{
            max-width: 520px;
            width: 100%;
            filter: drop-shadow(0 20px 40px rgba(0,0,0,.25));
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float{
            0%{
                transform: translateY(0);
            }
            50%{
                transform: translateY(-12px);
            }
            100%{
                transform: translateY(0);
            }
        }
        
        .navbar {
            z-index:9999;
        }

        .hero{
            min-height:100vh;
        }

        .feature-card{
            border:1px solid #e5e7eb;
            transition:.3s;
            border-radius:15px;
        }

        .feature-card:hover{
            transform:translateY(-8px);
            box-shadow:0 12px 30px rgba(0,0,0,.08);
        }

        .section-title{
            font-weight:700;
            margin-bottom:20px;
        }

        .stats-box{
            background:white;
            border-radius:15px;
            padding:25px;
            text-align:center;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
        }

        .pricing-card{
            border-radius:20px;
        }

        footer{
            background:#111111;
            color:white;
            padding:30px;
        }

        @media (max-width: 768px){

    .hero{
        min-height: auto;
        padding: 120px 0 60px;
        text-align: center;
    }

    .hero h1{
        font-size: 2rem;
    }

    .hero .lead{
        font-size: 1rem;
    }

    .hero-image{
        max-width: 300px;
        margin-top: 30px;
    }

    .stats-box,
    .feature-card,
    .pricing-card{
        margin-bottom: 20px;
    }

    .btn-lg{
        width: 100%;
        margin-bottom: 10px;
    }
}
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-absolute w-100">

    <div class="container">

        <a class="navbar-brand fw-bold" href="#">
            FinTrack AI
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu"
            aria-controls="navbarMenu"
            aria-expanded="false"
            aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            <div class="ms-auto mt-3 mt-lg-0">

                <a href="/login" class="btn btn-dark me-lg-2 mb-2 mb-lg-0">
                    Login
                </a>

                <a href="/register" class="btn btn-light me-lg-2 mb-2 mb-lg-0">
                    Register
                </a>

            </div>

        </div>

    </div>

</nav>

<!-- HERO -->
<section class="hero">
    <div class="container">

        <div class="row align-items-center">

            <div class="col-12 col-lg-6 text-center text-lg-start">

                <h1 class="display-4 fw-bold">
                    Kelola Keuangan Lebih Cerdas Dengan AI
                </h1>

                <p class="lead mt-3">
                    FinTrack AI membantu mahasiswa, karyawan,
                    dan freelancer mengatur keuangan,
                    mencapai target tabungan,
                    serta memahami pola pengeluaran mereka.
                </p>

                <div class="mt-4">
                    <a href="/register" class="btn btn-light btn-lg me-2">
                        Mulai Gratis
                    </a>

                    <a href="#fitur" class="btn btn-outline-light btn-lg">
                        Pelajari Lebih Lanjut
                    </a>
                </div>

            </div>

            <div class="col-12 col-lg-6 text-center mt-5 mt-lg-0">

                <img
                    src="{{ asset('images/hero-fintrack.png') }}"
                    alt="FinTrack AI Dashboard"
                    class="img-fluid hero-image">

            </div>

        </div>

    </div>
</section>

<!-- STATS -->
<section class="py-5 bg-light">

    <div class="container">

        <div class="row g-4">

            <div class="col-12 col-md-4">
                <div class="stats-box">
                    <h2 class="fw-bold">10K+</h2>
                    <p>Pengguna Aktif</p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="stats-box">
                    <h2 class="fw-bold">Rp 2 M+</h2>
                    <p>Target Tabungan Tercapai</p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="stats-box">
                    <h2 class="fw-bold">95%</h2>
                    <p>Kepuasan Pengguna</p>
                </div>
            </div>

        </div>

    </div>

</section>

<!-- FITUR -->
<section id="fitur" class="py-5">

    <div class="container">

        <h2 class="text-center section-title">
            Fitur Unggulan
        </h2>

        <div class="row g-4">

            <div class="col-12 col-md-4">
                <div class="card feature-card shadow p-4 h-100">
                    <h4>Dashboard Keuangan</h4>
                    <p>
                        Pantau pemasukan, pengeluaran,
                        dan saldo secara real-time.
                    </p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card feature-card shadow p-4 h-100">
                    <h4>Target Tabungan</h4>
                    <p>
                        Tetapkan tujuan finansial dan
                        pantau progres pencapaiannya.
                    </p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card feature-card shadow p-4 h-100">
                    <h4>AI Insight</h4>
                    <p>
                        Dapatkan rekomendasi penghematan
                        berdasarkan kebiasaan transaksi.
                    </p>
                </div>
            </div>

        </div>

    </div>

</section>

<!-- PROBLEM -->
<section class="py-5 bg-light">

    <div class="container">

        <h2 class="text-center section-title">
            Masalah Yang Diselesaikan
        </h2>

        <div class="row text-center">

            <div class="col-12 col-md-4">
                <h5>Uang Cepat Habis</h5>
                <p>Tidak tahu kemana pengeluaran pergi.</p>
            </div>

            <div class="col-12 col-md-4">
                <h5>Sulit Menabung</h5>
                <p>Tidak memiliki target dan perencanaan.</p>
            </div>

            <div class="col-12 col-md-4">
                <h5>Tidak Ada Analisis</h5>
                <p>Kesulitan memahami pola keuangan.</p>
            </div>

        </div>

    </div>

</section>

<!-- PRICING -->
<section class="py-5">

    <div class="container">

        <h2 class="text-center section-title">
            Paket Berlangganan
        </h2>

        <div class="row justify-content-center">

            <div class="col-12 col-md-4">

                <div class="card pricing-card shadow p-4">

                    <h3>Gratis</h3>

                    <h2>Rp0</h2>

                    <ul>
                        <li>Catat transaksi</li>
                        <li>Dashboard</li>
                        <li>Laporan dasar</li>
                    </ul>

                    <button class="btn btn-dark w-100">
                        Mulai
                    </button>

                </div>

            </div>

            <div class="col-12 col-md-4">

                <div class="card pricing-card shadow p-4 border-dark">

                    <h3>Premium</h3>

                    <h2>Rp29.000/bulan</h2>

                    <ul>
                        <li>AI Insight</li>
                        <li>Prediksi keuangan</li>
                        <li>Export PDF</li>
                        <li>Target tabungan lanjutan</li>
                    </ul>

                    <button class="btn btn-dark w-100">
                        Upgrade
                    </button>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- CTA -->
<section class="py-5 text-center text-white" style="background:#111111;">

    <div class="container">

        <h2>
            Mulai Kendalikan Keuanganmu Hari Ini
        </h2>

        <p>
            Jadikan setiap rupiah lebih berarti bersama FinTrack AI.
        </p>

        <a href="/register" class="btn btn-light btn-lg">
            Daftar Sekarang
        </a>

    </div>

</section>

<!-- FOOTER -->
<footer>

    <div class="container text-center">

        <h4>FinTrack AI</h4>

        <p>
            Asisten Keuangan Pribadi Berbasis AI
        </p>

        <small>
            © 2026 FinTrack AI. All Rights Reserved.
        </small>

    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>