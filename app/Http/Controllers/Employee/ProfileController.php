<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;



class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $employee = Employee::with(['department', 'designation'])
            ->where('user_id', $user->id)
            ->first();

        return view('employee.profile', compact('user', 'employee'));
    }

    public function edit()
    {
        $user = Auth::user();

        $employee = Employee::where('user_id', $user->id)->first();

        return view('employee.profile.edit', compact('user', 'employee'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $employee = Employee::where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'phone' => 'required|max:20',
            'address' => 'required|max:500',
            'date_of_birth' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($employee->image && file_exists(public_path('uploads/employees/' . $employee->image))) {

                unlink(public_path('uploads/employees/' . $employee->image));

            }

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('uploads/employees'), $imageName);

            $employee->image = $imageName;
        }

        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->date_of_birth = $request->date_of_birth;

        $employee->save();

        return redirect()
            ->route('employee.profile')
            ->with('success', 'Profile Updated Successfully.');
    }

    public function editPassword()
{
    return view('employee.change-password');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required'],
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {

        return back()->withErrors([
            'current_password' => 'Current password is incorrect.',
        ]);

    }

    $user->password = Hash::make($request->password);

    $user->save();

    return redirect()
        ->route('employee.password.edit')
        ->with('success', 'Password changed successfully.');
}
    
}