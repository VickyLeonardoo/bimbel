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
                        <a href="{{ route('admin.discount.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Tambah</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="example" style="width: 100">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Valid Date</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($discounts as $discount)
                                        <tr>
                                            <td>{{ $discount->name }}</td>
                                            <td>{{ $discount->code }}</td>
                                            <td>{{ Carbon\Carbon::parse($discount->date_valid)->format('d F Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.discount.update.status', $discount->id) }}" class="badge {{ $discount->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $discount->status ? 'Active' : 'Inactive' }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.discount.edit', $discount->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin.discount.delete', $discount->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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

