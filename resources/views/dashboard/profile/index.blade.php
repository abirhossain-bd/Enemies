@extends('layouts.dashboardmaster')

@section('title')
    Profile

@endsection


@section('content')
<x-breadcum title="Profile edit page"></x-breadcum>


<div class="row">
    <div class="col-lg-6">
        {{-- success msg --}}
        @if (session('name_update'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-all me-2"></i>
            {{ session('name_update') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif



        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Username Update</h4>

                <form role="form" action="{{ route('profile.name.update') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input name="name" type="text" class="form-control" id="inputEmail3" placeholder="Name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>

                    </div>

                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- email update --}}
    <div class="col-lg-6">
        {{-- success msg --}}
        @if (session('email_update'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-all me-2"></i>
            {{ session('email_update') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif



        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Email Update</h4>

                <form role="form" action="{{ route('profile.email.update') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input name="email" type="text" class="form-control" id="inputEmail3" placeholder="Email">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>

                    </div>

                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- password update --}}
    <div class="col-lg-6">
        {{-- success msg --}}
        @if (session('password_update'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-all me-2"></i>
            {{ session('password_update') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif



        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Password Update</h4>

                <form role="form" action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Current Password</label>
                        <div class="col-sm-9">
                            <input name="c_pass" type="password" class="form-control" id="inputEmail3" placeholder="Current Password">
                            @error('c_pass')
                                <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>
                        <label for="inputEmail3" class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-9">
                            <input name="password" type="password" class="form-control mt-2" id="inputEmail3" placeholder="New Password">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <input name="password_confirmation" type="password" class="form-control mt-2" id="inputEmail3" placeholder="Confirm Password">
                            @error('password_confirmation')
                                <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>

                    </div>

                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- img update --}}
    <div class="col-lg-6">
        {{-- success msg --}}
        @if (session('image_update'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-all me-2"></i>
            {{ session('image_update') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif



        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Image Update</h4>

                <form role="form" action="{{ route('profile.image.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-9">
                            <img id="img_up" src="{{ asset('uploads/default/demo.jpeg') }}" alt="" style="height: 120px; widht:100%; object-fit:contain; border-radius:30px; margin: 10px 0;">
                            <input onchange="document.querySelector('#img_up').src=window.URL.createObjectURL(this.files[0]) " name="image" type="file" class="form-control" id="inputEmail3">
                            @error('image_error')
                                <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>

                    </div>

                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
