@extends('partials.admin.header')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-header text-end">
                        <a href="{{ route('admin.instructor') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                    <form action="{{ route('admin.instructor.update', $instructor->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $instructor->name }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $instructor->email }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $instructor->phone }}">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea class="form-control" name="address" rows="3">{{ $instructor->address }}</textarea>
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select class="form-control" name="gender">
                                <option value="m" {{$instructor->gender == 'm' ? 'selected' : ''}}>Male</option>
                                <option value="f" {{$instructor->gender == 'f' ? 'selected' : ''}}>Female</option>
                            </select>
                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Image</label> <br>
                            <input type="file" class="form-control-file form-control" name="image">
                            @if ($instructor->image)
                                <img src="{{ asset('storage/instructor/' . $instructor->image) }}" width="100" alt="">
                            @endif
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>


                </div>
            </div>
        </div>
        </div>

    </section>
@endsection
