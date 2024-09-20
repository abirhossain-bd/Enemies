
@extends('layouts.dashboardmaster')


@section('content')
<div class="row">
    <div class="col-lg-6" >
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Create New User</h4>

                <form role="form" action="{{ route('management.user.register') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">Name</label>
                        <div class="col-sm-9">
                            <input  name="name" type="text" class="form-control" id="inputEmail3" placeholder="Name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>
                        <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">Email</label>
                        <div class="col-sm-9">
                            <input name="email" type="email" class="form-control mt-2" id="inputEmail3" placeholder="Email">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>
                        <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">Password</label>
                        <div class="col-sm-9">
                            <input name="password" type="password" class="form-control mt-2" id="inputEmail3" placeholder="Password">
                            @error('password')
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
                            <button type="submit" class="btn btn-info waves-effect waves-light">Insert</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- manager part --}}

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title ">Manager Table</h4>


                <div class="table-responsive" style="overflow: scroll; height:400px">
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
                           @foreach ($managers as $manager)
                             <tr>
                                 <th scope="row">
                                     {{ $loop->index +1 }}
                                 </th>

                                 <td>
                                    {{ $manager->name }}
                                 </td>
                                 <td>
                                    {{ $manager->role }}
                                 </td>
                                 @if (auth()->user()->role == 'admin')
                                 <td>
                                    <form id="undo{{ $manager->id }}" action="{{ route('management.user.role.undo', $manager->id) }}" method="POST">
                                        @csrf
                                    <div class="form-check form-switch">
                                        <input onchange="document.querySelector('#undo{{ $manager->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $manager->role == $manager->role ? 'checked' : '' }}>

                                    </div>
                                    </form>
                                 </td>
                                 <td>
                                    <div class="d-flex justify-content-around">
                                        <div>
                                            <a href="{{ route('category.edit',$manager->id) }}" class="btn btn-outline-info waves-effect waves-light"><i class="fa-solid fa-user-pen"></i></a>
                                        </div>
                                        <div>
                                            <form action="{{ route('category.destroy', $manager->id) }}" method="POST">
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

@endsection
