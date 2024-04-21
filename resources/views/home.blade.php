@extends('layouts.app')

@section('content')
    <meta name="logged-in" content="{{ Auth::check() ? 'true' : 'false' }}">
    <meta name="get-games" content="{{ route('games.get-games') }}">
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
        <div class="row" id="games-container">

        </div>
    </div>
    @vite(['resources/js/index.js'])
@endsection
