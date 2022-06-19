@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($positions as $pos)
                <div class="col-md-4 my-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ $pos->name }}</h3>
                            <div class="card-text pt-3">
                                <p>
                                    <strong>Short name: </strong>
                                    {{ $pos->short_name }}
                                </p>
                                <p>
                                    <strong>Players with position: </strong>
                                    {{ count($pos->players->pluck('id')->toArray()) }}
                                </p>
                            </div>
                            <div>
                                <a href="/positions/players/{{$pos->id}}" class="btn btn-success mx-1">Show players</a>
                                @if (Auth::user() && Auth::user()->is_admin)
                                    <a href="{{url()->current()}}/edit/{{$pos->id}}"
                                       class="btn btn-primary mx-1">Edit</a>
                                    <a href="{{url()->current()}}/remove/{{$pos->id}}" class="btn btn-danger mx-1">Remove</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
