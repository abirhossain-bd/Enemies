@extends('layouts.master')

@section('content')

<!--section-heading-->
<div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>Blog's Page</h1>
                         <p class="links"><a href="{{ route('frontend') }}">Home <i class="las la-angle-right"></i></a> Blog</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>


 <!-- Blog Layout-2-->
 <section class="blog-layout-2">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12">
                 <!--post 1-->
                 @forelse ($blogs as $blog)
                    <div class="post-list post-list-style2">
                        <div class="post-list-image">
                            <a href="post-single.html">
                                <img src="{{ asset('uploads/blog') }}/{{ $blog->thumbnail }}" alt="" style="height:250px; width:250px; object-fit:cover">
                            </a>
                        </div>
                        <div class="post-list-content">
                            <h3 class="entry-title">
                                <a href="post-single.html">{{ $blog->title }}</a>
                            </h3>
                            <ul class="entry-meta">
                                <li class="post-author-img">
                                    @if($blog->oneUser)
                                        <img src="{{ Avatar::create($blog->oneUser->name)->toBase64(); }}" alt="">
                                    @else
                                        <img src="{{ Avatar::create('Unknown')->toBase64(); }}" alt="">
                                    @endif
                                </li>
                                <li class="post-author">
                                    <a href="author.html">
                                        {{ $blog->oneUser ? $blog->oneUser->name : 'Unknown Author' }}
                                    </a>
                                </li>
                                <li class="entry-cat">
                                    <a href="blog-layout-1.html" class="category-style-1 ">
                                        <span class="line"></span>
                                        {{ $blog->oneUser ? $blog->oneUser->role : 'Unknown Role' }}
                                    </a>
                                </li>

                                <li class="post-date"> <span class="line"></span> {{ Carbon\Carbon::parse($blog->created_at)->format('F d,Y') }} </li>
                            </ul>
                            <div class="post-exerpt">
                                <p>{!! $blog->short_description !!}</p>
                            </div>
                            <div class="post-btn">
                                <a href="{{ route('frontend.blog.single', $blog->slug) }}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="post-list post-list-style2">
                        <div class="post-list-image">
                            <a href="post-single.html">
                                <img src="{{ asset('uploads/default/default.jpeg') }}" alt="">
                            </a>
                        </div>
                        <div class="post-list-content">
                            <h3 class="entry-title">
                                <a href="post-single.html" class="text-danger">No content found!!</a>
                            </h3>
                            <ul class="entry-meta">
                                <li class="post-author-img"><img src="{{ Avatar::create('No Content')->toBase64(); }}" alt=""></li>
                                <li class="post-author"> <a href="author.html">Name...</a></li>
                                <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span> interior</a></li>
                                <li class="post-date"> <span class="line"></span> Date ../../../ </li>
                            </ul>
                            <div class="post-exerpt">
                                <p>Short Description Not found!</p>
                            </div>
                            <div class="post-btn">
                                <a href="post-single.html" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>

                 @endforelse
             </div>
         </div>
     </div>
 </section>


<!--pagination-->
<div class="pagination">
     <div class="container-fluid">
         <div class="pagination-area">
             <div class="row">
                 <div class="col-lg-12">
                    {{ $blogs->links() }}

                 </div>
             </div>
         </div>
     </div>
 </div>


@endsection
