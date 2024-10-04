@extends('layouts.dashboardmaster')
@section('title')
    Blog

@endsection

@section('content')
<x-breadcum title="Blog create page"></x-breadcum>

<div class="col-lg-12" >
    <div class="card">
        <div class="card-body text-dark" style="background-color: #c1d7b9">
            <h4 class="header-title mb-3"> Blog Create </h4>

            <form role="form" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold"> Blog Title</label>
                    <div class="col-sm-9">
                        <select class="form-control" datat-toggle="select2" name="category_id" id="">
                            <option> Select </option>
                            <optgroup label="Alaskan/Hawaiian Time Zone">
                                @forelse ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                @empty

                                @endforelse
                            </optgroup>
                        </select>



                        @error('title')
                            <p class="text-danger">{{ $message }}</p>

                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold"> Blog Title</label>
                    <div class="col-sm-9">
                        <input  name="title" type="text" class="form-control" id="inputEmail3" placeholder="Title">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>

                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold"> Blog Slug</label>
                    <div class="col-sm-9">
                        <input name="slug" type="text" class="form-control mt-2" id="inputEmail3" placeholder="Slug">
                        @error('slug')
                            <p class="text-danger">{{ $message }}</p>

                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">Blog Short Description </label>
                    <div class="col-sm-9">
                        <textarea name="short_description" type="text" class="form-control mt-2" id="abirproject"></textarea>
                        @error('short_description')
                            <p class="text-danger">{{ $message }}</p>

                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">Blog Description </label>
                    <div class="col-sm-9">
                        <textarea name="description" type="text" class="form-control mt-2" id="fulchadproject"></textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>

                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label fw-bold"> Blog Image </label>
                    <div class="col-sm-9">
                        <img id="blog_img" src="{{ asset('uploads/default/demo.jpeg') }}" alt="" style="height: 120px; widht:100%; object-fit:contain; border-radius:30px; margin: 10px 0;">
                        <input onchange="document.querySelector('#blog_img').src=window.URL.createObjectURL(this.files[0]) " name="thumbnail" type="file" class="form-control mt-2" id="inputEmail3" >
                        @error('thumbnail')
                            <p class="text-danger">{{ $message }}</p>

                        @enderror
                    </div>

                </div>

                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-info waves-effect waves-light">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('script')


<script>
    tinymce.init({
      selector: '#abirproject',
      plugins: [
        // Core editing features
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        // Your account includes a free trial of TinyMCE premium features
        // Try the most popular premium features until Oct 16, 2024:
        'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
      ],
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });
  </script>



<script>
    tinymce.init({
      selector: '#fulchadproject',
      plugins: [
        // Core editing features
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        // Your account includes a free trial of TinyMCE premium features
        // Try the most popular premium features until Oct 16, 2024:
        'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
      ],
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });
  </script>

@endsection
