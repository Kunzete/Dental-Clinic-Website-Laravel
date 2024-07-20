<?php

namespace App\Http\Controllers\dentist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('dentist.login');
    }

        //This method will authenticate user
    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' =>'required|email',
            'password' => 'required'
        ]);
        if($validator->passes()){

            if (Auth::guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password])) {

                if(Auth::guard('doctor')->user()->role != "doctor"){
                    Auth::guard('doctor')->logout();
                    return redirect()->route('dentist.login')->with('error', 'You are not authorized to access this page! :(')->withInput();
                }
                return redirect()->route('dentist.dashboard');
            }else{
                return redirect()->route('dentist.login')->with('error', 'Invalid Credentials')->withInput();
            }

        }else{
            return redirect()->route('dentist.login')->withErrors($validator)->withInput();
        }
    }

    public function logout(){
        Auth::guard('doctor')->logout();
        return redirect()->route('dentist.login')->with('success','You have logged out successfully :)');
    }
}
