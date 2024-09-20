@extends('layouts.dashboardmaster')

@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Category Edit</h4>

                <form role="form" action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Title</label>
                        <div class="col-sm-9">
                            <input name="title" type="text" class="form-control" id="inputEmail3" placeholder="Category Title" value="{{ $category->title }}">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>

                            @enderror
                        </div>
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Slug</label>
                        <div class="col-sm-9">
                            <input name="slug" type="text" class="form-control mt-2" id="inputEmail3" placeholder="Category Slug" value="{{ $category->slug }}">

                        </div>
                        <label for="inputEmail3" class="col-sm-3 col-form-label"> Category Image </label>
                        <div class="col-sm-9">
                            <img id="cat_img" src="{{ asset('uploads/category') }}/{{ $category->image }}" alt="" style="height: 120px; widht:100%; object-fit:contain; border-radius:30px; margin: 10px 0;">
                            <input onchange="document.querySelector('#cat_img').src=window.URL.createObjectURL(this.files[0]) " name="image" type="file" class="form-control mt-2" id="inputEmail3" >

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
