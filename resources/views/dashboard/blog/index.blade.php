@extends('layouts.dashboardmaster')

@section('title')
    Blog

@endsection

@section('content')

<x-breadcum title="Blog show page"></x-breadcum>
<div class="row">
    <div class="col-lg-12">
        <div class="card" style="background-color:rgb(13, 204, 247)">
            <div class="card-body">
                <h4 class="header-title text-dark fw-bold ">Blogs Table</h4>


                <div class="table-responsive" style="overflow: scroll; max-height:500px">
                    <table class="table table-success  mb-0">
                        <thead>
                            <tr class="">
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($blogs as $blog)
                             <tr class="bg-primary">
                                 <th scope="row">
                                     {{ $loop->index +1 }}
                                 </th>
                                 <td>
                                    <img src="{{ asset('uploads/blog') }}/{{ $blog->thumbnail }}" style="height: 100px; width:100px; border-radius:50%; border:4px solid rgb(47, 255, 0); box-shadow: -7px 5px 2px;">
                                 </td>
                                 <td>
                                    {{ $blog->title }}
                                 </td>
                                 <td>
                                    <form id="enemy{{ $blog->id }}" action="{{ route('category.status', $blog->id) }}" method="POST">
                                        @csrf
                                    <div class="form-check form-switch">
                                        <input onchange="document.querySelector('#enemy{{ $blog->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $blog->status == 'active' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">{{ $blog->status }}</label>
                                    </div>
                                    </form>
                                 </td>
                                 <td>
                                    <div class="d-flex justify-content-around">
                                        <div>
                                            <a href="{{ route('category.edit',$blog->id) }}" class="btn btn-outline-info waves-effect waves-light"><i class="fa-solid fa-user-pen"></i></a>
                                        </div>
                                        <div>
                                            <form action="{{ route('category.destroy', $blog->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger waves-effect waves-light"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                 </td>
                             </tr>
                             @empty
                             <tr>
                                 <td colspan="5" class="text-center text-danger fs-4">No data found</td>
                             </tr>
                           @endforelse

                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div>
</div>
@endsection


@section('script')
@if (session('success'))
<script>
    Toastify({
  text: "{{ session('success') }}",
  duration: 5000,
  destination: "https://github.com/apvarun/toastify-js",
  newWindow: true,
  close: true,
  gravity: "top",
  position: "right",
  stopOnFocus: true,
  style: {
    background: "linear-gradient(to right, #00b09b, #96c93d)",
  }
  onClick: function(){}
}).showToast();
</script>

@endif
@endsection
