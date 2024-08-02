@extends('partials.client.header')
@section('content')
    <div class="container">
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
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('client.transaction.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Years</label>
                                <select name="course_year" class="form-control">
                                    @foreach ($years as $y)
                                        <option value="{{ $y->id }}">{{ $y->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <select name="child_id[]" id="child-select" class="child form-control" multiple>
                                    @foreach (auth()->user()->child as $child)
                                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Course</label>
                                <select name="course_id[]" id="course-select" class="child form-control">
                                    @foreach ($course as $c)
                                        <option value="{{ $c->id }}" data-price="{{ $c->price }}">
                                            {{ $c->name }} (@currency($c->price))</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Discount Code</label>
                                <input type="text" name="discount_code" id="discount_code" class="form-control">
                                <small id="discount_message" class="text-success"></small>
                                <small id="discount_error" class="text-danger"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Total</label>
                                <input type="text" name="total" id="total" class="form-control" value=""
                                    readonly>
                            </div>
                            <div class="form-group mb-3">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#child-select').select2({
                placeholder: "Select Children",
                allowClear: true,
                multiple: true,
            });

            $('#course-select').select2({
                placeholder: "Select Courses",
                allowClear: true,
                multiple: true,
            });

            const courseSelect = document.getElementById('course-select');
            const childSelect = document.getElementById('child-select');
            const totalInput = document.getElementById('total');
            const discountCodeInput = document.getElementById('discount_code');
            const discountMessage = document.getElementById('discount_message');
            const discountError = document.getElementById('discount_error');

            async function checkDiscountCode(code, total) {
                const response = await fetch('{{ route('check.discount') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        code
                    })
                });

                const data = await response.json();
                if (data.status === 'valid') {
                    const discount = data.discount;
                    let discountAmount = 0;
                    if (discount.type === 'percent') {
                        discountAmount = total * discount.total / 100;
                        total -= discountAmount;
                    } else if (discount.type === 'value') {
                        discountAmount = discount.total;
                        total -= discountAmount;
                    }
                    discountMessage.textContent = `Discount found, you get a discount of ${discountAmount}`;
                    return total;
                } else {
                    discountError.textContent = 'Invalid discount code';
                    return total;
                }
            }

            function calculateTotal() {
                discountError.textContent = ''; // Clear any previous error message
                discountMessage.textContent = ''; // Clear any previous discount message
                const selectedCourses = Array.from(courseSelect.selectedOptions);
                const selectedChildren = Array.from(childSelect.selectedOptions);

                let totalCoursePrice = 0;
                selectedCourses.forEach(course => {
                    totalCoursePrice += parseFloat(course.getAttribute('data-price'));
                });

                const numChildren = selectedChildren.length;
                let total = numChildren * totalCoursePrice;

                // Apply discount if available
                const discountCode = discountCodeInput.value;
                if (discountCode) {
                    checkDiscountCode(discountCode, total).then(discountedTotal => {
                        totalInput.value = discountedTotal;
                    });
                } else {
                    totalInput.value = total;
                }
            }

            $('#child-select').on('change', calculateTotal);
            $('#course-select').on('change', calculateTotal);
            $('#discount_code').on('input', calculateTotal);

            // Initial calculation
            calculateTotal();
        });
    </script>
@endsection
