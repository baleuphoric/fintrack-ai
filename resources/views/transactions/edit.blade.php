@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow border-0">

        <div class="card-header">
            <h4 class="mb-0">
                Edit Transaksi
            </h4>
        </div>

        <div class="card-body">

            <form action="{{ route('transactions.update', $transaction->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Judul
                    </label>

                    <input type="text"
                           name="title"
                           value="{{ $transaction->title }}"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Kategori
                    </label>

                    <input type="text"
                           name="category"
                           value="{{ $transaction->category }}"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Tipe
                    </label>

                    <select name="type"
                            class="form-select">

                        <option value="income"
                            {{ $transaction->type == 'income' ? 'selected' : '' }}>
                            Pemasukan
                        </option>

                        <option value="expense"
                            {{ $transaction->type == 'expense' ? 'selected' : '' }}>
                            Pengeluaran
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Jumlah
                    </label>

                    <input type="number"
                           name="amount"
                           value="{{ $transaction->amount }}"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Tanggal
                    </label>

                    <input type="date"
                           name="date"
                           value="{{ $transaction->date }}"
                           class="form-control"
                           required>

                </div>

                <button class="btn btn-dark">
                    Update
                </button>

                <a href="{{ route('transactions.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

@endsection