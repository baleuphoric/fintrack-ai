@extends('layouts.app')

@section('title','Edit Profil')

@section('content')

<div class="card shadow border-0">

    <div class="card-header bg-dark text-white">
        Edit Profil
    </div>

    <div class="card-body">

        <form method="POST"
              action="{{ route('profile.update') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Nama</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ auth()->user()->name }}"
                    required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ auth()->user()->email }}"
                    required>
            </div>

            <div class="mb-3">

    <label class="form-label">
        Foto Profil
    </label>

    <input
        type="file"
        name="avatar"
        class="form-control">

</div>

            <button
                type="submit"
                class="btn btn-dark">
                Simpan Perubahan
            </button>

        </form>

    </div>

</div>

@endsection