<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
    $searchTerm = $request->input('search');

    if ($searchTerm) {
        $patients = User::where('role', 'patient')
            ->where('name', 'like', '%'. $searchTerm. '%')
            ->get();
    } else {
        $patients = User::where('role', 'patient')->get();
    }

    return view('admin.patient.list', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function updateRole(Request $request)
    {
        $patient = User::find($request->id);
        if ($patient) {
            $patient->role = $request->role;
            $patient->save();
            return response()->json(['message' => 'Role updated successfully.'], 200);
        } else {
            return response()->json(['message' => 'Role updated successfully.'], 200);
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
        $p = User::findOrFail($id);
        return view('admin.patient.edit', compact('p'));
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
            $p = User::find($id);
            $p->name = $request->name;
            $p->email = $request->email;
            $p->number = $request->number;
            $p->updated_at = time();
            $p->update();
            return redirect()->route('patient.edit',$p->id)->with('success','Patient credentials changed successfully 🤩');
        }else{
            $p = User::find($id);
            return redirect()->route('patient.edit',$p->id)->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $patient)
    {
        // Delete the user
        $patient->delete();

        // Redirect or return response as needed
        return redirect()->route('patient.list')->with('success', 'User deleted successfully.');
    }

    public function show()
    {
        // Assuming the role is stored in a 'roles' table with a many-to-many relationship
        $patients = User::where('role', 'patient')->get();

        // If you have a view to display the users
        return view('admin.patient.list', compact('patients'));

        // If you just want to return the data as JSON
        // return response()->json($patients);
    }
}
