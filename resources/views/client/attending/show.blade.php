@extends('partials.client.header')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                @include('partials.client.sidebar')
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-end">
                        <a href="{{ route('client.attending') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                            Back</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible show fade">
                                {{ session('success') }}.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="row mb-3">
                            <img src="{{ asset('pendaftar') }}/assets/img/profile-bg.png" alt="">
                        </div>
                        <h3></h3>
                        <div class="table-responsive">
                            <table id="report" class="table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th style="width: 20%">Name</th>
                                        @foreach ($sessions as $session)
                                            <th>{{ $session->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($childs as $child)
                                        <tr>
                                            <td>{{ $child->child->name }}</td>
                                            @foreach ($sessions as $session)
                                                @php
                                                    $attendance = $attendances->get($child->child_id)->get($session->id) ?? null;
                                                @endphp
                                                @if ($attendance)
                                                    @if ($attendance->status == 'present')
                                                        <td><span class="text-present">Present</span></td> 
                                                    @elseif ($attendance->status == 'absent')
                                                        <td style="background-color: #ff5252"><span class="text-absent">X</span></td>
                                                    @elseif ($attendance->status == 'late')
                                                        <td><span class="text-late">Late</span></td>
                                                    @elseif ($attendance->status == 'permission')
                                                        <td><span class="text-permission">Permission</span></td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                @else
                                                    <td>-</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>No Data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <h4>Keterangan</h4>
                            <div class="row text-center">
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-2">
                                    <span class="badge bg-info">Not Start: {{ $notStartedCount }}</span>
                                </div>
                                <div class="col-sm-2">
                                    <span class="badge bg-success">Present: {{ $presentCount }}</span>
                                </div>
                                <div class="col-sm-2">
                                    <span class="badge bg-danger">Absent: {{ $absentCount }}</span>
                                </div>
                                <div class="col-sm-2">
                                    <span class="badge bg-warning">Late: {{ $lateCount }}</span>
                                </div>
                                <div class="col-sm-2">
                                    <span class="badge bg-primary">Permission: {{ $permissionCount }}</span>
                                </div>
                                <div class="col-sm-1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection