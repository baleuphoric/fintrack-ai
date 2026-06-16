@extends('layouts.app')

@section('content')

@php
$userId = auth()->id();

$income = \App\Models\Transaction::where('user_id',$userId)
            ->where('type','income')
            ->sum('amount');

$expense = \App\Models\Transaction::where('user_id',$userId)
            ->where('type','expense')
            ->sum('amount');

$balance = $income - $expense;

$totalTransactions = \App\Models\Transaction::where(
    'user_id',
    $userId
)->count();

$totalGoals = \App\Models\SavingsGoal::where(
    'user_id',
    $userId
)->count();
@endphp

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card shadow border-0 mb-4">

            <div class="card-body text-center p-5">

                @if(auth()->user()->avatar)
    <img
        src="{{ asset('storage/' . auth()->user()->avatar) }}"
        class="rounded-circle shadow mb-3"
        width="120"
        height="120"
        style="object-fit:cover;">
@else
    <div
        class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center mx-auto mb-3"
        style="
            width:120px;
            height:120px;
            font-size:42px;
            font-weight:bold;
        ">
        {{ strtoupper(substr(auth()->user()->name,0,1)) }}
    </div>
@endif

                <h2 class="fw-bold">
                    {{ auth()->user()->name }}
                </h2>

                <p class="text-muted mb-3">
                    {{ auth()->user()->email }}
                </p>

                <span class="badge bg-dark px-3 py-2">
                    FinTrack AI User
                </span>

            </div>

        </div>

    </div>

</div>

<div class="row g-4 mb-4">

    <div class="col-md-4">

        <div class="card shadow border-0">

            <div class="card-body text-center">

                <h6 class="text-muted">
                    Saldo Saat Ini
                </h6>

                <h3 class="fw-bold">
                    Rp {{ number_format($balance,0,',','.') }}
                </h3>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card shadow border-0">

            <div class="card-body text-center">

                <h6 class="text-muted">
                    Total Transaksi
                </h6>

                <h3 class="fw-bold">
                    {{ $totalTransactions }}
                </h3>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card shadow border-0">

            <div class="card-body text-center">

                <h6 class="text-muted">
                    Target Tabungan
                </h6>

                <h3 class="fw-bold">
                    {{ $totalGoals }}
                </h3>

            </div>

        </div>

    </div>

</div>

<div class="card shadow border-0">

    <div class="card-header bg-dark text-white">

        <h5 class="mb-0">
            Pengaturan Akun
        </h5>

    </div>

    <div class="card-body">

        <div class="d-grid gap-3">

            <a
                href="{{ route('profile.edit') }}"
                class="btn btn-outline-dark">

                Edit Profil

            </a>

            <a
                href="{{ route('profile.password') }}"
                class="btn btn-outline-dark">

                Ubah Password

            </a>

            <form
                method="POST"
                action="{{ route('logout') }}">

                @csrf

                <button
                    type="submit"
                    class="btn btn-dark w-100">

                    Logout

                </button>

            </form>

        </div>

    </div>

</div>

@endsection