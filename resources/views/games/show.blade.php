@extends('layouts.app')

@section('content')
    <meta name="logged-in" content="{{ Auth::check() ? 'true' : 'false' }}">
    <meta name="get-game" content="{{ route('games.get-game', $game) }}">

    @if (Auth::check())
        <meta name="get-user-credits" content="{{ route('users.get-credits', Auth::user()) }}">
        <meta name="get-user-active-game" content="{{ route('users.get-active', Auth::user()) }}">
        <meta name="get-start-game" content="{{ route('users.start-game', Auth::user()) }}">
        <meta name="get-stop-game" content="{{ route('users.stop-game', Auth::user()) }}">
    @endif
    <div class="container">
        <div class="card mb-3 game-card">
            <div class="card-header">
                <h1>Welcome to The Online Arcade</h1>
            </div>
            <div class="card-body d-none not-logged-in">
                <p>Welcome! this is the place where you want to be to play online arcade games. Have fun!</p>
            </div>
            <div class="card-body d-none logged-in">
                Welcome back! You have <span id="user-credits"></span> credits left
            </div>
        </div>
        <div class="card col-6" id="big-game-card">
            <div class="card-header">
                <h1 class="game-name"></h1>
            </div>
            <div class="card-body row">
                <div class="col-4">
                    <img src="" alt="" class="rounded-4 w-100">
                </div>
                <div class="col-8">
                    <p class="description">
                    </p>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-none not-logged-in">
                    <small>Please log in to play this game</small>
                </div>
                <div class="d-none logged-in">
                    <p class="w-100">This costs <span class="credit-cost"></span> credit per play</p>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary w-100 play-btn" data-game="whach-a-mole"
                            data-cost="3">
                            Play game
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @vite(['resources/js/show.js'])
@endsection
