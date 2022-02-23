<?php

namespace App\Jobs;

use App\Mail\MailNotification;
use App\Models\Child;
use App\Models\MailHistory;
use App\Models\MailJobHistory;
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

    protected $mailJobHistory;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MailJobHistory $mailJobHistory) {
        //
        $this->mailJobHistory = $mailJobHistory;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $children_class_id = $this->mailJobHistory->children_class_id;
        $office_id = $this->mailJobHistory->office_id;
        $subject = $this->mailJobHistory->subject;
        $content = $this->mailJobHistory->content;
        //
        $qb = Child::where(['office_id' => $office_id]);
        if ($children_class_id)
        {
            $qb->where(['class_id' => $children_class_id]);
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
                'subject'       =>  $subject,
                'content'       =>  $content,
                'children_class_id'=> $children_class_id
            ]);
            $this->mailJobHistory->mails()->save($mailHistory);
            try {
                Mail::to($child->email)->send(new MailNotification($subject, $content));
                $mailHistory->status = MailHistory::STATUS_SUCCESS;
                $this->mailJobHistory->cnt++;
                $this->mailJobHistory->save();
            } catch (Exception $ex)
            {
                Log::info($ex->getMessage());
                $mailHistory->status = MailHistory::STATUS_FAILED;
            }
            $mailHistory->save();
        }
    }
}
