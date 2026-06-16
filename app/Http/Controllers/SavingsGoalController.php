<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SavingsGoal;

class SavingsGoalController extends Controller
{
    public function index()
    {
        $goals = SavingsGoal::where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->get();

        return view(
            'savings.savings',
            compact('goals')
        );
    }

    public function create()
    {
        return view('savings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'goal_name'      => 'required',
            'target_amount'  => 'required|numeric',
            'current_amount' => 'required|numeric',
            'deadline'       => 'nullable|date',
        ]);

        SavingsGoal::create([
            'user_id'        => Auth::id(),
            'goal_name'      => $request->goal_name,
            'target_amount'  => $request->target_amount,
            'current_amount' => $request->current_amount,
            'deadline'       => $request->deadline,
        ]);

        return redirect()
            ->route('savings-goals.index')
            ->with(
                'success',
                'Target berhasil ditambahkan'
            );
    }

    public function show($id)
    {
        $goal = SavingsGoal::findOrFail($id);

        return view(
            'savings.show',
            compact('goal')
        );
    }

    public function edit($id)
    {
        $goal = SavingsGoal::findOrFail($id);

        return view(
            'savings.edit',
            compact('goal')
        );
    }

    public function update(
        Request $request,
        $id
    )
    {
        $goal = SavingsGoal::findOrFail($id);

        $request->validate([
            'goal_name'      => 'required',
            'target_amount'  => 'required|numeric',
            'current_amount' => 'required|numeric',
            'deadline'       => 'nullable|date',
        ]);

        $goal->update([
            'goal_name'      => $request->goal_name,
            'target_amount'  => $request->target_amount,
            'current_amount' => $request->current_amount,
            'deadline'       => $request->deadline,
        ]);

        return redirect()
            ->route('savings-goals.index')
            ->with(
                'success',
                'Target berhasil diperbarui'
            );
    }

    public function destroy($id)
    {
        $goal = SavingsGoal::findOrFail($id);

        $goal->delete();

        return redirect()
            ->route('savings-goals.index')
            ->with(
                'success',
                'Target berhasil dihapus'
            );
    }

    public function deposit(
        Request $request,
        $id
    )
    {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        $goal = SavingsGoal::findOrFail($id);

        $goal->current_amount +=
            $request->amount;

        $goal->save();

        return redirect()
            ->back()
            ->with(
                'success',
                'Tabungan berhasil ditambahkan'
            );
    }
}