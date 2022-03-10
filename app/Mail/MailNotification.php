<?php

namespace App\Mail;

use App\Services\QrService;
use App\Models\Child;
use App\Models\MailJobHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;
    public $child;
    public $qrService;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MailJobHistory $mail, Child $child, QrService $qrService)
    {
        //
        $this->mail = $mail;
        $this->child = $child;
        $this->qrService = $qrService;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $res = $this->subject($this->mail->subject);

        $content = $this->mail->content;
        if (Str::contains($content, '{{ children.qr }}'))
        {
            $qrUrl = $this->qrService->getChildQrImageUri($this->child);

            $imgStr = "<br /><img src='{$qrUrl}' /><br />";
            $content = Str::replace('{{ children.qr }}', $imgStr, $content);
        }
        $res->view('mail.mail_notification', ['content' => $content]);
        for ($i = 1; $i <= 10; $i++)
        {
            $file = 'file' . $i;
            if ($this->mail->$file)
            {
                $res->attachFromStorage($this->mail->$file->path);
            }
        }
        return $res;
    }
}
