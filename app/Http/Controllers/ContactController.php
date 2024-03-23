<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Models\Contact;
use App\Models\Country;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PragmaRX\Countries\Package\Countries;


class ContactController extends Controller
{

    use ImageTrait;

    public function index()
    {
        $contacts = Contact::get();
        return view('pages.contact.index', compact('contacts'));
    }


    public function destroy(Request $request)
    {
        try {
            // Find the contact by ID
            $contact = Contact::findOrFail($request->id);
            // Delete the contact
            $contact->delete();
//            session()->flash('message', 'contact Deleted Successfully');
            toastr()->error('contact Deleted Successfully');
            return redirect()->route('admin.contact.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
