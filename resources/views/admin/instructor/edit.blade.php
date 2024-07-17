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
                                <option value="m" {{ $instructor->gender == 'm' ? 'selected' : '' }}>Male</option>
                                <option value="f" {{ $instructor->gender == 'f' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Image</label> <br>
                            <input type="file" class="form-control-file form-control" name="image">
                            @if ($instructor->image)
                                <img src="{{ asset('storage/instructor/' . $instructor->image) }}" width="100"
                                    alt="">
                            @endif
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>Education</h5>
                            <div>
                                <button class="btn btn-sm bg-primary text-white">Add</button>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Level</th>
                                        <th>Degree</th>
                                        <th>Univeristy</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($instructor->educationDetails as $education)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $education->level }}</td>
                                        <td>{{ $education->degree }}</td>
                                        <td>{{ $education->university }}</td>
                                        <td>
                                            <button class="btn btn-sm bg-info text-white">Edit</button>
                                            <button class="btn btn-sm bg-danger text-white">Delete</button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No Data Found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <h5>Course</h5>
                            <div>
                                <button class="btn btn-sm bg-primary text-white">Add</button>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Course</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($instructor->courses as $course)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $course->name }}</td>
                                        <td>
                                            <button class="btn btn-sm bg-info text-white">Edit</button>
                                            <button class="btn btn-sm bg-danger text-white">Delete</button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No Data Found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        </div>

    </section>
@endsection
