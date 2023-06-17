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



class CustomAuthController extends Controller
{
    public function registration()
    {
        return view("auth.registration");
    }

    public function registerUser(Request $req)
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
            return view('auth.login')->with('success', 'You Have Registered Successfully! Login.');
        } else {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    public function login()
    {
        return view("auth.login");
    }

    public function loginUser(Request $req)
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
                return redirect('dashboard');
            } else {
                return back()->with('fail', 'Password does not Matches!');
            }
        } else {
            return back()->with('fail', 'The Email is not Registered!');
        }
    }



    public function dashboard()
    {
        $data = array();
        if (Session::has('loginId')) {
            // $data=User::where('id','=',Session::get('loginId'))->first();
            $data = User::all();
        }
        return view("dashboard.index", ['datas' => $data]);
    }

    public function userlist()
    {
        $data = array();
        if (Session::has('loginId')) {
            // $data=User::where('id','=',Session::get('loginId'))->first();
            $data = User::all();
        }
        return view("admin.userlist", ['datas' => $data]);
    }


    public function edit($id)
    {
        $edit = User::find($id);
        return view('admin.edit', ['members' => $edit]);
    }

    public function update(Request $req)
    {
        $update = User::find($req->id);
        $update->name = $req->name;
        $update->email = $req->email;
        $update->status = $req->status;
        $update->update();
        return redirect('/userlist')->with('status', 'Member Updated Successfully!');
    }

    public function task($id)
    {
        $task = User::find($id);
        return view('admin.task', ['tasks' => $task]);
    }

    public function updatetask(Request $req)
    {
        $task = User::find($req->id);
        $task->task = $req->task;
        $task->update();
        return redirect('/userlist')->with('status', 'Member Updated Successfully!');
    }



    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect('/userlist')->with('status', 'Member Deleted Successfully!');
    }


    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('login');
        }
    }

    public function passwordReset()
    {
        return view('auth.reset');
    }


    public function passwordResetSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('auth.mailforget', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return back()->with('message', 'We have mailed you,your password reset link');
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.resetpass', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'reqiured|email|exists:registration',
            'password' => 'required|string|min:1|confirmed',
            'password_confirmation' => 'required'
        ]);

        // $updatePassword=DB::table('password_resets')->where
    }

    public function passwordChange()
    {
        return view('auth.changepassword');
    }

    public function passwordUpdate(Request $request)
    {
        // return $request->input();
        $rules = [
            'password' => 'required',
            'newpassword' => 'required',
            'cannewpassword' => 'same:newpassword'
        ];
        $custommsg = [
            'password.required' => 'Old password must be filled out.',
            'newpassword.required' => 'New password must be filled out.',
            'cannewpassword.required' => 'Confirm password must be filled out.',
        ];
        $validate = Validator::make($request->all(), $rules, $custommsg);
        if ($validate->fails()) {
            return redirect('change-password')->withErrors($validate);
        } else {
            $check = Hash::check($request->password, auth()->users()->password);
            if ($check) {
                $user = User::find(auth()->users()->id);
                $user->update(['password' => Hash::make($request->newpassword)]);
                return redirect('change-password')->with('msg', 'Password Updated Successfully!');
            } else {
                return redirect('change-password')->with('msg', "You have entered wrong Password!");
            }
        }
    }
}
