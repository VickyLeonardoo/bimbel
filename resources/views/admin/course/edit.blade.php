@extends('partials.admin.header')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-header text-end">
                        <a href="{{ route('admin.course') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                    <form action="{{ route('admin.course.update', $course->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $course->name }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Code</label>
                            <input type="text" class="form-control" name="code" value="{{ $course->code }}">
                            @error('code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="number" class="form-control" name="price" value="{{ $course->price }}">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control" name="description" rows="3">{{ $course->description }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Image</label> <br>
                            <input type="file" class="form-control-file form-control" name="image">
                            @if ($course->image)
                                <img src="{{ asset('storage/course/' . $course->image) }}" width="100" alt="">
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
