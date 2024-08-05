@extends('partials.admin.header')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.discount.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Discount Code</label>
                                <input type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" name="code">
                                @error('code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Amount</label>
                                <input type="number" class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" name="total">
                                @error('total')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Type</label>
                                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type">
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="percent">Percent</option>
                                    <option value="value">Value</option>
                                </select>
                                @error('type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Date Valid</label>
                                <input type="date" class="form-control {{ $errors->has('date_valid') ? 'is-invalid' : '' }}" name="date_valid">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
