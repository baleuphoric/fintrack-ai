@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('savings-goals.create') }}"
       class="btn btn-dark">
        Tambah Target
    </a>
</div>


<!-- SUMMARY -->
<div class="row mb-4">

    <div class="col-md-4">
        <div class="card shadow border-0">
            <div class="card-body text-center">
                <h6>Total Target</h6>
                <h3 class="text-success">
                    {{ $goals->count() }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow border-0">
            <div class="card-body text-center">
                <h6>Target Tercapai</h6>
                <h3 class="text-success">
                    {{ $goals->filter(function($goal){
                        return $goal->current_amount >= $goal->target_amount;
                    })->count() }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow border-0">
            <div class="card-body text-center">
                <h6>Total Dana Terkumpul</h6>
                <h3 class="text-warning">
                    Rp {{ number_format($goals->sum('current_amount'),0,',','.') }}
                </h3>
            </div>
        </div>
    </div>

</div>

@if($goals->count() > 0)

<div class="row">

@foreach($goals as $goal)

@php

    $percentage = 0;

    if($goal->target_amount > 0){
        $percentage =
        ($goal->current_amount / $goal->target_amount) * 100;
    }

    if($percentage > 100){
        $percentage = 100;
    }

    $remaining =
    $goal->target_amount - $goal->current_amount;

@endphp

<div class="col-md-6 mb-4">

    <div class="card shadow border-0">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-start">

                <h4 class="fw-bold">
                    {{ $goal->goal_name }}
                </h4>

                @if($percentage >= 100)

                    <span class="badge bg-dark">
                        🎉 Tercapai
                    </span>

                @elseif($percentage >= 80)

                    <span class="badge bg-secondary">
                        🔥 Hampir Tercapai
                    </span>

                @else

                    <span class="badge bg-light text-dark border">
                        🚀 Berjalan
                    </span>

                @endif

            </div>

            <p class="mb-2">

                Rp {{ number_format($goal->current_amount,0,',','.') }}
                /
                Rp {{ number_format($goal->target_amount,0,',','.') }}

            </p>

            <div class="progress mb-3" style="height:25px;">

                <div
                    class="progress-bar

                    @if($percentage >= 100)
                        bg-success
                    @elseif($percentage >= 80)
                        bg-warning
                    @else
                        bg-primary
                    @endif

                    "
                    role="progressbar"
                    style="width: {{ $percentage }}%;">

                    {{ round($percentage) }}%

                </div>

            </div>

            <p class="text-muted mb-2">

                Sisa:
                Rp {{ number_format($remaining,0,',','.') }}

            </p>

            @if($goal->deadline)

            @php
                $deadline = \Carbon\Carbon::parse($goal->deadline)->startOfDay();
                $today = now()->startOfDay();

                $daysLeft = $today->diffInDays($deadline, false);
            @endphp

            <small class="text-secondary d-block mb-2">
                Deadline:
                {{ $deadline->format('d M Y') }}
            </small>

            @if($daysLeft >= 0 && $daysLeft <= 7)
                <div class="alert border mt-2 mb-0 bg-light">
                    Deadline tinggal
                    <strong>{{ $daysLeft }}</strong>
                    hari lagi.
                </div>
            @elseif($daysLeft < 0)
                <div class="alert alert-danger mt-2 mb-0">
                    Target melewati deadline
                    <strong>{{ abs($daysLeft) }}</strong>
                    hari yang lalu.
                </div>
            @endif

        @endif

            <hr>

            <!-- TAMBAH DANA -->

            <form
                action="{{ route('savings-goals.deposit',$goal->id) }}"
                method="POST"
                class="mb-3">

                @csrf

                <div class="input-group">

                    <input
                        type="number"
                        name="amount"
                        class="form-control"
                        placeholder="Tambah dana"
                        required>

                    <button
                        class="btn btn-dark">

                        + Dana

                    </button>

                </div>

            </form>

            <!-- ACTION -->

            <a
                href="{{ route('savings-goals.edit',$goal->id) }}"
                class="btn btn-outline-dark btn-sm">

                Edit

            </a>

            <form
                action="{{ route('savings-goals.destroy',$goal->id) }}"
                method="POST"
                class="d-inline">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Yakin hapus target ini?')">

                    Hapus

                </button>

            </form>

        </div>

    </div>

</div>

@endforeach

</div>

@else

<div class="card shadow border-0">

    <div class="card-body text-center p-5">

        <h4>
            Belum ada target tabungan
        </h4>

        <p class="text-muted">
            Silakan buat target pertama kamu.
        </p>

    </div>

</div>

@endif

@endsection