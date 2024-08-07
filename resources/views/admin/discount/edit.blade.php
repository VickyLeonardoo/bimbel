@extends('partials.admin.header')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.discount.update',$discount->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $discount->name }}" name="name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Discount Code</label>
                                <input type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" value="{{ $discount->code }}" name="code">
                                @error('code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Amount</label>
                                <input type="number" class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" value="{{ $discount->total }}" name="total">
                                @error('total')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Type</label>
                                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type">
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="percent" {{ $discount->type == 'percent' ? 'selected' : '' }}>Percent</option>
                                    <option value="value" {{ $discount->type == 'value' ? 'selected' : '' }}>Value</option>
                                </select>
                                @error('type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Date Valid</label>
                                <input type="date" class="form-control {{ $errors->has('date_valid') ? 'is-invalid' : '' }}" value="{{ $discount->date_valid }}" name="date_valid">
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
