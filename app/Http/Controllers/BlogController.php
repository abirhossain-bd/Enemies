<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('dashboard.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 'active')->latest()->get();
        return view('dashboard.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $manager = new ImageManager(new Driver());
    $request->validate([
        'category_id' => 'required',
        'title' => 'required',
        'short_description' => 'required|max:350',
        'description' => 'required',
        'thumbnail' => 'required',
    ]);

    if ($request->hasFile('thumbnail')) {
        $newname = Auth::user()->id . '-' . Str::random(4) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
        $image = $manager->read($request->file('thumbnail'));
        $image->toPng()->save(base_path('public/uploads/blog/' . $newname));

        // user_id add koro
        Blog::create([
            'user_id' => Auth::user()->id, // user_id er value add kora
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $request->slug ? Str::slug($request->slug, '-') : Str::slug($request->title, '-'),
            'short_description' => $request->short_description,
            'description' => $request->description,
            'thumbnail' => $newname,
            'created_at' => now(),
        ]);

        return redirect()->route('blog.index')->with('success', 'Blog Created Successfully');
    }
}


    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
