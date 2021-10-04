<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::orderBy('name')->paginate(8);
        return Inertia::render('Settings/Index', [
            'settings' => $settings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Settings/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Setting::create($request->validate([
                'name' => 'required|string|max:255',
                'value' => 'required|string|max:255',
            ])
        );

        return Redirect::route('settings')->with('success', 'Parametre créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return Inertia::render('Settings/Edit', [
            'setting' => [
                'id' => $setting->id,
                'name' => $setting->name,
                'value' => $setting->value,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'name' => 'required|unique:services,name|max:255',
            'value' => 'required|max:255',
        ]);

        $setting->update([
            'name' => $request->name,
            'value' => $request->value,
        ]);

        return Redirect::back()->with('success', 'Paramètre modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return Redirect::back()->with('success', 'Paramètre supprimé avec succès.');
    }
}
