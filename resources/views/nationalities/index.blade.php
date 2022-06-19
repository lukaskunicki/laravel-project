@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($nationalities as $nation)
                <div class="col-md-4 my-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ $nation->name }}</h3>
                            <div class="card-text pt-3">
                                <p>
                                    <strong>Players with nationality: </strong>
                                    {{ count($nation->players->pluck('id')->toArray()) }}
                                </p>
                            </div>
                            <div>
                                <a href="/nationalities/players/{{$nation->id}}" class="btn btn-success mx-1">Show players</a>
                                @if (Auth::user() && Auth::user()->is_admin)
                                    <a href="/nationalities/edit/{{$nation->id}}"
                                       class="btn btn-primary mx-1">Edit</a>
                                    <a href="/nationalities/remove/{{$nation->id}}" class="btn btn-danger mx-1">Remove</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
