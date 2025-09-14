<?php

namespace App\Mail;

use App\Models\PageInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailSendCode extends Mailable
{
    use Queueable, SerializesModels;

    public $data = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pageInfo = PageInfo::first();
        return $this->from($pageInfo->email_setup, $pageInfo->name)
            ->view('emails.send-code')
            ->subject('Xác thực tài khoản')
            ->with('data', $this->data);
    }
}
