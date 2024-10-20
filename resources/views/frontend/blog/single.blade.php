@extends('layouts.master')

@section('content')
<!--post-single-->
<section class="post-single">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--post-single-image-->
                <div class="post-single-image d-flex justify-content-center">
                    <img src="{{ asset('uploads/blog/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" style="height:600px;width:900px; object-fit:cover">
                </div>

                <div class="post-single-body">
                    <!--post-single-title-->
                    <div class="post-single-title">
                        <h2>{{ $blog->title }}</h2>
                        <ul class="entry-meta">
                            <li class="post-author-img">
                                <img src="{{ $blog->oneuser ? Avatar::create($blog->oneuser->name)->toBase64() : asset('path/to/default/image.png') }}" alt="">
                            </li>
                            <li class="post-author">
                                <a href="#">{{ $blog->oneuser ? $blog->oneUser->name : 'Unknown Author' }}</a>
                            </li>
                            <li class="post-date">
                                <span class="line"></span> {{ Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}
                            </li>
                        </ul>
                    </div>

                    <!--post-single-content-->
                    <div class="post-single-content">
                        <p>{!! $blog->short_description !!}</p>
                        <p>{!! $blog->description !!}</p>
                    </div>

                    <!--post-single-comments-->
                    @auth
                    <div class="post-single-comments">
                        <h4>{{ $comments->count() }} Comments</h4>
                        <ul class="comments">
                            @foreach($comments as $comment)
                            <div class="comment">
                                <div class="d-flex mb-3">
                                    <div class="commenter-img">
                                        <img src="{{ Avatar::create($comment->name)->toBase64() }}" alt="" style="width:50px;height:50px;border-radius:50%;">
                                    </div>
                                    <div class="comment-content">
                                        <p>{{ $comment->comment }}</p>
                                        <small>By {{ $comment->name }}</small>

                                        <!-- Replies -->
                                        @if($comment->replies)
                                            @foreach($comment->replies as $reply)
                                                <div class="reply">
                                                    <div class="d-flex mt-3">
                                                        <div class="commenter-img">
                                                            <img src="{{ Avatar::create($reply->name)->toBase64() }}" alt="" style="width:40px;height:40px;border-radius:50%;">
                                                        </div>
                                                        <div class="comment-content">
                                                            <p>{{ $reply->comment }}</p>
                                                            <small>By {{ $reply->name }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                        <!-- Reply form -->
                                        <form action="{{ route('frontend.blog.comment', $blog->id) }}" method="POST" class="reply-form mt-2">
                                            @csrf
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                            <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                            <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                            <div class="form-group">
                                                <textarea name="comment" placeholder="Your Reply" class="form-control mb-2"></textarea>
                                                <button type="submit" class="btn btn-primary">Reply</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </ul>

                        <!--Leave-comments-->
                        <div class="comments-form" id="comment">
                            <h4>Leave a Comment</h4>
                            <form action="{{ route('frontend.blog.comment', $blog->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                <div class="form-group">
                                    <textarea name="comment" placeholder="Your Comment*" class="form-control" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Post Comment</button>
                            </form>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>
<!--/post-single-->
@endsection

@section('scripts')
<script>
    function setParentId(commentId) {
        document.querySelector('input[name="parent_id"]').value = commentId;
    }
</script>
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
