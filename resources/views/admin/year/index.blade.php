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
                        <a href="{{ route('admin.year.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Tambah</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="example" style="width: 100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Reg Start Date</th>
                                        <th>Reg End Date</th>
                                        <th>Status</th>
                                        <th>Publish</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($years as $year)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $year->name }}</td>
                                            <td>{{ Carbon\Carbon::parse($year->start_date)->format('d/M/Y') }}</td>
                                            <td>{{ Carbon\Carbon::parse($year->end_date)->format('d/M/Y') }}</td>
                                            <td>
                                                @if ($year->status == 'active')
                                                    <a href="{{route('admin.year.update.status',$year->id)}}" class="badge badge-sm bg-success">Active</a>
                                                @else
                                                    <a href="{{route('admin.year.update.status',$year->id)}}" class="badge badge-sm bg-danger">Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($year->is_published == true)
                                                    <a href="{{route('admin.year.update.publish',$year->id)}}" class="badge badge-sm bg-success">Yes</a>
                                                @else
                                                    <a href="{{route('admin.year.update.publish',$year->id)}}" class="badge badge-sm bg-danger">No</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('admin.year.edit',$year->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="{{route('admin.year.delete',$year->id)}}" class="btn btn-sm btn-danger">Delete</a>
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

