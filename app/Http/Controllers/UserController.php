<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WcUser;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    // display sign-in
    public function sign_in()
    {
        $category = Category::get();
        return view('pages.sign_in', compact('category'));
    }

    // display register
    public function register()
    {
        $category = Category::get();
        return view('pages.register', compact('category'));
    }

    // register user
    public function insert_users(Request $request)
    {
        WcUser::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'tin_id' => $request->tin_id,
            'username' => $request->username,
            'password' => $request->password,
        ]);
    }

    // login function
    public function user_login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        // Check if user exists
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::loginUsingId($user->id);
                return view('pages.my_profile');
            }
        }
        return response()->json(['message' => 'Wrong password'], 401);
    }

    // logout function
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('index');
    }

    // my profile
    public function view_profile()
    {
        return view('pages.my_profile');
    }



}
