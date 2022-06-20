@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit {{$league->name}} league
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/leagues/update/{{$league->id}}" class="validate-form">
                            @csrf
                            <div class="form-group p-2">
                                <label for="name">Name</label>
                                <span />
                                <input required type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$league->name}}">
                            </div>
                            <div class="form-group p-2">
                                <label for="start_date">Start date</label>
                                <input required type="date" class="form-control" id="start_date" name="start_date" value="{{$league->start_date}}">
                            </div>
                            <div class="form-group p-2">
                                <label for="end_date">End date</label>
                                <input required type="date" class="form-control" id="end_date" name="end_date" value="{{$league->end_date}}">
                            </div>
                            <button type="submit" class="btn btn-primary m-3 px-5">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
