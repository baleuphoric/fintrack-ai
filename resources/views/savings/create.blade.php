@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-body">

        <h3 class="mb-4">
            Tambah Target Tabungan
        </h3>

        <form
            action="{{ route('savings-goals.store') }}"
            method="POST">

            @csrf

            <div class="mb-3">

                <label>Nama Target</label>

                <input
                    type="text"
                    name="goal_name"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Target Dana</label>

                <input
                    type="number"
                    name="target_amount"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Dana Saat Ini</label>

                <input
                    type="number"
                    name="current_amount"
                    class="form-control"
                    value="0">

            </div>

            <div class="mb-3">

                <label>Deadline</label>

                <input
                    type="date"
                    name="deadline"
                    class="form-control">

            </div>

            <button
                class="btn btn-dark">

                Simpan

            </button>

        </form>

    </div>

</div>

@endsection