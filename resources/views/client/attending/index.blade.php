@extends('partials.client.header')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                @include('partials.client.sidebar')
            </div>
            <div class="col-md-10">
                <div class="card">
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
                        <form action="{{ route('client.attending.show') }}" method="get">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Nama</label>
                                <select name="child_id" class="form-control {{ $errors->has('child_id') ? 'is-invalid' : '' }}" id="">
                                    <option value="" disabled selected>-- Pilih Nama --</option>
                                    @foreach ($childs as $child)
                                        <option value="{{$child->id}}">{{ $child->name }}</option>
                                    @endforeach
                                </select>
                                @error('child_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Tahun Ajaran</label>
                                <select name="year_id" class="form-control {{ $errors->has('year_id') ? 'is-invalid' : '' }}">
                                    <option value="">-- Pilih Tahun Ajaran --</option>
                                    @foreach ($years as $year)
                                        <option value="{{$year->id}}">{{ $year->name }}</option>
                                    @endforeach
                                </select>
                                @error('year_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Mata Pelajaran</label>
                                <select name="course_id" class="form-control {{ $errors->has('course_id') ? 'is-invalid' : '' }}">
                                    <option value="">-- Pilih Mata Pelajaran --</option>
                                    @foreach ($courses as $course)
                                        <option value="{{$course->id}}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="submit" class="btn btn-primary" value="Periksa">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection