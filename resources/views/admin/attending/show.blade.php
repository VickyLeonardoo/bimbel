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
                                    <option value="{{ $year->id }}" {{ $year->id == $selected_year ? 'selected' : '' }}>{{ $year->name }}</option>
                                @endforeach
                            </select>
                            
                            <!-- Dropdown untuk memilih tahun -->
                            <select class="form-select me-2 form-control" id="sessionDropdown">
                                <option disabled>Select Session</option>
                                @foreach ($course->sessions as $session)
                                    <option value="{{ $session->id }}" {{ $session->id == $selected_session ? 'selected' : '' }}>{{ $session->name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
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
        const url = new URL(window.location.href);
        
        if (selectedYear) {
            url.searchParams.set('year_id', selectedYear);
        }
        
        if (selectedSession) {
            url.searchParams.set('session_id', selectedSession);
        }
        
        window.location.href = url.toString();
    }

    document.getElementById('yearDropdown').addEventListener('change', updateUrl);
    document.getElementById('sessionDropdown').addEventListener('change', updateUrl);
</script>
@endsection