<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function signup()
    {
        return view("user.signup");
    }

    public function loginUser()
    {
        return view("user.login");
    }

    public function signupUser(Request $req)
    {
        // return $req->input();
        $req->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:5|max:12',
            ],
            ['name.required' => "This fiels can not be blank."]
        );
        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        if ($user) {
            return redirect('/loginUser')->with('success', 'You Have Registered Successfully! Login.');
        } else {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }


    public function loginMember(Request $req)
    {
        $req->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:5|max:12'
            ],
            [
                'email.required' => "Email field can not be blank.",
                'password.required=' => "Password field can not be blank."
            ]
        );

        $user = User::where('email', '=', $req->email)->first();
        if ($user) {
            if (Hash::check($req->password, $user->password)) {
                $req->session()->put('loginId', $user->id);
                return redirect('/home');
            } else {
                return back()->with('fail', 'Password does not Matches!');
            }
        } else {
            return back()->with('fail', 'The Email is not Registered!');
        }
    }

    public function home()
    {
        $member = User::where('status', 'Active')->get();
        return view("user.home", ['members' => $member]);
    }

    public function signoff()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('login');
        }
    }
}
