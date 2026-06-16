@extends('layouts.app')

@section('title','AI Insight')

@section('content')


<div class="card shadow mb-4">

    <div class="card-body">

        <h5>
            Ringkasan Keuangan
        </h5>

        <hr>

        <div class="row">

            <div class="col-md-4">

                <div class="alert alert-success">

                    <h6>
                        Total Pemasukan
                    </h6>

                    <h4>
                        Rp {{ number_format($income,0,',','.') }}
                    </h4>

                </div>

            </div>

            <div class="col-md-4">

                <div class="alert alert-danger">

                    <h6>
                        Total Pengeluaran
                    </h6>

                    <h4>
                        Rp {{ number_format($expense,0,',','.') }}
                    </h4>

                </div>

            </div>

            <div class="col-md-4">

                <div class="alert alert-primary">

                    <h6>
                        Saldo Saat Ini
                    </h6>

                    <h4>
                        Rp {{ number_format($balance,0,',','.') }}
                    </h4>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card shadow mb-4">

    <div class="card-body">

        <h5>
            Pengeluaran Terbesar
        </h5>

        <hr>

        @if($topCategory)

            <div class="text-center">

                <h3 class="text-danger fw-bold">
                    {{ $topCategory->category }}
                </h3>

                <p class="fs-5">
                    Rp {{ number_format($topCategory->total,0,',','.') }}
                </p>

            </div>

        @else

            <div class="alert alert-secondary">

                Belum ada data transaksi.

            </div>

        @endif

    </div>

</div>

<div class="card shadow">

    <div class="card-body">

        <h5>
            Analisis AI
        </h5>

        <hr>

        <div class="alert alert-{{ $aiType }}">

            {{ $aiMessage }}

        </div>

        @if($topCategory)

            <div class="alert alert-warning">

                Pengeluaran terbesar Anda berada pada kategori

                <b>{{ $topCategory->category }}</b>

                sebesar

                <b>
                    Rp {{ number_format($topCategory->total,0,',','.') }}
                </b>

                .

                Pertimbangkan untuk mengurangi pengeluaran pada kategori ini agar tabungan meningkat.

            </div>

        @endif

        @if($balance > 0)

            <div class="alert alert-success">

                Dengan saldo saat ini sebesar

                <b>
                    Rp {{ number_format($balance,0,',','.') }}
                </b>

                Anda masih memiliki ruang untuk menabung dan mencapai target keuangan lebih cepat.

            </div>

        @endif

    </div>

</div>

@endsection