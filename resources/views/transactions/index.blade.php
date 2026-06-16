@extends('layouts.app')

@section('content')

<div class="mb-4 d-flex justify-content-end gap-2">
    <a
        href="{{ route('report.pdf') }}"
        class="btn btn-outline-dark">
        Export PDF
    </a>

    <a
        href="{{ route('transactions.create') }}"
        class="btn btn-dark">
        Tambah Transaksi
    </a>
</div>

    <div class="card shadow border-0">

        <div class="card-body">

            <table class="table table-hover align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tipe</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th width="180">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($transactions as $transaction)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $transaction->title }}
                        </td>

                        <td>
                            {{ $transaction->category }}
                        </td>

                        <td>

                            @if($transaction->type == 'income')

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

                            Rp {{ number_format(
                                $transaction->amount,
                                0,
                                ',',
                                '.'
                            ) }}

                        </td>

                        <td>
                            {{ $transaction->date }}
                        </td>

                        <td>

                            <a href="{{ route('transactions.edit', $transaction->id) }}"
                               class="btn btn-dark btn-sm">

                                Edit

                            </a>

                            <form
                                action="{{ route('transactions.destroy', $transaction->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-dark btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus transaksi ini?')">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center text-muted">

                            Belum ada transaksi

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection