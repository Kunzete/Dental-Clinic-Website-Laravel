<?php

namespace App\Http\Controllers;

use App\Mail\MailableName;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{

    public function profile(){
        return view('patient.profile');
    }

    public function appointment(){
        $user = Auth::user()->email;
        $all = Appointment::where('patient_email', $user)->count();
        $pending = Appointment::where([ 'patient_email'=>$user, 'status' => 'pending'])->count();
        $confirmed = Appointment::where([ 'patient_email'=>$user, 'status' => 'confirmed'])->count();
        $cancelled = Appointment::where([ 'patient_email'=>$user, 'status' => 'cancelled'])->count();
        $doctors = User::join('appointments', 'users.id', '=', 'appointments.doctor_id')
        ->select('users.*')
        ->get();

        $table_all = Appointment::where('patient_email', $user)->get();
        $d = User::where('role', 'doctor')->get();
        return view('patient.Dashboard', compact('d','all', 'pending', 'confirmed', 'cancelled', 'table_all', 'doctors'));
    }

    public function booking(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required|string",
            "number" => "required|string",
            "email" => "required|email",
            "address" => "required|string",
            "time" => "required|string",
            "day" => "required|string",
            "doctor" => "required|string",
            "description" => "nullable|string"
        ]);

        if ($validator->passes()) {
            $appointment = new Appointment();
            $appointment->patient_name = $request->input('name');
            $appointment->patient_email = $request->input('email');
            $appointment->patient_number = $request->input('number');
            $appointment->patient_address = $request->input('address');
            $appointment->appointment_time = $request->input('time');
            $appointment->appointment_day = $request->input('day');
            $appointment->doctor_id = $request->input('doctor');
            $appointment->description = $request->input('description');
            $appointment->status = 'pending';
            $appointment->save();

            $email = $appointment->patient_email;
            $name = $appointment->patient_name;
            $status = $appointment->status;


            Mail::to($email)->send(new MailableName($appointment));

            return redirect()->route('account.dashboard')->with("success", "Appointment Booked Successfully!");
        }
        return redirect()->route('account.dashboard')->withErrors($validator);
    }
}
