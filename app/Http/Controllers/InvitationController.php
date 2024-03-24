<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;



class InvitationController extends Controller
{

    use ImageTrait;

    public function index()
    {
        return view('pages.invitation.index');
    }


//    public function destroy(Request $request)
//    {
//        try {
//            // Find the invitation by ID
//            $invitation = SupscripeEmail::findOrFail($request->id);
//            // Delete the invitation
//            $invitation->delete();
////            session()->flash('message', 'invitation Deleted Successfully');
//            toastr()->error('invitation Deleted Successfully');
//            return redirect()->route('admin.invitation.index');
//        } catch (Exception $e) {
//            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
//        }
//    }

}
