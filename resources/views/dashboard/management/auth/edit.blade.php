@extends('layouts.dashboardmaster')

@section('content')

<div class="row">
    <div class="col-lg-6" >
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Manager Edit Page</h4>

                <form role="form" action="{{ route('management.user.update', $manager->id) }}" method="POST">
                    @csrf
                    <div class="row mb-3">

                        <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">Manager's name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{ $manager->name }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">Role</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="role">
                                <option value="0">Select Role</option>
                                <option value="manager">Manager</option>
                                <option value="blogger">Blogger</option>
                                <option value="user">User</option>
                            </select>
                            @error('role')
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
