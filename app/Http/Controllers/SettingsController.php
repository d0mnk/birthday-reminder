<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Contact $contact
     * @return View
     */
    public function edit()
    {
        return view('settings.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return View
     */
    public function update(Request $request)
    {
        $current_user = auth()->user();
        $current_user->update(\request()->validate([
            'pushover_key' => ['min:3', 'max:255', 'nullable']
        ]));
        $current_user->save();
        $request->session()->flash('type', 'success');
        $request->session()->flash('message', 'Your changes have been saved.');
        return view('settings.edit');
    }
}
