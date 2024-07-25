@extends('partials.client.header')
@section('content')
<div class="container ">
    <div class="row">
        <div class="col-md-2">
            <div class="box mb-5">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('client.profile') }}"
                            class=" btn form-control btn-outline-primary mb-3">Profile</a>
                        <a href="{{ route('client.transaction') }}"
                            class=" btn form-control btn-outline-primary {{ Route::is('client.transaction*') ? 'active' : '' }}">Transaction</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card mb-5">
                <div class="card-header text-end">
                    <a href="{{ route('client.transaction') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            @if (!$order->payment_image)
                                <span class="badge bg-danger">You haven't uploaded a payment proof yet.</span>
                            @else
                                <span class="badge bg-success">Payment Proof Uploaded</span>
                            @endif
                            <br>
                            <br>
                            <form action="{{ route('client.transaction.upload', $order->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="file">Upload Payment Proof</label>
                                    <input type="file" name="payment_image" id="file" class="form-control" {{ $order->status == 'payment_received' ? 'disabled' : '' }}>
                                    @error('payment_image')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                @if ($order->status == 'payment_received')
                                    <div class="form-group mb-3">
                                        <button type="submit" class="btn bg-primary text-white" disabled>Upload</button>
                                    </div>
                                @else
                                    <div class="form-group mb-3">
                                        <button type="submit" class="btn bg-primary text-white">Upload</button>
                                    </div>
                                @endif
                            </form>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    @if ($order->payment_image)
                                    <img src="{{ asset('storage/transaction/' . $order->payment_image) }}" class="img-fluid">
                                @else
                                    <img src="{{ asset('assets/err.png') }}" alt="Not Found" class="img-fluid">
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection