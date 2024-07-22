@extends('partials.client.header')
@section('content')
<div class="container" >
    <div class="row">
        <div class="col-md-2">
            <div class="box mb-5">
                <div class="card">
                    <div class="card-body">

                        <a href="{{route('client.profile')}}" class=" btn form-control btn-outline-primary mb-3">Profile</a>
                        <a href="{{route('client.transaction')}}" class=" btn form-control btn-outline-primary {{Route::is('client.transaction*') ? 'active':''}}">Transaction</a>
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
                        <img src="{{asset('pendaftar')}}/assets/img/profile-bg.png" alt="">
                        <!-- <div class="col-md-4 mt-3"> -->
                        <!-- </div> -->
                    </div>
                    <h3>Transaction List</h3>
                    <a href="{{route('client.transaction.create')}}" class="btn btn-sm btn-primary">Add</a>
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr">
                                <th style="background-color: #111d5e;" class="text-white">No</th>
                                <th style="background-color: #111d5e;" class="text-white">Reg No</th>
                                <th style="background-color: #111d5e;" class="text-white">Course Name</th>
                                <th style="background-color: #111d5e;" class="text-white">Status</th>
                                <th style="background-color: #111d5e;" class="text-white">Amount</th>
                                <th style="background-color: #111d5e;" class="text-white">More Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>PRE/2024/00413</td>
                                <td>
                                    <li>Bahasa Inggris X1</li>
                                    <li>Matematika</li>
                                    <li>Bahasa Korea</li>
                                </td>
                                <td><span class="badge bg-success">Success</span></td>
                                <td>Rp. 120.000</td>
                                <td><a href="#" class="btn btn-sm btn-primary">Details</a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>PRE/2024/00413</td>
                                <td>Bahasa Inggris</td>
                                <td><span class="badge bg-success">Success</span></td>
                                <td>Rp. 120.000</td>
                                <td><a href="#" class="btn btn-sm btn-primary">Details</a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>PRE/2024/00413</td>
                                <td>Bahasa Inggris</td>
                                <td><span class="badge bg-success">Success</span></td>
                                <td>Rp. 120.000</td>
                                <td><a href="#" class="btn btn-sm btn-primary">Details</a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>PRE/2024/00413</td>
                                <td>Bahasa Inggris</td>
                                <td><span class="badge bg-success">Success</span></td>
                                <td>Rp. 120.000</td>
                                <td><a href="#" class="btn btn-sm btn-primary">Details</a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>PRE/2024/00413</td>
                                <td>Bahasa Inggris</td>
                                <td><span class="badge bg-success">Success</span></td>
                                <td>Rp. 120.000</td>
                                <td><a href="#" class="btn btn-sm btn-primary">Details</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection