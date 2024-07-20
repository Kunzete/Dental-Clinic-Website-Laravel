<?php

namespace App\Http\Controllers;

use App\Mail\MailableName;
use App\Models\Appointment;
use App\Models\ServiceTable;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use \Illuminate\Support\Facades\Validator;
use \Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function Dashboard()
    {
        // Assuming the role is stored in a 'roles' table with a many-to-many relationship
        $doctors = User::where('role', 'doctor')->inRandomOrder()->take(3)->get();
        $services = ServiceTable::inRandomOrder()->take(10)->get();
        $count = User::where('role', 'doctor')->get()->count();

        // If you have a view to display the users
        return view('welcome', compact('doctors', 'count', 'services'));

        // If you just want to return the data as JSON
        // return response()->json($patients);
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

            return redirect()->route('index')->with("success", "Appointment Booked Successfully!");
        }
        return redirect()->route('index')->withErrors($validator);
    }
}
