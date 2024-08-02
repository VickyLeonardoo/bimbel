@extends('partials.admin.header')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-md-8">
                    @if (session('error'))
                        <div class="alert alert-light-danger alert-dismissible show fade">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card mb-5">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                @if ($order->status == 'confirmed')
                                    <a href="{{ route('admin.transaction.set.payment.receive', $order->id) }}"
                                        class="btn btn-outline-success">Payment Received</a>
                                @endif
                                @if (in_array($order->status, ['draft', 'confirmed']))
                                    <a href="{{ route('admin.transaction.set.cancel', $order->id) }}"
                                        class="btn btn-outline-danger">Cancel</a>
                                @endif
                            </div>
                            @if ($order->is_active == true)
                            <a href="{{ route('admin.transaction.set.archive', $order->id) }}" class="btn btn-primary ms-auto"><i class="fa-solid fa-box-archive"></i>Archive</a>
                            @else
                            <a href="{{ route('admin.transaction.set.archive', $order->id) }}" class="btn btn-primary ms-auto"><i class="fa-solid fa-box-archive"></i>Unarchive</a>
                                
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="media">
                                        <div class="media-body m-l-20">
                                            <h4 class="media-heading">Bimbel BUC TEVA</h4>
                                            <p> hello@universal.in<br>
                                                <span class="digits">289-335-6503</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="text-end">
                                        <h3><span class="digits counter">{{ $order->reg_no }}</span></h3>
                                        <p>Issued: <span class="digits">
                                                {{ Carbon\Carbon::parse($order->date_order)->format('d/M/Y') }} </span><br>
                                        </p>
                                    </div><!--End Title-->
                                </div>
                            </div>
                            <hr />
                            <!--End InvoiceTop-->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">Johan Deo</h4>
                                            <p>JohanDeo@gmail.com<br>
                                                <span class="digits">555-555-5555</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div id="project" class="text-md-right">
                                        {{-- <h6>Project Description</h6> --}}
                                        {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                @if ($order->status == 'draft')
                                    <span class="badge bg-warning">Draft</span>
                                @elseif ($order->status == 'confirmed')
                                    <span class="badge bg-primary">Pending</span>
                                @elseif ($order->status == 'payment_received')
                                    <span class="badge bg-success">Payment Receive</span>
                                @else
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </div>
                            <div>
                                <div id="table" class="table-responsive invoice-table">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <td class="item">
                                                    <h6 class="p-2 mb-0">Participant</h6>
                                                </td>
                                                <td class="item">
                                                    <h6 class="p-2 mb-0">Course Name</h6>
                                                </td>
                                                <td class="Hours">
                                                    <h6 class="p-2 mb-0">Quantity</h6>
                                                </td>
                                                <td class="Rate">
                                                    <h6 class="p-2 mb-0">Price</h6>
                                                </td>
                                                <td class="Rate">
                                                    <h6 class="p-2 mb-0">Sub-Total</h6>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($order->unique_child as $child)
                                                @php
                                                    $firstCourse = true;
                                                @endphp
                                                @foreach ($order->unique_courses as $course)
                                                    <tr>
                                                        @if ($firstCourse)
                                                            <td rowspan="{{ count($order->unique_courses) }}">
                                                                {{ $child->name }}</td>
                                                            @php
                                                                $firstCourse = false;
                                                            @endphp
                                                        @endif
                                                        <td>{{ $course->name }}</td>
                                                        <td>{{ 1 }}</td>
                                                        <!-- Assuming quantity is 1 for each course per child -->
                                                        <td>@currency($course->price)</td>
                                                        @php
                                                            $subtotal = $course->price * 1;
                                                            $total += $subtotal;
                                                        @endphp
                                                        <td>@currency($subtotal)</td> <!-- Sub-total = price * quantity -->
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="Rate">
                                                    <h6 class="mb-0 p-2">Total</h6>
                                                </td>
                                                <td class="payment digits">
                                                    <h6 class="mb-0 p-2">@currency($total)</h6>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!--End Table-->
                                {{-- <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <p class="legal">Silahkan transfer ke rekening <strong>Mandiri: 1090020804423. AN Bimbel BUC TEVA.</strong>
                                        </p>
                                    </div>
                                </div>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Payment Receipt</h4>
                            <hr>
                        </div>
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
    </section>
@endsection
