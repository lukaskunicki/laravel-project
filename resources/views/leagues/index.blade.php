@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($leagues as $league)
                <div class="col-md-4 my-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ $league->name }}</h3>
                            <div class="card-text pt-3">
                                <p>
                                    <strong>Starting date: </strong>
                                    {{ $league->start_date }}
                                </p>
                                <p>
                                    <strong>Ending date: </strong>
                                    {{ $league->end_date }}
                                </p>
                                <p>
                                    <strong>Clubs in league: </strong>
                                    {{ count($league->clubs->pluck('id')->toArray()) }}
                                </p>
                            </div>
                            <div>
                                <a href="/leagues/clubs/{{$league->id}}" class="btn btn-success mx-1">Show clubs</a>
                                @if (Auth::user() && Auth::user()->is_admin)
                                    <a href="{{url()->current()}}/remove/{{$league->id}}"
                                       class="btn btn-primary mx-1">Edit</a>
                                    <a href="{{url()->current()}}/delete/{{$league->id}}" class="btn btn-danger mx-1">Remove</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
