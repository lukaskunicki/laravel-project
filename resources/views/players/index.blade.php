@extends('layouts.app')

@section('content')
    @if ($title === 'All players')
    <div class="container" id="search-container">
        <div class="row">
            <div class="col-sm-3 d-flex justify-content-between mt-2 mb-4">
                <div class="form-outline">
                    <label class="form-label" for="search">Search</label>
                    <input type="search" class="form-control" data-endpoint="/players/search/"/>
                </div>
                <div class="d-flex align-items-end">
                    <button type="button" class="btn btn-primary">
                        Find
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="container my-5">
        <div class="row justify-content-center" id="search-results" data-template="player">
            @foreach($players as $player)
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ $player->name }} {{ $player->lastname }} </h3>
                            <div class="card-text pt-3">
                                <p>
                                    <strong>Positions: </strong>
                                    @foreach($player->positions as $pos)
                                        {{ $pos->short_name }}
                                    @endforeach
                                </p>
                                <p>
                                    <strong>Nationality: </strong>
                                    {{ $player->nationality->name }}
                                </p>
                                <p>
                                    <strong>Club: </strong>
                                    {{ $player->club->name }}
                                </p>
                                <p>
                                    <strong>Height: </strong> {{ $player->height }} cm
                                </p>
                                <p>
                                    <strong>Weight: </strong> {{ $player->weight }} kg
                                </p>
                            </div>
                            @if (Auth::user() && Auth::user()->id === $player->club->trainer_id)
                                <div>
                                    <a href="/players/edit/{{$player->id}}" class="btn btn-primary mx-1">Edit</a>
                                    <a href="/players/delete/{{$player->id}}" class="btn btn-danger mx-1">Remove</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
