@extends('layouts.app')

@section('title','Ubah Password')

@section('content')

<div class="card shadow border-0">

    <div class="card-header bg-dark text-white">
        Ubah Password
    </div>

    <div class="card-body">

        <form method="POST"
              action="{{ route('profile.password.update') }}">
            @csrf

            <div class="mb-3">
                <label>Password Baru</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    required>
            </div>

            <button
                type="submit"
                class="btn btn-dark">
                Update Password
            </button>

        </form>

    </div>

</div>

@endsection