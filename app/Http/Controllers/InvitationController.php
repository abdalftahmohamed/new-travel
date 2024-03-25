<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Mail\InvitationEmail;

use App\Models\File;
use App\Models\Invitation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use URL;


class InvitationController extends Controller
{

    use ImageTrait;

    public function index()
    {
        return view('pages.invitation.index');
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
            $attachmentUrls = [];

            // insert attachment
            if ($request->hasfile('attachment')) {
                foreach ($request->file('attachment') as $value) {
                    $file_path = $this->saveImage($value, 'attachments/files/'. $invitation->id);
                    // insert in InvoiceMedia
                    $image = new File();
                    $image->invitation_id = $invitation->id;
                    $image->file_path = $file_path;
                    $image->save();
                    $attachmentUrls[] = url::asset('attachments/files/'. $invitation->id.'/'.$file_path);
                }

            }

            // Extract data from the request
            $email = $validatedData['email'];
            $name = $validatedData['name'];
            $subject = $validatedData['subject'];
            $description = $validatedData['description'];


            Mail::to($email)->send(new InvitationEmail($subject,$name, $description, $attachmentUrls));

//            $data = [
//                'email' => $validatedData['email'],
//                'name' => $validatedData['name'],
//                'subject' => $validatedData['subject'],
//                'description' => $validatedData['description'],
//            ];
//
//            Mail::send('emails.myTestMail', $data, function ($message) use ($data, $attachmentUrls) {
//                $message->to($data['email'])
//                    ->subject($data['subject']);
//                foreach ($attachmentUrls as $file) {
//                    $message->attach($file);
//                }
//            });
            toastr()->success('Email Send Successfully');
            return redirect()->back()->with('message', 'Invitation email sent successfully!');
        }catch (\Exception $exception){
            toastr()->error('There Is A Error..!!');
            return $exception->getMessage();
        }

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
