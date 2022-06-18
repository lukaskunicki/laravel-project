@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($players as $player)
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://via.placeholder.com/100" alt="...">
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
                            @if (Auth::user()->id === $player->club->trainer_id)
                                <div>
                                    <a href="{{url()->current()}}/edit/{{$player->id}}" class="btn btn-primary mx-1">Edit</a>
                                    <a href="{{url()->current()}}/delete/{{$player->id}}" class="btn btn-danger mx-1">Remove</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
