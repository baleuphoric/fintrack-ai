<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class InsightController extends Controller
{
    public function index()
    {
        $topCategory = Transaction::where('type', 'expense')
            ->select(
                'category',
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('category')
            ->orderByDesc('total')
            ->first();

        $income = Transaction::where(
            'type',
            'income'
        )->sum('amount');

        $expense = Transaction::where(
            'type',
            'expense'
        )->sum('amount');

        $balance = $income - $expense;

        // AI Insight Dinamis
        if ($income == 0) {

            $aiMessage =
                "Belum ada pemasukan yang tercatat. Tambahkan data pemasukan untuk mendapatkan analisis yang lebih akurat.";

            $aiType = "warning";

        } elseif ($expense > $income) {

            $aiMessage =
                "Pengeluaran Anda lebih besar daripada pemasukan. Sebaiknya kurangi pengeluaran agar kondisi keuangan tetap sehat.";

            $aiType = "danger";

        } elseif ($expense >= ($income * 0.8)) {

            $aiMessage =
                "Pengeluaran sudah mencapai lebih dari 80% pemasukan. Mulailah mengontrol pengeluaran agar saldo tidak cepat habis.";

            $aiType = "warning";

        } elseif ($balance >= 5000000) {

            $aiMessage =
                "Kondisi keuangan sangat baik. Anda memiliki saldo yang cukup besar dan dapat mempertimbangkan investasi atau menambah target tabungan.";

            $aiType = "success";

        } else {

            $aiMessage =
                "Keuangan Anda masih dalam kondisi aman. Pertahankan pola pengeluaran seperti saat ini.";

            $aiType = "primary";
        }

        return view(
            'insight.insight',
            compact(
                'topCategory',
                'income',
                'expense',
                'balance',
                'aiMessage',
                'aiType'
            )
        );
    }
}