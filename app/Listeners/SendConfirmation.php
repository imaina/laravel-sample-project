<?php

namespace App\Listeners;

use App\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;


class SendConfirmation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageSent  $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        //send message

        $contact_message = $event->message;

        Mail::send('email.contact-message-confirmation', ['contact_message' => $contact_message], function($m) use($contact_message){
            $m->from('info@blogs.com', 'Bloggers Chair');
            $m->to($contact_message->email, $contact_message->sender);
            $m->subject('we received your message');
        });
    }
}
