@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit {{$position->name}} position
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/positions/update/{{$position->id}}" class="validate-form">
                            @csrf
                            <div class="form-group p-2">
                                <label for="name">Name</label>
                                <input required type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$position->name}}">
                                <span />
                            </div>
                            <div class="form-group p-2">
                                <label for="name">Short name</label>
                                <input required type="text" class="form-control" id="name" name="short_name" placeholder="Name" value="{{$position->short_name}}">
                                <span />
                            </div>
                            <button type="submit" class="btn btn-primary m-3 px-5">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
