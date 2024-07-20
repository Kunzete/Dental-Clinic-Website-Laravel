<?php

namespace App\Http\Controllers\dentist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DentistProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'filled|string|min:4|max:20',
            'email' => 'filled|email',
            'number' => 'filled|max:11'
        ]);

        if($validator->passes()){

            $user = Auth::guard('doctor')->user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->number = $request->number;
            $user->update();
            return redirect()->route('dentist.profile')->with('success','You have registered successfully :)');
        }else{
            return redirect()->route('dentist.profile')->withErrors($validator)->withInput();
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'currentPassword' => 'required',
            'password' => 'filled|confirmed|min:5|max:20',
            'password_confirmation' => 'filled|string|min:5|max:20'
        ]);

        if ($validator->passes()) {
            $user = Auth::guard('doctor')->user();

            if (Hash::check($request->currentPassword, $user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->route('dentist.profile')->with('success', 'Your password has been updated successfully!');
            } else {
                return redirect()->route('dentist.profile')->withErrors(['currentPassword' => 'The current password is incorrect'])->withInput();
            }
        } else {
            return redirect()->route('dentist.profile')->withErrors($validator)->withInput();
        }
    }

    public function updatePFP(Request $request)
{
    $validator = Validator::make($request->all(), [
        'image' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($validator->passes()) {
        $user = Auth::guard('doctor')->user();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time(). '.'. $image->getClientOriginalExtension();
            $image->move(public_path('images/profile'), $imageName);
            $user->image = $imageName;
        }

        $user->save();

        return redirect()->route('dentist.profile')->with('success', 'Your profile has been updated successfully!');
    } else {
        return redirect()->route('dentist.profile')->withErrors($validator)->withInput();
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroyPFP()
    {
        $user = Auth::guard('doctor')->user();
        $user->image = null;
        $user->save();
        return redirect()->route('dentist.profile')->with('success', 'Your profile has been updated successfully!');
    }
}
