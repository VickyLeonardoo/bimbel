@extends('partials.admin.header')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4">
                                Course Name
                                <strong>
                                    <h3>{{ $course->name }}</h3>
                                </strong>
                            </div>
                            <div class="col-lg-4">
                                Total Participant
                                <strong>
                                    <h3>{{ $participant }}</h3>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group position-relative has-icon-left">
                                    <select name="year" class="form-control">
                                        @foreach ($years as $year)
                                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-control-icon">
                                        <i class="bi bi-calendar3"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group position-relative has-icon-left">
                                    <input type="submit" value="Search" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                        <h6>Attendee</h6>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width: 100">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">No</th>
                                        <th style="width: 60%">Name</th>
                                        <th style="width: 30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($enrollments as $enr)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $enr->child->name }}</td>
                                            <td>
                                                @if ($enr->status == 'approved')
                                                    <a href="{{ route('admin.enrollment.update.status', $enr->id) }}" class="badge bg-success">Approved</a>
                                                @else
                                                    <a href="{{ route('admin.enrollment.update.status', $enr->id) }}" class="badge bg-danger">Cancelled</a>
                                                @endif
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
