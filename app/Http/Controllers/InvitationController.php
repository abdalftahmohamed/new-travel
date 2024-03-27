<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Mail\InvitationEmail;

use App\Models\File;
use App\Models\Invitation;
use App\Notifications\InviteClientNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use URL;


class InvitationController extends Controller
{

    use ImageTrait;

    public function index()
    {
        $invitations = Invitation::get();
        return view('pages.invitation.index',compact('invitations'));
    }
    public function create()
    {
        return view('pages.invitation.create');
    }

    public function send(Request $request)
    {
        try {
            $validatedData1 = $request->validate([
                'attachment.*' => 'nullable|file|max:32768', // max 32MB
            ]);
            $validatedData = $request->validate([
                'email' => 'required|email',
                'name' => 'required|string',
                'subject' => 'required|string',
                'description' => 'required|string',
            ]);

            $invitation =Invitation::create($validatedData);

            // insert attachment
            if ($request->hasfile('attachment')) {
                foreach ($request->file('attachment') as $value) {
                    $file_path = $this->saveImage($value, 'attachments/files/'. $invitation->id);
                    // insert in InvoiceMedia
                    $image = new File();
                    $image->invitation_id = $invitation->id;
                    $image->file_path = $file_path;
                    $image->save();
                }
            }

            $invitation->notify(new InviteClientNotification($invitation));

//            if ($request->hasfile('attachment')) {
//              $this->deleteFile('files',$invitation->id);
//            }
//            $invitation->delete();

            toastr()->success('Email Send Successfully');
            return redirect()->route('admin.invitation.index')->with('message', 'Invitation email sent successfully!');
        }catch (\Exception $exception){
            toastr()->error('There Is A Error..!!');
            return $exception->getMessage();
        }

    }







    public function destroy(Request $request)
    {
        try {
            // Find the invitation by ID
            $invitation = Invitation::findOrFail($request->id);
            $this->deleteFile('files',$request->id);
            // Delete the invitation
            $invitation->delete();
//            session()->flash('message', 'invitation Deleted Successfully');
            toastr()->error('invitation Deleted Successfully');
            return redirect()->route('admin.invitation.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
