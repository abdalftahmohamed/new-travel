<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Models\SupscripeEmail;
use Exception;
use Illuminate\Http\Request;


class SubscriptionEmailController extends Controller
{

    use ImageTrait;

    public function index()
    {
        $subscriptionEmails = SupscripeEmail::get();
        return view('pages.subscriptionEmail.index', compact('subscriptionEmails'));
    }


    public function destroy(Request $request)
    {
        try {
            // Find the subscriptionEmail by ID
            $subscriptionEmail = SupscripeEmail::findOrFail($request->id);
            // Delete the subscriptionEmail
            $subscriptionEmail->delete();
//            session()->flash('message', 'subscriptionEmail Deleted Successfully');
            toastr()->error('subscriptionEmail Deleted Successfully');
            return redirect()->route('admin.subscriptionEmail.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
