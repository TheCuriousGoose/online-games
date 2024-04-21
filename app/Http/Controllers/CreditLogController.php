<?php

namespace App\Http\Controllers;

use App\Models\CreditLog;
use App\Models\User;
use Illuminate\Http\Request;

class CreditLogController extends Controller
{
    public static function saveUpdateLog(User $user, $game, $creditsDeducted)
    {
        CreditLog::create([
            'user_id' => $user->id,
            'game_name' => $game,
            'credits_deducted' => $creditsDeducted
        ]);
    }
}
