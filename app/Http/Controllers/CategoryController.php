<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('dashboard.category.index',compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            "title"=>'required',
            "image"=>'required|image',
        ]);

        $manager = new ImageManager(new Driver());
        if($request->hasFile('image')){
            $newname = auth()->user()->id . '-' . now()->format('M-d-Y') . '-' . rand(0,9999) . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/category/'. $newname));


            if($request->slug){

                Category::insert([
                    'title'=>$request->title,
                    'slug'=> Str::slug($request->slug,'-'),
                    'image'=>$newname,
                    'created_at'=>now(),
                ]);
            }else{
                Category::insert([
                    'title'=>$request->title,
                    'slug'=>Str::slug($request->title,'-'),
                    'image'=>$newname,
                    'created_at'=>now(),
                ]);

            }
            return back()->with('insert_success','Category inserted Successfully!');


        }

    }




    // Category update section

    public function edit($id){
        $category = Category::where('id',$id)->first();
        return view('dashboard.category.edit', compact('category'));
    }


    public function update(Request $request , $id){
        $request->validate([
            'title'=>'required',

        ]);
        $manager = new ImageManager(new Driver());

        if($request->hasFile('image')){
            $category = Category::where('id', $id)->first();

            if($category->image){
                $oldpath = base_path('public/uploads/category/'. $category->image);
                if(file_exists($oldpath)){
                    unlink($oldpath);
                }
            }
            $newname = auth()->user()->id . '-' . now()->format('M-d-Y') . '-' . rand(0,9999) . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/category/'.$newname));

            if($request->slug){
                Category::find($id)->update([
                    'title'=>$request->title,
                    'slug'=>Str::slug($request->slug, '-'),
                    'image'=>$newname,
                    'updated_at'=>now(),
                ]);
                return redirect()->route('category.index')->with('insert_success', 'Category updated successfully!');

            }else{
                Category::find($id)->update([
                    'title'=>$request->title,
                    'slug'=>Str::slug($request->title, '-'),
                    'image'=>$newname,
                    'updated_at'=>now(),
                ]);
                return redirect()->route('category.index')->with('insert_success', 'Category updated successfully!');
            }





        }else{
            if($request->slug){
                Category::find($id)->update([
                    'title'=>$request->title,
                    'slug'=>Str::slug($request->slug, '-'),
                    'updated_at'=>now(),
                ]);
                return redirect()->route('category.index')->with('insert_success', 'Category updated successfully!');
            }else{
                Category::find($id)->update([
                    'title'=>$request->title,
                    'slug'=>Str::slug($request->title, '-'),
                    'updated_at'=>now(),
                ]);
                return redirect()->route('category.index')->with('insert_success', 'Category updated successfully!');
            }
        }
    }


    // delete section

    public function destroy($id){
        $category= Category::where('id',$id)->first();
        if($category->image){
            $oldpath = base_path('public/uploads/category/'. $category->image);
            if(file_exists($oldpath)){
                unlink($oldpath);
            }
        }
        Category::find($id)->delete();
        return back()->with('insert_success','Category deleted Successfully!');
    }

    public function status($id){
        $category = Category::where('id',$id)->first();

        if($category->status == 'active'){
            Category::find($category->id)->update([
                'status'=>'deactive',
                'updated_at'=> now(),
            ]);
        return back()->with('insert_success','Category Deactivated Successfully!');
        }else{
            Category::find($category->id)->update([
                'status'=>'active',
                'updated_at'=> now(),
            ]);
        return back()->with('insert_success','Category Activated Successfully!');
        }
    }
}
