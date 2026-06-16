<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingsGoal extends Model
{
     protected $table = 'savings_goals';
    protected $fillable = [
        'user_id',
        'goal_name',
        'target_amount',
        'current_amount',
        'deadline'
    ];
}