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


                <div class="table-responsive" >
                    <table class="table table-success  mb-0">
                        <thead>
                            <tr class="">
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category Title</th>
                                <th>Status</th>
                                <th>Feature</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($blogs as $blog)
                             <tr class="bg-primary">
                                 <th scope="row">
                                     {{ $blogs->firstItem() + $loop->index }}
                                 </th>
                                 <td>
                                    <img src="{{ asset('uploads/blog') }}/{{ $blog->thumbnail }}" style="height: 100px; width:100px; border-radius:50%; border:4px solid rgb(47, 255, 0); box-shadow: -7px 5px 2px;">
                                 </td>
                                 <td>
                                    {{ $blog->title }}
                                 </td>
                                 <td>
                                    {{ $blog->oneCategory->title }}
                                 </td>
                                 <td>
                                    <form id="statusForm{{ $blog->id }}" action="{{ route('blog.status', $blog->id) }}" method="POST">
                                        @csrf
                                    <div class="form-check form-switch">
                                        <input onchange="document.querySelector('#statusForm{{ $blog->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $blog->status == 'active' ? 'checked' : '' }}>
                                    </div>
                                    </form>
                                 </td>

                                 <td>
                                    <form id="featureForm{{ $blog->id }}" action="{{ route('blog.feature', $blog->id) }}" method="POST">
                                        @csrf
                                    <div class="form-check form-switch">
                                        <input onchange="document.querySelector('#featureForm{{ $blog->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $blog->feature == true ? 'checked' : '' }}>
                                    </div>
                                    </form>
                                 </td>
                                 <td>
                                    <div class="d-flex justify-content-around">
                                        <div>
                                            <a href="{{ route('blog.edit',$blog->id) }}" class="btn btn-outline-info waves-effect waves-light"><i class="fa-solid fa-user-pen"></i></a>
                                        </div>
                                        <div>
                                            <form action="{{ route('blog.destroy', $blog->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
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
                        {{ $blogs->links() }}
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
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                stopOnFocus: true
            }).showToast();
        </script>
    @endif
@endsection
