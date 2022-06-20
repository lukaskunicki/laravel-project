@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 my-5">
                <h1 class="text-center">Football Team Manager</h1>
                <div class="ball-wrapper text-center my-3">
                    <img src="/uploads/ball.svg" alt="ball"/>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-4 my-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Players</h5>
                        <p class="card-text">Check out all the players in the market. Sign in to add a player to your club.</p>
                        <a href="/players" class="btn btn-primary">All players</a>
                        @if(Auth::user())
                            <a class="btn btn-success" href="/players/create">
                                New Player
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-4 my-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Clubs</h5>
                        <p class="card-text">Find out who you're gonna play against in your league. Sign in to add a new club.</p>
                        <a href="/clubs" class="btn btn-primary">All clubs</a>
                        @if(Auth::user())
                            <a class="btn btn-success" href="/clubs/create">
                                New Club
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-4 my-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Leagues</h5>
                        <p class="card-text">Check all the leagues available in the system. Only admins are allowed to manipulate here.</p>
                        <a href="/leagues" class="btn btn-primary">All leagues</a>
                        @if(Auth::user() && Auth::user()->is_admin)
                            <a class="btn btn-success" href="/leagues/create">
                                New League
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-4 my-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Positions</h5>
                        <p class="card-text">Players can play on multiple positions - check them out. Only admins are available to manipulate here</p>
                        <a href="/positions" class="btn btn-primary">All positions</a>
                        @if(Auth::user() && Auth::user()->is_admin)
                            <a class="btn btn-success" href="/positions/create">
                                New Position
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-4 my-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nationalities</h5>
                        <p class="card-text">Each player is assigned to the nationality. Only admins are available to manipulate here</p>
                        <a href="/nationalities" class="btn btn-primary">All nationalities</a>
                        @if(Auth::user() && Auth::user()->is_admin)
                            <a class="btn btn-success" href="/nationalities/create">
                                New Nationality
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
