@extends('partials.client.header')
@section('content')
<div class="container" >
    <div class="row">
        <div class="col-md-2">
            <div class="box mb-5">
                <div class="card">
                    <div class="card-body">

                        <a href="{{route('client.profile')}}" class=" btn form-control btn-outline-primary mb-3 {{Route::is('client.profile') ? 'active':''}}">Profile</a>
                        <a href="{{route('client.transaction')}}" class=" btn form-control btn-outline-primary">Transaction</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                            <div class="alert alert-success alert-dismissible show fade">
                                {{session('success')}}.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    <div class="row mb-3">
                        <img src="{{asset('pendaftar')}}/assets/img/profile-bg.png" alt="">
                        <!-- <div class="col-md-4 mt-3"> -->
                        <!-- </div> -->
                    </div>
                    <h3>Edit Profile</h3>
                    <hr>
                    <h5 style="font-weight: 200; color: #6d6d6d;">Personal Information</h5>
                    <a href="{{route('client.edit_profile')}}" class="btn btn-sm btn-primary">Edit Profile</a>
                    <div class="row mb-3">
                        <div class="col-md-6 mt-3">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" disabled value="Vicky Leonardo Manurung">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">Email</label>
                            <input type="text" class="form-control" disabled value="Vicky Leonardo Manurung">
                        </div>
                        <div class="col-md-12-mt-3">
                            <label for="">Alamat</label>
                            <textarea name="" class="form-control" disabled cols="3" id="">Bengkong Telaga Indah Blok F/19</textarea>
                        </div>
                    </div>
                    <hr>
                    <h5 style="font-weight: 200; color: #6d6d6d;">Children Information</h5>
                    <a href="{{route('client.add_children')}}" class="btn btn-sm btn-primary">Add</a>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Sekolah</th>
                                <th>Tanggal Lahir</th>
                                <th>Kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (auth()->user()->child as $child)
                            <tr>
                                <td> {{$child->name}} </td>
                                <td> {{$child->school}} </td>
                                <td> {{Carbon\Carbon::parse($child->birthday)->format('d F Y')}} </td>
                                <td> {{$child->class}} </td>
                                <td><a href="{{route('client.edit_children',$child->id)}}" class="badge bg-primary">Edit</a>
                                    <a href="{{route('client.delete_children',$child->id)}}" class="badge bg-danger">Delete</a>
                                </td>
                            </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">No data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection