@extends('layouts.dashboardmaster')
@section('title')
    Category
@endsection

@section('content')
<x-breadcum title="Category show page"></x-breadcum>

<div class="row">
    <div class="col-lg-8">
        <div class="card" style="background-color:rgb(247, 60, 13)">
            <div class="card-body">
                <h4 class="header-title text-dark fw-bold ">Categories Table</h4>
                <div class="table-responsive" style="overflow: scroll; height:400px">
                    <table class="table table-success mb-0">
                        <thead>
                            <tr>
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
                                 <th scope="row">{{ $loop->index + 1 }}</th>
                                 <td>
                                    <img src="{{ asset('uploads/category/' . $category->image) }}" style="height: 100px; width:100px; border-radius:50%; border:4px solid rgb(47, 255, 0); box-shadow: -7px 5px 2px;">
                                 </td>
                                 <td>{{ $category->title }}</td>
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
                                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-outline-info"><i class="fa-solid fa-user-pen"></i></a>
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                 </td>
                             </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Category Insert Form --}}
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body text-dark" style="background-color: #c1d7b9">
                <h4 class="header-title mb-3">Category Insert</h4>
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Category Title</label>
                        <input name="title" type="text" class="form-control" id="title" placeholder="Category Title">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label fw-bold">Category Slug</label>
                        <input name="slug" type="text" class="form-control" id="slug" placeholder="Category Slug">
                        @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Category Image</label>
                        <img id="cat_img" src="{{ asset('uploads/default/demo.jpeg') }}" alt="" style="height: 120px; width:100%; object-fit:contain; border-radius:30px; margin: 10px 0;">
                        <input name="image" type="file" class="form-control" id="image" onchange="document.querySelector('#cat_img').src=window.URL.createObjectURL(this.files[0])">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-info">Insert</button>
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
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                stopOnFocus: true
            }).showToast();
        </script>
    @endif
@endsection
