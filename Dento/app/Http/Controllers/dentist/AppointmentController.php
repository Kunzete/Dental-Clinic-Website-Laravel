<?php

namespace App\Http\Controllers\dentist;

use App\Http\Controllers\Controller;
use App\Mail\MailableName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{

    public function all()
    {
        $id = Auth::guard('doctor')->id();
        $appointment = Appointment::where('doctor_id', $id)->get();
        return view('dentist.appointment.all', compact('appointment'));
    }
    public function search(Request $request)
    {
        $doctorId = Auth::guard('doctor')->id(); // Get the current doctor's ID
        $status = $request->input('status');

        $appointment = Appointment::where('doctor_id', $doctorId)
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->get();

        return view('dentist.appointment.all', compact('appointment'));
    }

    public function updateStatus(Request $request)
    {
        $appointment = Appointment::find($request->id);
        if ($appointment) {
            $appointment->status = $request->input('status');
            $appointment->save();

            // Send email to patient
            $email = $appointment->patient_email;
            $name = $appointment->patient_name;

            Mail::to($email)->send(new MailableName($appointment));

        } else {
            return response()->json(['error' => 'An error occurred. Please try again.'], 400);
        }
    }
}
