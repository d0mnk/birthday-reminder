<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $this->authorize('viewAny', Contact::class);

        $contacts = DB::table('contacts')
            ->selectRaw("*, month(birthday), if(month(birthday)>month(now()), month(birthday), month(birthday)+12) ord")
            ->where('user_id', auth()->user()->id)
            ->orderByRaw("ord")
            ->get();

        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $this->authorize('create', Contact::class);
        $contact = new Contact();
        return view('contact.edit', compact('contact'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Redirector|RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create', Contact::class);
        $contact = new Contact($this->validateContact());
        $contact->user_id = auth()->user()->id;
        $contact->save();

        $request->session()->flash('type', 'success');
        $request->session()->flash('message', "{$contact->firstname} {$contact->lastname} has been saved.");
        return redirect(route('contact.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Contact $contact
     * @return Application|Factory|View
     */
    public function edit(Contact $contact)
    {
        $this->authorize('update', $contact);
        return view('contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Contact $contact
     * @return Redirector|RedirectResponse
     */
    public function update(Request $request, Contact $contact)
    {
        $this->authorize('update', $contact);
        $validatedAttributes = $this->validateContact();
        $contact->update($validatedAttributes);


        $request->session()->flash('type', 'success');
        $request->session()->flash('message', "{$contact->firstname} {$contact->lastname} has been updated.");
        return redirect(route('contact.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contact $contact
     * @return Redirector|RedirectResponse
     */
    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);
        $contact->delete();

        return redirect(route('contact.index'));
    }


    protected function validateContact(): array {
        return \request()->validate([
            'firstname' => ['required', 'min:3', 'max:255'],
            'lastname' => ['required', 'min:3', 'max:255'],
            'birthday' => ['required', 'date']
        ]);
    }
}
