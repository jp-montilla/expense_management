<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('user.index')->with('users', $users)->with('roles',$roles);
    }

   
    public function store(Request $request)
    {
        $user =  new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->password=bcrypt('password');

        $user->save();
    }

   
    public function update(Request $request, $id)
    {
        $user =  User::find($id);

       	$user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->password=bcrypt('password');

        $user->save();
    }
    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Category  $category
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect("/user");
    }

    public function edit_password()
    {
        $message = '';
        return view('user.password')->with('message',$message);
    }

    public function update_password(Request $request, $id)
    {
        $user =  User::find($id);
        $new_pass = $request->input('new_password');
        $confirm_pass = $request->input('confirm_password');
        if (Hash::check($request->input('old_password'), $user->password)) {
            if($new_pass == $confirm_pass){
                $user->password=bcrypt($new_pass);
                $user->save();
                $message = 'Password Changed!';
                return view('user.password')->with('message',$message);
            }
            else{
                $message = 'New Password and Confirm Password doenst match';
                return view('user.password')->with('message',$message);
            }
        }
        else
        {
            $message = "Old Password doesn't match";
            return view('user.password')->with('message',$message);
        }
    }
}
