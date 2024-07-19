@extends('partials.client.header')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="box mb-5">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('client.profile') }}"
                                class=" btn form-control btn-outline-primary mb-3 {{ Route::is('client.*') ? 'active' : '' }}">Profile</a>
                            <a href="#" class=" btn form-control btn-outline-primary">Transaksi</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible show fade">
                                Profile update successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="row mb-3">
                            <img src="{{ asset('pendaftar') }}/assets/img/profile-bg.png" alt="">
                        </div>
                        <h5 style="font-weight: 200; color: #6d6d6d;">Personal Information</h5>
                        <form action="{{ route('client.update_profile') }}" method="POST">
                            @csrf
                            <div class="text-end">
                                <button class="btn btn-sm btn-primary">Update</button>
                                <a href="{{ route('client.profile') }}" class="btn btn-sm btn-danger"><i
                                        class="fas fa-trash"></i>Discard</a>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 mt-3">
                                    <label for="">Nama</label>
                                    <input type="text" name="name"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        value="{{ auth()->user()->name }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" name="email"
                                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" disabled
                                        value="{{ auth()->user()->email }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Phone</label>
                                    <input type="text" name="phone"
                                        class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                        value="{{ auth()->user()->phone }}">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address</label>
                                    <textarea name="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" cols="3"> {{ auth()->user()->address }} </textarea>
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
