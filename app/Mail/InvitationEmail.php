<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $name;
    public $description;
    public $attachmentUrls;

    /**
     * Create a new message instance.
     */
    public function __construct($subject,$name, $description, $attachmentUrls)
    {
        $this->subject = $subject;
        $this->name = $name;
        $this->description = $description;
        $this->attachmentUrls = $attachmentUrls;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.invitation',
            with: [
                'name' => $this->name,
                'description' => $this->description,
                'attachmentUrls' => $this->attachmentUrls,
            ],

        );
    }



//     /**
//     * Get the attachments for the message.
//     *
//     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
//     */
//    public function attachments(): array
//    {
//        if ($this->attachmentUrls) {
//            foreach ($this->attachmentUrls as $attachment) {
//                return [
//                    Attachment::fromPath($attachment),
//                ];
//            }
//        }
//
//        return [];
//    }





//    public function build()
//    {
//        $email = $this->subject($this->subject)
//            ->view('emails.invitation')
//            ->with([
//                'name' => $this->name,
//                'description' => $this->description,
//            ]);
//
//        foreach ($this->attachment as $attachment) {
//            $email->attachFromStorage($attachment);
//        }
//
//        return $email;
//    }


//    /**
//     * Get the attachments for the message.
//     *
//     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
//     */
//    public function attachments(): array
//    {
//        if ($this->attachmentUrls) {
//            foreach ($this->attachmentUrls as $attachment) {
//                return [
//                    Attachment::fromPath($attachment),
//                ];
//            }
//        }
//
//        return [];
//    }



}
