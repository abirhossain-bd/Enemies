<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class ProfileController extends Controller
{
   public function index(){
    return view('dashboard.profile.index');
   }


//    name update start
   public function name_update(Request $request){
    $oldname = auth()->user()->name;
    $request->validate([
        'name'=>'required|regex:/^[\pL\s\.]+$/u',
    ]);

    User::find(auth()->id())->update([
        'name'=>$request->name,
        'updated_at' => now(),
    ]);

    return back()->with('name_update',"Name Updated Successfully $oldname to $request->name");
   }

//    name update end




// email update start

public function email_update(Request $request){
    $request->validate([
        'email' =>'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/',
    ]);
    User::find(auth()->id())->update([
        'email'=>$request->email,
        'updated_at' => now(),
    ]);
    return back()->with('email_update','Email Updated Successfully!');
}






// password update start

   public function password_update(Request $request){
    $request->validate([
        'c_pass'=>'required',
        'password_confirmation'=>'required',
        'password'=> 'required|confirmed|min:8|',
    ]);

    if(Hash::check($request->c_pass, auth()->user()->password)){
        User::find(auth()->user()->id)->update([
            'password'=>$request->password,
            "updated_at"=>now(),
        ]);
        return back()->with('password_update','Password Updated Successfully!');

    }else{
        return back()->withErrors(['c_pass'=>'Current Password Does not match!'])->withInput();
    }

   }

//    password update end



// image update start

public function image_update(Request $request){

    $manager = new ImageManager(new Driver());
    if($request->hasFile('image')){

        $newname = auth()->user()->id . '-' . now()->format('M-d-Y') . '-' . rand(0,9999) . '.' . $request->file('image')->getClientOriginalExtension();
        $image = $manager->read($request->file('image'));
        $image->toPng()->save(base_path('public/uploads/profile/'. $newname));

        User::find(auth()->user()->id)->update([
            'image'=>$newname,
            'updated_at'=>now(),
        ]);
        return back()->with('image_update','Image has updated successfully!');


    }else{
        return back()->withErrors(['image_error'=>"Please insert image first!"])->withInput();
    }



}


}
