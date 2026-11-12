<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\Employee;

class ProfileController extends Controller
{
    /**
     * Display employee profile.
     */
    public function index()
    {
        $user = Auth::user();

        $employee = Employee::with(['department', 'designation'])
            ->where('user_id', $user->id)
            ->first();

        return view('employee.profile', compact('user', 'employee'));
    }

    /**
     * Display profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();

        $employee = Employee::where('user_id', $user->id)
            ->first();

        return view('employee.profile.edit', compact('user', 'employee'));
    }

    /**
     * Update employee profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $employee = Employee::where('user_id', $user->id)
            ->first();

        // Do not return a generic 404 when the employee record is missing.
        if (!$employee) {
            return redirect()
                ->route('employee.profile.edit')
                ->withErrors([
                    'profile' => 'Your employee record is not linked to your account. Please contact the administrator.',
                ]);
        }

        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'date_of_birth' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        // Ensure the upload directory exists.
        $uploadPath = public_path('uploads/employees');

        if ($request->hasFile('image')) {
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $image = $request->file('image');
            $imageName = uniqid('employee_', true) . '.' . $image->extension();

            // Store the new image first.
            $image->move($uploadPath, $imageName);

            // Delete the previous image only after the new upload succeeds.
            if (
                $employee->image &&
                File::exists($uploadPath . DIRECTORY_SEPARATOR . $employee->image)
            ) {
                File::delete($uploadPath . DIRECTORY_SEPARATOR . $employee->image);
            }

            $employee->image = $imageName;
        }

        $employee->phone = $validated['phone'];
        $employee->address = $validated['address'];
        $employee->date_of_birth = $validated['date_of_birth'] ?? null;

        $employee->save();

        return redirect()
            ->route('employee.profile')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Display change-password form.
     */
    public function editPassword()
    {
        return view('employee.change-password');
    }

    /**
     * Update employee password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();

        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()
            ->route('employee.password.edit')
            ->with('success', 'Password changed successfully.');
    }
}
