<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //This method will show admin login page/screen
    public function index(){
        return view('admin.login');
    }

        //This method will authenticate user
    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' =>'required|email',
            'password' => 'required'
        ]);
        if($validator->passes()){

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

                if(Auth::guard('admin')->user()->role != "admin"){
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error', 'You are not authorized to access this page! :(')->withInput();
                }
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('admin.login')->with('error', 'Invalid Credentials')->withInput();
            }

        }else{
            return redirect()->route('admin.login')->withErrors($validator)->withInput();
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success','You have logged out successfully :)');
    }
}
