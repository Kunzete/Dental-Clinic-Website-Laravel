<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminDashboardController extends Controller
{
    public function profile(){
        return view('admin.profile');
    }
    public function search(Request $request)
    {
    $searchTerm = $request->input('search');

    if ($searchTerm) {
        $admins = User::where('role', 'admin')
            ->where('name', 'like', '%'. $searchTerm. '%')
            ->get();
    } else {
        $admins = User::where('role', 'admin')->get();
    }

    return view('admin.admin', compact('admins'));
    }

    public function list(){
        $admins = User::where('role', 'admin')->get();

        return view('admin.admin', compact('admins'));
    }

    public function createService(){
        return view('admin.CreateService');
    }

    public function postService(Request $request){
        $validator = Validator::make($request->all(),[
            "name"=>"required|string",
            "stage"=>"required|string|max:12",
            "price"=>"required|decimal:0,10"
        ]);

        if($validator->passes()){
            $table = new ServiceTable();
            $table->name = $request->input('name');
            $table->stage = $request->input('stage');
            $table->price = $request->input('price');
            $table->save();
            return redirect()->route('service.create')->with('success','Service created successfully');
        }
        return redirect()->route('service.create')->withErrors($validator)->withInput();
    }

    public function listService(){
        $service = ServiceTable::all();

        return view('admin.ListService', compact('service'));
    }

    public function Info(){
        $users = User::all()->count();
        $admins = User::where('role', 'admin')->count();
        $doctors = User::where('role', 'doctor')->count();
        $patients = User::where('role', 'patient')->count();
        $services = ServiceTable::all()->count();

        return view('admin.Dashboard', compact('users','admins','doctors','patients', 'services'));
    }
}
