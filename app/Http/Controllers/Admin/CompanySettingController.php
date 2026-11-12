<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class CompanySettingController extends Controller
{
    public function index()
    {
        $company = CompanySetting::first();

        return view('admin.company-settings.index', compact('company'));
    }

  public function create()
{
    if (CompanySetting::exists()) {

        return redirect()
            ->route('company-settings.index')
            ->with('error', 'Company Settings already exist.');

    }

    return view('admin.company-settings.create');
}

    public function store(Request $request)
    {
        if (CompanySetting::exists()) {

    return redirect()
        ->route('company-settings.index')
        ->with('error', 'Company Settings already exist.');

}
        $request->validate([
            'company_name' => 'required|max:255',
            'email'        => 'nullable|email',
            'phone'        => 'nullable|max:20',
            'website'      => 'nullable|max:255',
            'address'      => 'nullable',
            'footer_text'  => 'nullable|max:255',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $logo = null;

        if ($request->hasFile('logo')) {

            $logo = time().'_'.$request->logo->getClientOriginalName();

            $request->logo->move(
                public_path('uploads/company'),
                $logo
            );
        }

        CompanySetting::create([

            'company_name' => $request->company_name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'website'      => $request->website,
            'address'      => $request->address,
            'footer_text'  => $request->footer_text,
            'logo'         => $logo,

        ]);

        return redirect()
            ->route('company-settings.index')
            ->with('success', 'Company Settings Saved Successfully.');
    }

    public function edit($id)
    {
        $company = CompanySetting::findOrFail($id);

        return view('admin.company-settings.edit', compact('company'));
    }

    public function update(Request $request, CompanySetting $company_setting)
    {
        $request->validate([
            'company_name' => 'required|max:255',
            'email'        => 'nullable|email',
            'phone'        => 'nullable|max:20',
            'website'      => 'nullable|max:255',
            'address'      => 'nullable',
            'footer_text'  => 'nullable|max:255',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $logo = $company_setting->logo;

        if ($request->hasFile('logo')) {

            if ($logo && file_exists(public_path('uploads/company/'.$logo))) {
                unlink(public_path('uploads/company/'.$logo));
            }

            $logo = time().'_'.$request->logo->getClientOriginalName();

            $request->logo->move(
                public_path('uploads/company'),
                $logo
            );
        }

        $company_setting->update([

            'company_name' => $request->company_name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'website'      => $request->website,
            'address'      => $request->address,
            'footer_text'  => $request->footer_text,
            'logo'         => $logo,

        ]);

        return redirect()
            ->route('company-settings.index')
            ->with('success', 'Company Settings Updated Successfully.');
    }
}