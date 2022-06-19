@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit {{ $club->name }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/clubs/update/{{$club->id}}">
                            @csrf
                            <div class="form-group p-2">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$club->name}}">
                            </div>
                            <div class="form-group p-2">
                                <label for="foundation_date">Foundation date</label>
                                <input type="date" class="form-control" id="foundation_date" name="foundation_date" value="{{$club->foundation_date}}">
                            </div>
                            <div class="form-group p-2">
                                <label for="league">League</label>
                                <select id="league" class="form-control" name="league_id">
                                    @foreach($leagues as $league)
                                        <option @if ($league->id === $club->league->id) selected @endif value="{{$league->id}}">{{$league->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary m-3 px-5">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
