@extends('layouts.app')

@section('content')

<div class="card shadow">
    <div class="card-body">

        <h3 class="mb-4">
            Edit Target Tabungan
        </h3>

        <form
            action="{{ route('savings-goals.update', $goal->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Target</label>
                <input
                    type="text"
                    name="goal_name"
                    class="form-control"
                    value="{{ $goal->goal_name }}">
            </div>

            <div class="mb-3">
                <label>Target Dana</label>
                <input
                    type="number"
                    name="target_amount"
                    class="form-control"
                    value="{{ $goal->target_amount }}">
            </div>

            <div class="mb-3">
                <label>Dana Saat Ini</label>
                <input
                    type="number"
                    name="current_amount"
                    class="form-control"
                    value="{{ $goal->current_amount }}">
            </div>

            <div class="mb-3">
                <label>Deadline</label>
                <input
                    type="date"
                    name="deadline"
                    class="form-control"
                    value="{{ $goal->deadline }}">
            </div>

            <button class="btn btn-dark">
                Update
            </button>

            <a href="/savings"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection