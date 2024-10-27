<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\get;

class ManagementController extends Controller
{
    public function index(){
        $managers = User::where('role', 'manager')->get();
        return view('dashboard.management.auth.index', compact('managers'));
    }


    // role create and user registration
    public function user_register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => 'required|not_in:0',
        ]);

        if(!$request->role == '0'){

            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'role'=>$request->role,
            ]);
            return back()->with('insert_success','User Registered Successfully!');
        }else{
            return back()->withErrors(['role'=>"Please Select a role first!"])->withInput();
        }

    }


    // role undo
    public function role_undo($id){
        $manager = User::where('id', $id)->first();

        if($manager->role == 'manager'){
            User::find($manager->id)->update([
                'role'=>'user',
                'updated_at'=> now(),
            ]);
        return back()->with('insert_success','Role Changed Successfully!');
        }
    }

    public function edit($id){
        $manager = User::where('id',$id)->first();
        return view('dashboard.management.auth.edit',compact('manager'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'role'=> 'required|not_in:0',
        ]);
        User::find($id)->update([
            'name' => $request->name,
            'role' => $request->role,
            'updated_at' =>now(),
        ]);
        return redirect()->route('management.index')->with('success','Role Updated Successfully!');
    }


    public function destroy($id){
        User::find($id)->delete();
        return back()->with('success','User Deleted Successfully!');
    }



    // role assign

    public function role_assign(){
        $users = User::where('role', 'user')->where('block',0)->get();
        $role_assign_blogger = User::where('role', 'blogger')->get();
        $role_assign_user = User::where('role', 'user')->where('block',0)->get();
        return view('dashboard.management.role.index',[
            'users' => $users,
            'role_assign_blogger' => $role_assign_blogger,
            'role_assign_user' => $role_assign_user,
        ]);
    }

    public function role_assign_post(Request $request){

        $request->validate([
            'user_id' => 'required|not_in:0',
            'role' => 'required|not_in:0',
        ]);
        $user = User::where('id', $request->user_id)->first();
        User::find($user->id)->update([
            'role' => $request->role,
        ]);

        return back()->with('insert_success','Role Changed Successfully!');


    }
    public function role_undo_blogger($id){
        $blogger = User::where('id', $id)->first();

        if($blogger->role == 'blogger'){
            User::find($blogger->id)->update([
                'role'=>'user',
                'updated_at'=> now(),
            ]);
        return back()->with('insert_success','Role Changed Successfully!');
        }
    }


    public function destroy_blogger($id){
        User::where('id', $id)->delete();
        return back()->with('success','Blogger Deleted Successfully!');
    }





    public function role_undo_user($id){
        $user = User::where('id', $id)->first();

        if($user->role == 'user'){
            User::find($user->id)->update([
                'block'=>true,
                'updated_at'=> now(),
            ]);
        return back()->with('insert_success','Role Changed Successfully!');
        }
    }


    public function destroy_user($id){
        User::where('id',$id)->delete();
        return back()->with('success','User Deleted Successfully!');
    }


}
