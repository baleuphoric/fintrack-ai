@extends('layouts.app')

@push('styles')
<style>

.balance-card{
    background: linear-gradient( 135deg,#111111,#2d2d2d);
    color:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.1);
}

.card{
    border:none;
    border-radius:15px;
}

.progress{
    height:20px;
}

</style>
@endpush

@section('content')

<div class="balance-card mb-4">
    <small>Total Saldo</small>
    <h1 class="fw-bold">
        Rp {{ number_format($balance,0,',','.') }}
    </h1>
    <p>
        Update terakhir hari ini
    </p>
</div>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card shadow p-3">
            <h5>Pemasukan</h5>
            <h3 class="text-success">
                Rp {{ number_format($income,0,',','.') }}
            </h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow p-3">
            <h5>Pengeluaran</h5>
            <h3 class="text-danger">
                Rp {{ number_format($expense,0,',','.') }}
            </h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow p-3">
            <h5>Saldo</h5>
            <h3 class="text-primary">
                Rp {{ number_format($balance,0,',','.') }}
            </h3>
        </div>
    </div>

</div>

<div class="row mt-4 g-4">

    <div class="col-md-6">
        <div class="card shadow p-3">
            <h5>Total Target</h5>
            <h2 class="text-primary">
                {{ $totalGoals }}
            </h2>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow p-3">
            <h5>Target Tercapai</h5>
            <h2 class="text-success">
                {{ $completedGoals }}
            </h2>
        </div>
    </div>

</div>

<div class="row mt-4">

    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-body">
                <h5>
                    Pengeluaran Bulanan
                </h5>

                <canvas id="expenseChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow">
            <div class="card-body">
                <h5>
                    Kategori Pengeluaran
                </h5>

                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

</div>

<div class="card shadow mt-4">

    <div class="card-body">

        <h4>
            Target Tabungan Terbaru
        </h4>

        @forelse($goals as $goal)

        @php
            $percentage = 0;

            if($goal->target_amount > 0){
                $percentage =
                ($goal->current_amount /
                $goal->target_amount) * 100;
            }
        @endphp

        <div class="mb-4">

            <h6>
                {{ $goal->goal_name }}
            </h6>

            <p>
                Rp {{ number_format($goal->current_amount,0,',','.') }}
                /
                Rp {{ number_format($goal->target_amount,0,',','.') }}
            </p>

            <div class="progress">

                <div
                    class="progress-bar bg-success"
                    style="width:{{ min($percentage,100) }}%"
                >
                    {{ round($percentage) }}%
                </div>

            </div>

        </div>

        @empty

        <p>
            Belum ada target tabungan
        </p>

        @endforelse

    </div>

</div>

<div class="card shadow mt-4">

    <div class="card-body">

        <h4>
            Transaksi Terbaru
        </h4>

        <table class="table table-striped">

            <thead>

            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tipe</th>
                <th>Nominal</th>
            </tr>

            </thead>

            <tbody>

            @forelse($latestTransactions as $trx)

            <tr>

                <td>
                    {{ $trx->title }}
                </td>

                <td>
                    {{ $trx->category }}
                </td>

                <td>

                    @if($trx->type == 'income')

                    <span class="badge bg-success">
                        Pemasukan
                    </span>

                    @else

                    <span class="badge bg-danger">
                        Pengeluaran
                    </span>

                    @endif

                </td>

                <td>
                    Rp {{ number_format($trx->amount,0,',','.') }}
                </td>

            </tr>

            @empty

            <tr>

                <td colspan="4" class="text-center">
                    Belum ada transaksi
                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

<div class="card shadow mt-4">

    <div class="card-body">

        <h4>
            AI Insight
        </h4>

        <div class="alert alert-primary">
            Total pemasukan saat ini:
            <b>
                Rp {{ number_format($income,0,',','.') }}
            </b>
        </div>

        <div class="alert alert-success">
            Total saldo tersisa:
            <b>
                Rp {{ number_format($balance,0,',','.') }}
            </b>
        </div>

        <div class="alert alert-warning">
            Tetap kontrol pengeluaran agar target tabungan cepat tercapai.
        </div>

    </div>

</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(
    document.getElementById('expenseChart'),
    {
        type:'bar',
        data:{
            labels:
            {!! json_encode($monthNames) !!},

            datasets:[{
                label:'Pengeluaran',

                data:
                {!! json_encode($expenseData) !!},

                backgroundColor:'#dc3545',

                borderRadius:8
            }]
        },

        options:{
            responsive:true,

            plugins:{
                legend:{
                    display:true
                }
            },

            scales:{
                y:{
                    beginAtZero:true
                }
            }
        }
    }
);

new Chart(
    document.getElementById('categoryChart'),
    {
        type:'doughnut',
        data:{
            labels:
                {!! json_encode($categoryLabels) !!},

            datasets:[{
                data:
                    {!! json_encode($categoryTotals) !!},

                backgroundColor:[
                    '#0d6efd',
                    '#198754',
                    '#dc3545',
                    '#ffc107',
                    '#6f42c1',
                    '#20c997'
                ]
            }]
        }
    }
);

</script>

@endpush