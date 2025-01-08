<?php

namespace App\Http\Controllers\Admin;

use App\Models\SettingsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SettingsController
{
    public function Settings(Request $request)
    {
        $setting = SettingsModel::first();
        return view('admin/settings/settings', compact('setting'));
    }

    public function update(Request $request, $setting_id)
    {
        $request->validate([
            'project_name' => 'nullable|string|max:255',
            'short_name' => 'nullable|string|max:255',
            'project_logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'login_bg' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = SettingsModel::findOrFail($setting_id);

        if ($request->has('project_name')) {
            $data->project_name = $request->project_name;
        }

        if ($request->has('short_name')) {
            $data->short_name = $request->short_name;
        }

        $storagePath = 'admin-assets/assets/img/settings/';

        if ($request->hasFile('project_logo')) {
            if (File::exists($data->project_logo)) {
                File::delete($data->project_logo);
            }

            $file1 = $request->file('project_logo');
            $filename1 = time() . '_' . Str::random(10) . '.' . $file1->getClientOriginalExtension();
            $file1->move($storagePath, $filename1);
            $data->project_logo = $storagePath . $filename1;
        }

        if ($request->hasFile('login_bg')) {
            if (File::exists($data->login_bg)) {
                File::delete($data->login_bg);
            }

            $file2 = $request->file('login_bg');
            $filename2 = time() . '_' . Str::random(10) . '.' . $file2->getClientOriginalExtension();
            $file2->move($storagePath, $filename2);
            $data->login_bg = $storagePath . $filename2;
        }

        $data->save();

        return redirect()->route('admin/settings')->with('success', 'Settings updated successfully.');
    }

}

