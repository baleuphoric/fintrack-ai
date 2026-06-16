<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
{
    $query = Transaction::where(
        'user_id',
        auth()->id()
    );

    if ($request->keyword) {
        $query->where(
            'title',
            'like',
            '%' . $request->keyword . '%'
        );
    }

    if ($request->category) {
        $query->where(
            'category',
            $request->category
        );
    }

    if ($request->type) {
        $query->where(
            'type',
            $request->type
        );
    }

    if ($request->start_date) {
        $query->whereDate(
            'date',
            '>=',
            $request->start_date
        );
    }

    if ($request->end_date) {
        $query->whereDate(
            'date',
            '<=',
            $request->end_date
        );
    }

    $transactions = $query
        ->latest()
        ->paginate(10);

    $categories = Transaction::where(
        'user_id',
        auth()->id()
    )
    ->select('category')
    ->distinct()
    ->pluck('category');

    $income = Transaction::where(
        'user_id',
        auth()->id()
    )
    ->where(
        'type',
        'income'
    )
    ->sum('amount');

    $expense = Transaction::where(
        'user_id',
        auth()->id()
    )
    ->where(
        'type',
        'expense'
    )
    ->sum('amount');

    return view(
        'transactions.index',
        compact(
            'transactions',
            'categories',
            'income',
            'expense'
        )
    );
}

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required',
            'category' => 'required',
            'type'     => 'required',
            'amount'   => 'required|numeric',
            'date'     => 'required|date',
        ]);

        Transaction::create([
            'user_id'  => Auth::id(),
            'title'    => $request->title,
            'category' => $request->category,
            'type'     => $request->type,
            'amount'   => $request->amount,
            'date'     => $request->date,
        ]);

        return redirect()
            ->route('transactions.index')
            ->with(
                'success',
                'Transaksi berhasil ditambahkan'
            );
    }

    public function show(Transaction $transaction)
    {
        return view(
            'transactions.show',
            compact('transaction')
        );
    }

    public function edit(Transaction $transaction)
    {
        return view(
            'transactions.edit',
            compact('transaction')
        );
    }

    public function update(
        Request $request,
        Transaction $transaction
    )
    {
        $request->validate([
            'title'    => 'required',
            'category' => 'required',
            'type'     => 'required',
            'amount'   => 'required|numeric',
            'date'     => 'required|date',
        ]);

        $transaction->update([
            'title'    => $request->title,
            'category' => $request->category,
            'type'     => $request->type,
            'amount'   => $request->amount,
            'date'     => $request->date,
        ]);

        return redirect()
            ->route('transactions.index')
            ->with(
                'success',
                'Transaksi berhasil diperbarui'
            );
    }

    public function destroy(
        Transaction $transaction
    )
    {
        $transaction->delete();

        return redirect()
            ->route('transactions.index')
            ->with(
                'success',
                'Transaksi berhasil dihapus'
            );
    }
}