<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function exportPdf(Request $request)
    {
        $userId = auth()->id();

        $transactions = Transaction::where(
                'user_id',
                $userId
            )
            ->orderBy('date', 'desc')
            ->get();

        $income = Transaction::where(
                'user_id',
                $userId
            )
            ->where(
                'type',
                'income'
            )
            ->sum('amount');

        $expense = Transaction::where(
                'user_id',
                $userId
            )
            ->where(
                'type',
                'expense'
            )
            ->sum('amount');

        $balance = $income - $expense;

        $pdf = Pdf::loadView(
            'reports.pdf',
            compact(
                'transactions',
                'income',
                'expense',
                'balance'
            )
        );

        return $pdf->download(
            'Laporan-FinTrack-AI.pdf'
        );
    }
}