<?php

namespace App\Http\Controllers;

use App\Mail\resetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    //This method will show login page for patients
    public function index()
    {
        return view('patient.login');
    }

    //This method will authenticate user
    public function authenticate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->passes()) {

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('account.dashboard');
            } else {
                return redirect()->route('account.login')->with('error', 'Invalid Credentials')->withInput();
            }

        } else {
            return redirect()->route('account.login')->withErrors($validator)->withInput();
        }
    }

    //This method will show register to user
    public function register()
    {
        return view('patient.register');
    }

    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:4|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed||min:5|max:20',
            'password_confirmation' => 'required|string|min:5|max:20',
            'number' => 'required|unique:users|max:11'
        ]);
        if ($validator->passes()) {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->number = $request->number;
            $user->password = Hash::make($request->password);
            $user->role = 'patient';
            $user->save();

            return redirect()->route('account.login')->with('success', 'You have registered successfully :)');
        } else {
            return redirect()->route('account.register')->withErrors($validator)->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login')->with('success', 'You have logged out successfully :)');
    }

    public function sendMail()
    {
        return view('patient.reset_email');
    }

    public function code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->passes()) {
            $email = $request->input('email');
            $token = Str::random(60); // Generate a random token

            // Store the token in the password_resets table
            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => now(),
            ]);

            // Send the email with the token
            Mail::to($email)->send(new resetPassword($token));

            return view('patient.enter_code', compact('token', 'email'));
        }
    }

    public function changePass_view(Request $request){
        $email = $request->input('email');

        return view('patient.changePassword', compact('email'));
    }

    public function changePass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|max:18|min:5',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->input('email');

        User::where('email', $email)->update(['password' => Hash::make($request->input('password'))]);

        return redirect()->route('account.login')->withSuccess('Password updated successfully');
    }

}
