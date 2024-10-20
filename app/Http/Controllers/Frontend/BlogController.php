<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::where('status', 'active')->latest()->paginate(1);
        return view('frontend.blog.index', compact('blogs'));
    }

    public function single($slug){
        $blog = Blog::where('slug', $slug)->first();
        $blog->increment('counts');
        // Parent comments with their replies
        $comments = BlogComment::with('replies')->where('blog_id', $blog->id)->whereNull('parent_id')->get();
        return view('frontend.blog.single', compact('blog', 'comments'));
    }

    public function comment(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
        ]);

        BlogComment::create([
            'user_id' => Auth::user()->id ?? null,
            'blog_id' => $id,
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Your comment has been posted successfully!');
    }
}
