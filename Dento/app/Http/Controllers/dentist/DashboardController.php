<?php

namespace App\Http\Controllers\dentist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $appointment = Appointment::where('doctor_id', Auth::guard('doctor')->id())->get();
        $all = $appointment->count();
        $pending = $appointment->where('status', 'pending')->count();
        $confirmed = $appointment->where('status', 'confirmed')->count();
        $cancelled = $appointment->where('status', 'cancelled')->count();

        return view('dentist.Dashboard', compact('appointment', 'pending', 'confirmed', 'cancelled', 'all'));
    }

    public function notify(){
        $id = Auth::guard('doctor')->id();

        if ($id) {
            $notification_count = Appointment::where('doctor_id', $id)->count();
            $notify = Appointment::where('doctor_id', $id)->get();
            return view('dentist.layouts.app', compact('notify', 'notification_count'));
        }
    }

    public function profile()
    {
        return view('dentist.profile');
    }
}
