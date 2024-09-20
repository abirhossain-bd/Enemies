@extends('layouts.dashboardmaster');

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card" style="background-color:rgb(247, 60, 13)">
            <div class="card-body">
                <h4 class="header-title text-dark fw-bold ">Categories Table</h4>


                <div class="table-responsive" style="overflow: scroll; height:400px">
                    <table class="table table-success  mb-0">
                        <thead>
                            <tr class="">
                                <th>#</th>
                                <th>Category Image</th>
                                <th>Category Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($categories as $category)
                             <tr class="bg-primary">
                                 <th scope="row">
                                     {{ $loop->index +1 }}
                                 </th>
                                 <td>
                                    <img src="{{ asset('uploads/category') }}/{{ $category->image }}" style="height: 100px; width:100px; border-radius:50%; border:4px solid rgb(47, 255, 0); box-shadow: -7px 5px 2px;">
                                 </td>
                                 <td>
                                    {{ $category->title }}
                                 </td>
                                 <td>
                                    <form id="enemy{{ $category->id }}" action="{{ route('category.status', $category->id) }}" method="POST">
                                        @csrf
                                    <div class="form-check form-switch">
                                        <input onchange="document.querySelector('#enemy{{ $category->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $category->status == 'active' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">{{ $category->status }}</label>
                                    </div>
                                    </form>
                                 </td>
                                 <td>
                                    <div class="d-flex justify-content-around">
                                        <div>
                                            <a href="{{ route('category.edit',$category->id) }}" class="btn btn-outline-info waves-effect waves-light"><i class="fa-solid fa-user-pen"></i></a>
                                        </div>
                                        <div>
                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger waves-effect waves-light"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                 </td>
                             </tr>
                           @endforeach

                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div>




    {{-- form --}}


    <div class="col-lg-4" >
        <div class="card">
            <div class="card-body text-dark" style="background-color: #c1d7b9">
                <h4 class="header-title mb-3">Category Insert</h4>

                <form role="form" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">Category Title</label>
                        <div class="col-sm-9">
                            <input  name="title" type="text" class="form-control" id="inputEmail3" placeholder="Category Title">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>
                        <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">Category Slug</label>
                        <div class="col-sm-9">
                            <input name="slug" type="text" class="form-control mt-2" id="inputEmail3" placeholder="Category Slug">
                            @error('slug')
                                <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>
                        <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold"> Category Image </label>
                        <div class="col-sm-9">
                            <img id="cat_img" src="{{ asset('uploads/default/demo.jpeg') }}" alt="" style="height: 120px; widht:100%; object-fit:contain; border-radius:30px; margin: 10px 0;">
                            <input onchange="document.querySelector('#cat_img').src=window.URL.createObjectURL(this.files[0]) " name="image" type="file" class="form-control mt-2" id="inputEmail3" >
                            @error('image')
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
