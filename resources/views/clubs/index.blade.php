@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($clubs as $club)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ $club->name }}</h3>
                            <div class="card-text pt-3">
                                <p>
                                    <strong>League: </strong>
                                    {{ $club->league->name }}
                                </p>
                                <p>
                                    <strong>Founded in: </strong>
                                    {{ $club->foundation_date }}
                                </p>
                                <p>
                                    <strong>Trainer: </strong>
                                    {{ $club->trainer->name }}
                                    {{ $club->trainer->email }}
                                </p>
                            </div>
                            <div>
                                <a href="/players/club/{{$club->id}}" class="btn btn-primary mx-1">Show players</a>
                            </div>
                            @if (Auth::user() && Auth::user()->id === $club->trainer_id)
                                <div>
                                    <a href="{{url()->current()}}/edit/{{$club->id}}" class="btn btn-primary mx-1">Edit</a>
                                    <a href="{{url()->current()}}/delete/{{$club->id}}" class="btn btn-danger mx-1">Remove</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
