<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
    $searchTerm = $request->input('search');

    if ($searchTerm) {
        $doctors = User::where('role', 'doctor')
            ->where('name', 'like', '%'. $searchTerm. '%')
            ->get();
    } else {
        $doctors = User::where('role', 'doctor')->get();
    }

    return view('admin.doctor.list', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctor.create');
    }

    public function updateRole(Request $request)
    {
        $doctor = User::find($request->id);
        if ($doctor) {
            $doctor->role = $request->role;
            $doctor->save();
            return response()->json(['message' => 'Role updated successfully.'], 200);
        } else {
            return response()->json(['message' => 'Patient not found.'], 404);
        }
    }

    public function createDoctor(Request $request){
        $validator = Validator::make($request->all(),[
            'name' =>'required|string|min:4|max:20',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:5|max:20',
        ]);
        if ($validator->passes()) {
            $doctor = new User();
            $doctor->name = $request->name;
            $doctor->email = $request->email;
            $doctor->password = Hash::make($request->password);
            $doctor->role = 'doctor';
            $doctor->save();

            return redirect()->route('doctor.create')->with('success','Doctor created successfully');
        }else{
            return redirect()->route('doctor.create')->withErrors($validator)->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $d = User::findOrFail($id);
        return view('admin.doctor.edit', compact('d'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'filled|string|min:4|max:20',
            'email' => 'filled|email',
            'number' => 'filled|numeric|max:99999999999'
        ]);

        if($validator->passes()){
            $d = User::find($id);
            $d->name = $request->name;
            $d->email = $request->email;
            $d->number = $request->number;
            $d->updated_at = time();
            $d->update();
            return redirect()->route('doctor.edit',$d->id)->with('success','Patient credentials changed successfully 🤩');
        }else{
            $d = User::find($id);
            return redirect()->route('doctor.edit',$d->id)->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $doctor)
    {
        // Delete the user
        $doctor->delete();

        // Redirect or return response as needed
        return redirect()->route('doctor.list')->with('success', 'User deleted successfully.');
    }

    public function show()
    {
        // Assuming the role is stored in a 'roles' table with a many-to-many relationship
        $doctors = User::where('role', 'doctor')->get();

        // If you have a view to display the users
        return view('admin.doctor.list', compact('doctors'));

        // If you just want to return the data as JSON
        // return response()->json($patients);
    }
}
