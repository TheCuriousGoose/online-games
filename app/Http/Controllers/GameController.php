<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function show(Game $game){
        return view('games.show', [
            'game' => $game
        ]);
    }

    public function getGames(){
        $games = Game::all();

        return response()->json($games);
    }

    public function getGame(Game $game){
        return response()->json($game);
    }
}
