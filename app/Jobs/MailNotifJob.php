<?php

namespace App\Jobs;

use App\Mail\MailNotification;
use App\Models\Child;
use App\Models\MailHistory;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailNotifJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $subject;
    protected $content;
    protected $children_class_id;
    protected $type;
    protected $user_id;
    protected $office_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        $subject,
        $content,
        $children_class_id,
        $type,
        $user_id,
        $office_id
    ) {
        //
        $this->subject = $subject;
        $this->content = $content;
        $this->children_class_id = $children_class_id;
        $this->type = $type;
        $this->user_id = $user_id;
        $this->office_id = $office_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $qb = Child::where(['office_id' => $this->office_id]);
        if ($this->children_class_id)
        {
            $qb->where(['class_id' => $this->children_class_id]);
        }
        $children = $qb->get();
        foreach ($children as $child)
        {
            if (!$child->email)
            {
                continue;
            }
            $mailHistory = MailHistory::create([
                'mail_address'  =>  $child->email,
                'status'        =>  MailHistory::STATUS_PENDING,
                'subject'       =>  $this->subject,
                'content'       =>  $this->content,
                'children_class_id'=> $this->children_class_id
            ]);
            $mailHistory->save();
            try {
                Mail::to($child->email)->send(new MailNotification($this->subject, $this->content));
                $mailHistory->status = MailHistory::STATUS_SUCCESS;
            } catch (Exception $ex)
            {
                Log::info($ex->getMessage());
                $mailHistory->status = MailHistory::STATUS_FAILED;
            }
            $mailHistory->save();
        }
    }
}
