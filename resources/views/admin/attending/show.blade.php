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
                            <!-- Dropdown untuk memilih sesi -->
                            <select class="form-select me-2 form-control" id="yearDropdown">
                                <option selected disabled>Select Year</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year->id }}" {{ $year->id == $selected_year ? 'selected' : '' }}>
                                        {{ $year->name }}</option>
                                @endforeach
                            </select>

                            <!-- Dropdown untuk memilih tahun -->
                            <select class="form-select me-2 form-control" id="sessionDropdown">
                                <option disabled selected>Select Session</option>
                                @foreach ($course->sessions as $session)
                                    <option value="{{ $session->id }}"
                                        {{ $session->id == $selected_session ? 'selected' : '' }}>{{ $session->name }}
                                    </option>
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
                        <div class="mb-3">
                            <button class="btn btn-success" onclick="updateStatus('present')">Present</button>
                            <button class="btn btn-danger" onclick="updateStatus('absent')">Absent</button>
                            <button class="btn btn-warning" onclick="updateStatus('late')">Late</button>
                            <button class="btn btn-info" onclick="updateStatus('permission')">Permission</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th style="width: 20%">
                                            <input type="checkbox" id="selectAll" style="transform: scale(1.5);">
                                        </th>
                                        <th style="width: 50%">Name</th>
                                        <th style="width: 10%">Status</th>
                                        <th style="width: 20%">Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendees as $attendee)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="status[]" value="{{ $attendee->id }}"
                                                    class="checkbox-item" style="transform: scale(1.5);">
                                            </td>
                                            <td>{{ $attendee->child->name }}</td>
                                            <td>
                                                @if ($attendee->status == '')
                                                    -
                                                @elseif($attendee->status == 'present')
                                                    <span class="badge bg-success">Present</span>
                                                @elseif($attendee->status == 'late')
                                                    <span class="badge bg-warning">Late</span>
                                                @elseif($attendee->status == 'absent')
                                                    <span class="badge bg-danger">Absent</span>
                                                @else
                                                    <span class="badge bg-info">Permission</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($attendee->reason != '')
                                                    {{ $attendee->reason }}
                                                @else
                                                    -
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
@section('js')
    <script>
        function updateUrl() {
            const selectedYear = document.getElementById('yearDropdown').value;
            const selectedSession = document.getElementById('sessionDropdown').value;
            const selectedClass = document.getElementById('classDropdown').value;
            const url = new URL(window.location.href);

            if (selectedYear) {
                url.searchParams.set('year_id', selectedYear);
            }

            if (selectedSession) {
                url.searchParams.set('session_id', selectedSession);
            }

            if (selectedClass) {
                url.searchParams.set('class', selectedClass);
            }

            window.location.href = url.toString();
        }

        document.getElementById('yearDropdown').addEventListener('change', updateUrl);
        document.getElementById('sessionDropdown').addEventListener('change', updateUrl);
        document.getElementById('classDropdown').addEventListener('change', updateUrl);

        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.checkbox-item');
            const isChecked = this.checked;

            checkboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
        });

        function updateStatus(status) {
            if (status === 'permission') {
                Swal.fire({
                    title: 'Request Permission',
                    input: 'textarea',
                    inputLabel: 'Reason for Permission',
                    inputPlaceholder: 'Enter your reason here...',
                    inputAttributes: {
                        'aria-label': 'Enter your reason here'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    cancelButtonText: 'Cancel',
                    preConfirm: (reason) => {
                        if (!reason) {
                            Swal.showValidationMessage('Please enter a reason.');
                        }
                        return reason;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        submitStatusUpdate(status, result.value);
                    }
                });
            } else {
                submitStatusUpdate(status);
            }
        }

        function submitStatusUpdate(status, reason = '') {
            const checkboxes = document.querySelectorAll('.checkbox-item:checked');
            const ids = Array.from(checkboxes).map(cb => cb.value);

            if (ids.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Attendee Selected',
                    text: 'Please select at least one attendee.',
                });
                return;
            }

            fetch('{{ route('admin.attending.update.status') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        ids,
                        status,
                        reason
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Status Updated',
                            text: 'The status has been successfully updated.',
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Update Failed',
                            text: 'Failed to update status.',
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred. Please try again.',
                    });
                });
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            const successMessage = '{{ session('success') }}';
            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: successMessage,
                });
            }
        });
    </script>
@endsection
