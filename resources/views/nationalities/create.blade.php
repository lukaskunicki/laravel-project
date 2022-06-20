@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Add a new Nationality
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/nationalities/add">
                            @csrf
                            <div class="form-group p-2">
                                <label for="name">Name</label>
                                <input required type="text" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                            <button type="submit" class="btn btn-primary m-3 px-5">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
