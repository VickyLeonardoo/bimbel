@extends('partials.instructor.header')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input type="text" class="form-control" value="{{ $user->email }}" readonly name="email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Phone</label>
                            <input type="text" class="form-control" value="{{ $user->phone }}" name="phone">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Address</label>
                            <input type="text" class="form-control" value="{{ $user->address }}" name="address">
                        </div>
                        <div class="form-group mb">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection