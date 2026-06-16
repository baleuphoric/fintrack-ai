<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\SavingsGoal;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Total pemasukan
        $income = Transaction::where(
            'user_id',
            $userId
        )
        ->where(
            'type',
            'income'
        )
        ->sum('amount');

        // Total pengeluaran
        $expense = Transaction::where(
            'user_id',
            $userId
        )
        ->where(
            'type',
            'expense'
        )
        ->sum('amount');

        // Saldo
        $balance = $income - $expense;

        // Target tabungan terbaru
        $goals = SavingsGoal::where(
            'user_id',
            $userId
        )
        ->latest()
        ->take(3)
        ->get();

        // Transaksi terbaru
        $latestTransactions = Transaction::where(
            'user_id',
            $userId
        )
        ->latest()
        ->take(5)
        ->get();

        // Total target
        $totalGoals = SavingsGoal::where(
            'user_id',
            $userId
        )
        ->count();

        // Target tercapai
        $completedGoals = SavingsGoal::where(
            'user_id',
            $userId
        )
        ->whereRaw(
            'current_amount >= target_amount'
        )
        ->count();

        // Grafik kategori pengeluaran
        $categoryData = Transaction::where(
                'user_id',
                $userId
            )
            ->where(
                'type',
                'expense'
            )
            ->select(
                'category',
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('category')
            ->get();

        $categoryLabels = $categoryData
            ->pluck('category');

        $categoryTotals = $categoryData
            ->pluck('total');

        // Grafik pengeluaran bulanan realtime
        $monthlyExpense = Transaction::where(
                'user_id',
                $userId
            )
            ->where(
                'type',
                'expense'
            )
            ->select(
                DB::raw('MONTH(date) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthNames = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        ];

        $expenseData = array_fill(0, 12, 0);

        foreach ($monthlyExpense as $item) {

            $expenseData[
                $item->month - 1
            ] = $item->total;

        }

        return view(
            'dashboard.dashboard',
            compact(
                'income',
                'expense',
                'balance',
                'goals',
                'latestTransactions',
                'totalGoals',
                'completedGoals',
                'categoryLabels',
                'categoryTotals',
                'monthNames',
                'expenseData'
            )
        );
    }
}