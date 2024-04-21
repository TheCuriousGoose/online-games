<?php

namespace App\Http\Controllers;

use App\Models\ActiveGame;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getCredits(User $user)
    {
        return response()->json($user->credits);
    }

    public function startGame(User $user, Request $request)
    {
        if (!$user) {
            return response()->json('invalid usage of user', 400);
        }

        if (!$request->game_name) {
            return response()->json('invalid usage of game_name', 400);
        }

        if (!$request->credits_to_deduct) {
            return response()->json('invalid usage of credits_to_deduct', 400);
        }

        if (count($user->activeGame) > 0) {
            return response()->json('User already has active game', 400);
        }

        $user->update([
            'credits' => $user->credits - $request->credits_to_deduct
        ]);

        CreditLogController::saveUpdateLog($user, $request->game_name, $request->credits_to_deduct);

        ActiveGame::create([
            'user_id' => $user->id,
            'game_name' => $request->game_name
        ]);

        $response = [
            'user_id' => $user->id,
            'credits_left' => $user->credits
        ];

        return response()->json($response);
    }

    public function getActiveGame(User $user)
    {
        $activeGame = $user->activeGame;

        if (!isset($activeGame)) {
            return response()->json('false');
        }

        return response()->json($activeGame);
    }

    public function stopGame(User $user, Request $request)
    {
        if (!$user) {
            return response()->json('invalid usage of user', 400);
        }

        if (!$request->game_name) {
            return response()->json('invalid usage of game_name', 400);
        }

        if (count($user->activeGame) === 0) {
            return response()->json('User has no active games', 400);
        }

        $activeGame = $user->activeGame->first();

        if ($activeGame->game_name !== $request->game_name) {
            return response()->json('Please give the correct game name', 400);
        }

        return $activeGame->delete();;
    }
}
