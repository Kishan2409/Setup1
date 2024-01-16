<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public $module_name = 'Web Settings';

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
        $module_name = $this->module_name;

        $setting=Settings::first();

        if($request->hasFile("logo")){
            if (!Storage::exists(storage_path('app/public/logo'))) {
                Storage::disk('public')->makeDirectory('logo');
            }
            if (!empty($setting->logo)) {
                if (File::exists(storage_path('app/public/logo/' . $setting->logo))) {
                    File::delete(storage_path('app/public/logo/' . $setting->logo));
                }
            }
            $logo = rand (10000 , 99999) . "." . $request->file('logo')->getClientOriginalExtension();
            $logopath = $request->file('logo')->move('storage/app/public/logo', $logo);
        }
        else{
            $logo=$setting->logo;
        }

        if($request->hasFile("favicon")){
            if (!Storage::exists(storage_path('app/public/favicon'))) {
                Storage::disk('public')->makeDirectory('favicon');
            }
            if (!empty($setting->favicon)) {
                if (File::exists(storage_path('app/public/favicon/' . $setting->favicon))) {
                    File::delete(storage_path('app/public/favicon/' . $setting->favicon));
                }
            }
            $favicon = rand (10000 , 99999) . "." . $request->file('favicon')->getClientOriginalExtension();
            $faviconpath = $request->file('favicon')->move('storage/app/public/favicon', $favicon);
        }
        else{
            $favicon=$setting->favicon;
        }

        Settings::updateOrCreate(
            ['id' => 1],
            [
                'title'=>$request->title,
                'logo'=>$logo,
                'favicon'=>$favicon
            ]
        );

        return redirect('admin/setting#custom-tabs-four-setting')->with('success',$module_name.' Update Successfully !');

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
