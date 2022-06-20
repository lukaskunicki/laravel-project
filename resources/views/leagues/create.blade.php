@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Add a new League
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/leagues/add">
                            @csrf
                            <div class="form-group p-2">
                                <label for="name">Name</label>
                                <input required type="text" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="form-group p-2">
                                <label for="start_date">Start date</label>
                                <input required type="date" class="form-control" id="start_date" name="start_date">
                            </div>
                            <div class="form-group p-2">
                                <label for="end_date">End date</label>
                                <input required type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                            <button type="submit" class="btn btn-primary m-3 px-5">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
