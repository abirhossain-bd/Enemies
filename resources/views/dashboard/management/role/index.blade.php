@extends('layouts.dashboardmaster')

@section('title')
    Role

@endsection

@section('content')
<x-breadcum title="Role assign page"></x-breadcum>

<div class="row">
    <div class="col-lg-6" >
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Role Assign</h4>

                <form role="form" action="{{ route('role.index') }}" method="POST">
                    @csrf
                    <div class="row mb-3">

                        <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">Users name</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="user_id">
                                <option value="0">Select Name</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach

                            </select>
                            @error('user_id')
                                <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>


                        <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">Role</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="role">
                                <option value="0">Select Role</option>
                                <option value="manager">Manager</option>
                                <option value="blogger">Blogger</option>
                            </select>
                            @error('role')
                                <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>

                    </div>

                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Insert</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title ">All bloggers table</h4>


                <div class="table-responsive" style="overflow: scroll; max-height:400px">
                    <table class="table table-primary  mb-0">
                        <thead>
                            <tr class="">
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                @if (auth()->user()->role == 'admin')

                                <th>Status</th>
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($role_assign_blogger as $blogger)
                             <tr>
                                 <th scope="row">
                                     {{ $loop->index +1 }}
                                 </th>

                                 <td>
                                    {{ $blogger->name }}
                                 </td>
                                 <td>
                                    {{ $blogger->role }}
                                 </td>
                                 @if (auth()->user()->role == 'admin')
                                 <td>
                                    <form id="undoblogger{{ $blogger->id }}" action="{{ route('management.user.role.undo.blogger', $blogger->id) }}" method="POST">
                                        @csrf
                                    <div class="form-check form-switch" onclick="myFun()">
                                        <input onchange="document.querySelector('#undoblogger{{ $blogger->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $blogger->role == $blogger->role ? 'checked' : '' }}>

                                    </div>
                                    </form>
                                 </td>
                                 <td>
                                    <div class="d-flex justify-content-around">
                                        <div>
                                            <a href="{{ route('category.edit',$blogger->id) }}" class="btn btn-outline-info waves-effect waves-light"><i class="fa-solid fa-user-pen"></i></a>
                                        </div>
                                        <div>
                                            <form action="{{ route('category.destroy', $blogger->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger waves-effect waves-light"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                 </td>
                                 @endif
                             </tr>
                           @endforeach

                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div>





    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title ">All users table</h4>


                <div class="table-responsive" style="overflow: scroll; max-height:400px">
                    <table class="table table-primary  mb-0">
                        <thead>
                            <tr class="">
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                @if (auth()->user()->role == 'admin')

                                <th>Status</th>
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($role_assign_user as $user)
                             <tr>
                                 <th scope="row">
                                     {{ $loop->index +1 }}
                                 </th>

                                 <td>
                                    {{ $user->name }}
                                 </td>
                                 <td>
                                    {{ $user->role }}
                                 </td>
                                 @if (auth()->user()->role == 'admin')
                                 <td>
                                    <form id="undouser{{ $user->id }}" action="{{ route('management.user.role.undo.user', $user->id) }}" method="POST">
                                        @csrf
                                    <div class="form-check form-switch">
                                        <input onchange="document.querySelector('#undouser{{ $user->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $user->role == $user->role ? 'checked' : '' }}>

                                    </div>
                                    </form>
                                 </td>
                                 <td>
                                    <div class="d-flex justify-content-around">
                                        <div>
                                            <a href="{{ route('category.edit',$user->id) }}" class="btn btn-outline-info waves-effect waves-light"><i class="fa-solid fa-user-pen"></i></a>
                                        </div>
                                        <div>
                                            <form action="{{ route('category.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger waves-effect waves-light"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                 </td>
                                 @endif
                             </tr>
                           @endforeach

                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div>
</div>

@endsection


@section('script')


@if (session('insert_success'))
<script>
    Toastify({
  text: "{{ session('insert_success') }}",
  duration: 5000,
  destination: "https://github.com/apvarun/toastify-js",
  newWindow: true,
  close: true,
  gravity: "top", // `top` or `bottom`
  position: "right", // `left`, `center` or `right`
  stopOnFocus: true, // Prevents dismissing of toast on hover
  style: {
    background: "linear-gradient(to right, #00b09b, #96c93d)",
  },
  onClick: function(){} // Callback after click
}).showToast();
</script>
@endif


<script>
    function myFun(){
        Swal.fire({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "success"

    });
    }
</script>

@endsection
