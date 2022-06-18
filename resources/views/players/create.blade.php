@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Add a new Player
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/players/add">
                            @csrf
                            <div class="form-row d-flex justify-content-between">
                                <div class="form-group col-md-6 p-2">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                </div>
                                <div class="form-group col-md-6 p-2">
                                    <label for="name">Lastname</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name"
                                           name="lastname">
                                </div>
                            </div>
                            <div class="form-group p-2">
                                <label for="height">Height</label>
                                <input type="number" min="150" max="220" class="form-control" id="height" name="height">
                            </div>
                            <div class="form-group p-2">
                                <label for="weight">Weight</label>
                                <input type="number" min="50" max="130" class="form-control" id="weight" name="weight">
                            </div>
                            <div class="form-group p-2">
                                <label for="birth-date">Birth date</label>
                                <input type="date" class="form-control" id="birth-date" name="born_date">
                            </div>
                            <div class="form-group p-2">
                                <label for="nationality">Nation</label>
                                <select id="nationality" class="form-control" name="nationality_id">
                                    @foreach($nationalities as $nation)
                                        <option value="{{$nation->id}}">{{$nation->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group p-2">
                                <label for="club">Club</label>
                                <select id="club" class="form-control" name="club_id">
                                    @foreach($clubs as $club)
                                        <option value="{{$club->id}}">{{$club->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group p-2">
                                <h5>Positions</h5>
                                @foreach($positions as $pos)
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox" name="position_id_{{$pos->id}}" id="{{$pos->name}}"
                                               value="{{$pos->id}}">
                                        <label class="form-check-label" for="{{$pos->name}}">
                                            {{$pos->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary m-3 px-5">Create</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
