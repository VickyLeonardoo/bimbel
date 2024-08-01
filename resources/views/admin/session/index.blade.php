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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <select class="form-select me-2 form-control" id="yearDropdown">
                                <option selected disabled>Select Year</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year->id }}" {{ $year->id == $selected_year ? 'selected' : '' }}>{{ $year->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-secondary me-5" id="searchButton"><i class="fas fa-search"></i></button>
                        </div>
                        <a href="{{ route('admin.course.get.session', $course->slug) }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Get Session</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" style="width: 100">
                                <thead>
                                    <tr>
                                        <th style="width: 20%">Nomor</th>
                                        <th style="width: 60%">Name</th>
                                        <th style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($course->sessions as $sesion)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sesion->name }}</td>
                                            <td>
                                                <button class="badge bg-primary">Info</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr style="text-align: center">
                                            <td colspan="3">No Data Session Found</td></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('js')
<script>
    document.getElementById('searchButton').addEventListener('click', function() {
        const selectedYear = document.getElementById('yearDropdown').value;
        if (selectedYear) {
            const url = new URL(window.location.href);
            url.searchParams.set('year_id', selectedYear);
            window.location.href = url.toString();
        } else {
            alert('Please select a year.');
        }
    });
</script>
@endsection