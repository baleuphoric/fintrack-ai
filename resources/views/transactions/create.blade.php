@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Tambah Transaksi</h2>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="category" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tipe</label>
            <select name="type" class="form-control">
                <option value="income">Pemasukan</option>
                <option value="expense">Pengeluaran</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="amount" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="date" class="form-control">
        </div>

        <button class="btn btn-dark">
            Simpan
        </button>

    </form>
</div>

@endsection