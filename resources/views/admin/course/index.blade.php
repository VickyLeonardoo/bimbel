@extends('partials.admin.header')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                @if (session('error'))
                    <div class="alert alert-light-danger alert-dismissible show fade">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header text-end">
                        <a href="{{ route('admin.course.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Tambah</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="example" style="width: 100">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama</th>
                                        <th>Tipe</th>
                                        <th>Harga</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ $course->code }}</td>
                                            <td>Rp. {{ $course->price }}</td>
                                            <td>{{ $course->description }}</td>
                                            <td>
                                                <a href="{{route('admin.course.edit',$course->slug)}}" class="btn btn-sm bg-primary text-white">Edit</a>
                                                <a href="{{route('admin.course.delete',$course->id)}}" class="btn btn-sm bg-danger text-white">Delete</a>
                                                <a href="{{route('admin.course.session',$course->slug)}}" class="btn btn-sm bg-success text-white">Session</a>
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