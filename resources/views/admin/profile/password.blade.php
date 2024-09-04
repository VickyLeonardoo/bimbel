@extends('partials.admin.header')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                
                    <form action="{{ route('admin.profile.update.password') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Old Password</label>
                            <input type="password" class="form-control" value="" name="old_password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">New Password</label>
                            <input type="password" class="form-control" value="" name="new_password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Confirm New Password</label>
                            <input type="password" class="form-control" value="" name="confirm_password">
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