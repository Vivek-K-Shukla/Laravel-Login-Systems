<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;

class CustomAuthController extends Controller
{
    public function registration(){
        return view("auth.registration");
    }

    public function registerUser(Request $req){
        // return $req->input();
        $req->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12'
        ]);
        $user=new User();
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->save();
        if($user){
            return back()->with('success','You Have Registered Successfully!');
        }
        else{
            return back()->with('fail','Something Went Wrong!');
        }
    }

    public function login(){
        return view("auth.login");
    }

    public function loginUser(Request $req){
        $req->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
        ]);

        $user=User::where('email','=',$req->email)->first();
        if($user){
            if(Hash::check($req->password,$user->password)){
                $req->session()->put('loginId',$user->id);
                return redirect('dashboard');
            }else{
            return back()->with('fail','Password does not Matches!');
        }
    }
        else{
            return back()->with('fail','The Email is not Registered!');
        }
    }

    public function dashboard(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view("auth.dashboard",['data'=>$data]);
    }

    public function logout(){
        if (Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }
}
