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
                            <!-- <div class="col-md-4 mt-3"> -->
                            <!-- </div> -->
                        </div>
                        <h3>Transaction List</h3>
                        <a href="{{ route('client.transaction.create') }}" class="btn btn-sm btn-primary">Add Transaction</a>
                        <div class="table-responsive">
                            <table class="table table-striped mt-3" id="table1">
                                <thead>
                                    <tr">
                                        <th style="background-color: #111d5e;" class="text-white">No</th>
                                        <th style="background-color: #111d5e;" class="text-white">Reg No</th>
                                        <th style="background-color: #111d5e;" class="text-white">Course Name</th>
                                        <th style="background-color: #111d5e;" class="text-white">Amount</th>
                                        <th style="background-color: #111d5e;" class="text-white">Status</th>
                                        <th style="background-color: #111d5e;" class="text-white">More Details</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @forelse (auth()->user()->order as $order)
                                        <tr>
                                            <td style="vertical-align: middle">{{ $loop->iteration }}</td>
                                            <td style="vertical-align: middle">{{ $order->reg_no }}</td>
                                            <td style="vertical-align: middle">
                                                @php
                                                    $uniqueCourses = [];
                                                @endphp
                                                @foreach ($order->course as $item)
                                                    @if (!in_array($item->name, $uniqueCourses))
                                                        @php
                                                            $uniqueCourses[] = $item->name;
                                                        @endphp
                                                        <li>{{ $item->name }}</li>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td style="vertical-align: middle">@currency($order->total)</td>
                                            <td style="vertical-align: middle">
                                                @if ($order->status == 'draft')
                                                    <span class="badge bg-warning">Draft</span>
                                                @elseif ($order->status == 'confirmed')
                                                    <span class="badge bg-primary">Pending</span>

                                                @elseif ($order->status == 'payment_received')
                                                    <span class="badge bg-success">Payment Receive</span>
                                                @else
                                                    <span class="badge bg-danger">Cancelled</span>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle">
                                                <a href="{{ route('client.transaction.show', $order->id) }}" class="btn btn-sm btn-primary">Details</a>
                                                @if ($order->status != 'cancelled')
                                                    <a href="{{ route('client.transaction.upload', $order->id) }}" class="btn btn-sm btn-success">Upload Payment</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Transaction Data Found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection