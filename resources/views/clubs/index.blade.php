@extends('layouts.app')

@section('content')
    <div class="container" id="search-container">
        <div class="row">
            <div class="col-sm-3 d-flex justify-content-between mt-2 mb-4">
                <div class="form-outline">
                    <label class="form-label" for="search">Search</label>
                    <input type="search" class="form-control" data-endpoint="/clubs/search/"/>
                </div>
                <div class="d-flex align-items-end">
                    <button type="button" class="btn btn-primary">
                        Find
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row justify-content-center" id="search-results" data-template="club">
            @foreach($clubs as $club)
                <div class="col-md-4 my-3">
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
                                </p>
                                <p>
                                    <strong>Trainer contact: </strong>
                                    <a href="mailto:{{ $club->trainer->email }}">{{ $club->trainer->email }}</a>
                                </p>
                            </div>
                            <div>
                                <a href="/players/club/{{$club->id}}" class="btn btn-success mx-1">Show players</a>
                                @if (Auth::user() && Auth::user()->id === $club->trainer_id)
                                    <a href="/clubs/edit/{{$club->id}}"
                                       class="btn btn-primary mx-1">Edit</a>
                                    <a href="/clubs/delete/{{$club->id}}" class="btn btn-danger mx-1">Remove</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
