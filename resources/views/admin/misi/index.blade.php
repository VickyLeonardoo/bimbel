@extends('partials.admin.header')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-header text-end">
                        <a href="{{ route('admin.misi.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Tambah</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table1" style="width: 100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($missions as $misi)
                                    <tr>
                                        <td>{{ $loop->iteration }} </td>
                                        <td>{{ $misi->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.instructor.edit', $misi->id) }}" class="btn btn-sm bg-primary text-white">EDIT</a>
                                            <a href="{{ route('admin.instructor.delete', $misi->id) }}" class="btn btn-sm bg-danger text-white">DELETE</a>
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

