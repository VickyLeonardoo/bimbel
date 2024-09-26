@extends('partials.client.header')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                @include('partials.client.sidebar')
            </div>
            <div class="col-md-10">
                <div id="card-container">
                    <div class="card-body">
                        <form action="{{ route('client.update_children',$child->id) }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{$child->name}}" placeholder="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="school">School Name</label>
                                <input type="text" name="school" class="form-control"
                                    value="{{$child->school}}" placeholder="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="bod">Birth of Date</label>
                                <input type="date" name="bod" class="form-control"
                                    value="{{$child->bod}}" placeholder="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="class">Class</label>
                                <input type="text" name="class" class="form-control"
                                    value="{{$child->class}}" placeholder="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ route('client.profile') }}" class="btn btn-danger">Discard</a>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
