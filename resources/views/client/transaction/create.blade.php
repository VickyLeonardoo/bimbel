@extends('partials.client.header')
@section('content')
<div class="container" >
    <div class="row">
        <div class="col-md-2">
            <div class="box mb-5">
                <div class="card">
                    <div class="card-body">

                        <a href="{{route('client.profile')}}" class=" btn form-control btn-outline-primary mb-3">Profile</a>
                        <a href="{{route('client.transaction')}}" class=" btn form-control btn-outline-primary {{Route::is('client.transaction*') ? 'active':''}}">Transaction</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        @csrf
                        <div class="form-group">
                            <label for="">Years</label>
                            <select name="course_id" class="form-control">
                                <option value="" selected disabled>Select Years</option>
                                @foreach ($years as $y)
                                    <option value="{{$y->id}}">{{$y->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <select name="child_id" class="form-control">
                                <option value="" selected disabled>Select Child</option>
                                @foreach (auth()->user()->child as $child)
                                    <option value="{{$child->id}}">{{$child->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Course</label>
                            <select name="course_id" class="form-control">
                                <option value="" selected disabled>Select Course</option>
                                @foreach ($course as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection