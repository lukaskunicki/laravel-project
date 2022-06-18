@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit {{ $player->name }} {{ $player->lastname }}
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-row d-flex justify-content-between">
                                <div class="form-group col-md-6 p-2">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name"
                                           value="{{$player->name}}">
                                </div>
                                <div class="form-group col-md-6 p-2">
                                    <label for="name">Lastname</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name"
                                           value="{{$player->lastname}}">
                                </div>
                            </div>
                            <div class="form-group p-2">
                                <label for="height">Height</label>
                                <input type="number" min="150" max="220" class="form-control" id="height"
                                       value="{{$player->height}}">
                            </div>
                            <div class="form-group p-2">
                                <label for="weight">Weight</label>
                                <input type="number" min="50" max="130" class="form-control" id="weight"
                                       value="{{$player->weight}}">
                            </div>
                            <div class="form-group p-2">
                                <label for="birth-date">Birth date</label>
                                <input type="date" class="form-control" id="birth-date" value="{{$player->born_date}}">
                            </div>
                            <div class="form-group p-2">
                                <label for="nationality">Nation</label>
                                <select id="nationality" class="form-control">
                                    @foreach($nationalities as $nation)
                                        <option @if ($nation->name === $player->nationality->name) selected @endif >{{$nation->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group p-2">
                                <label for="club">Club</label>
                                <select id="club" class="form-control">
                                    @foreach($clubs as $club)
                                        <option>{{$club->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group p-2">
                                <h5>Positions</h5>
                                @foreach($positions as $pos)
                                    <div class="form-check">
                                        <input class="form-check-input" @if (in_array($pos->name, $player->positions->pluck('name')->toArray())) checked @endif type="checkbox" value="{{$pos->id}}" id="{{$pos->name}}">
                                        <label class="form-check-label" for="{{$pos->name}}">
                                            {{$pos->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary m-3 px-5">Edit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
