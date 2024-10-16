<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $features = Blog::where('feature', true)->latest()->take(3)->get();
        $blogs = Blog::where('status','active')->latest()->take(5)->get();
        $categories = Category::where('status','active')->latest()->get();

        $popularBlogs = Blog::where('status','active')->orderBy('counts', 'desc')->take(5)->get();
        return view('frontend.home.index',compact('categories','blogs','features', 'popularBlogs'));
    }
}
