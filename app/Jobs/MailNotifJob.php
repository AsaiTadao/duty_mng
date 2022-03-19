<?php

namespace App\Jobs;

use App\Services\QrService;
use App\Services\UtilService;
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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

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
    public function handle(QrService $qrService, UtilService $utilService)
    {
        $children_class_id = $this->mailJobHistory->children_class_id;
        $office_id = $this->mailJobHistory->office_id;
        $subject = $this->mailJobHistory->subject;
        //
        $qb = Child::where(['office_id' => $office_id])
            ->where(function ($query) {
                $query->whereNull('exit_date')
                    ->orWhere('exit_date', '>', Carbon::now());
            });;
        if ($children_class_id)
        {
            $qb->where(['class_id' => $children_class_id]);
        }
        if ($this->mailJobHistory->child_id)
        {
            $qb->where(['id' => $this->mailJobHistory->child_id]);
        }

        $children = $qb->get();
        foreach ($children as $child)
        {
            if (!$child->email)
            {
                continue;
            }

            $content = nl2br($utilService->bladeCompile($this->mailJobHistory->content, [
                'children_qr'   =>  $qrService->getChildQrImageTag($child),
                'password'      =>  Crypt::decryptString($child->password),
                'login_id'       =>  $child->email,
                'office_name'   =>  $child->office->name,
                'child_name'    =>  $child->name,
                'office'        =>  $child->office
            ]));

            $mailHistory = MailHistory::create([
                'mail_address'  =>  $child->email,
                'status'        =>  MailHistory::STATUS_PENDING,
                'subject'       =>  $subject,
                'content'       =>  $content,
                'children_class_id'=> $children_class_id,
                'child_id'      =>  $child->id
            ]);
            $this->mailJobHistory->mails()->save($mailHistory);
            try {
                Mail::to($child->email)->send(new MailNotification($this->mailJobHistory, $child, $content));
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
