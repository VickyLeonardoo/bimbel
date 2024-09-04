@extends('partials.instructor.header')
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
                            <!-- Dropdown untuk memilih sesi -->
                            <select class="form-select me-2 form-control" id="yearDropdown">
                                <option selected disabled>Select Year</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year->id }}" {{ $year->id == $selected_year ? 'selected' : '' }}>
                                        {{ $year->name }}</option>
                                @endforeach
                            </select>

                            <select class="form-select me-2 form-control" id="classDropdown">
                                <option disabled selected>Select Class</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class }}"
                                       {{ $class == $selected_class ? 'selected' : '' }} >{{ $class }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
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
                                    @foreach ($childs as $child)
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
@section('js')
    <script>
        function updateUrl() {
            const selectedYear = document.getElementById('yearDropdown').value;
            const selectedClass = document.getElementById('classDropdown').value;
            const url = new URL(window.location.href);

            if (selectedYear) {
                url.searchParams.set('year_id', selectedYear);
            }

            if (selectedClass) {
                url.searchParams.set('class', selectedClass);
            }

            window.location.href = url.toString();
        }

        document.getElementById('yearDropdown').addEventListener('change', updateUrl);
        document.getElementById('classDropdown').addEventListener('change', updateUrl);
    </script>
@endsection
