@extends('partials.admin.header')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-header text-end">
                        <a href="{{ route('admin.instructor.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Tambah</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table1" style="width: 100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Course </th>
                                        <th>Pendidikan </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instructors as $instructor)
                                    <tr>
                                        <td>{{ $loop->iteration }} </td>
                                        <td>{{ $instructor->name }}</td>
                                        <td> {{ $instructor->email }} </td>
                                        <td>{{ $instructor->phone }}</td>
                                        <td> 
                                            @foreach ($instructor->courses as $course)
                                            <li>{{$course->name}}</li>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($instructor->educationDetails as $education)
                                            <li>{{ $education->level }}  {{ $education->university }}</li>
                                            @endforeach
                                        </td>
                                        {{-- <td> {{ $instructor->address }} </td> --}}
                                        <td>
                                            <a href="" class="btn btn-sm bg-warning text-white">Detail</a>
                                            <a href="{{ route('admin.instructor.edit', $instructor->slug) }}" class="btn btn-sm bg-primary text-white">EDIT</a>
                                            <a href="{{ route('admin.instructor.delete', $instructor->id) }}" class="btn btn-sm bg-danger text-white">DELETE</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

