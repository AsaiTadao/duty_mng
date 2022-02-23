<?php

namespace App\Http\Controllers\API\V1\Child;

use App\Http\Controllers\API\V1\BaseController;
use App\Http\Requests\Child\MailJobQuery;
use App\Http\Requests\Child\MailRequest;
use App\Http\Requests\Child\MailTemplateQuery;
use App\Jobs\MailNotifJob;
use App\Models\MailHistory;
use App\Models\MailJobHistory;
use Illuminate\Support\Facades\Storage;

class MailController extends BaseController
{
    public function dispatchMail(MailRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $mailJobHistory = new MailJobHistory($data);
        $mailJobHistory->user_id = $user->id;
        $mailJobHistory->office_id = $user->office_id;
        $mailJobHistory->save();
        MailNotifJob::dispatch($mailJobHistory);
        return $this->sendResponse();
    }

    public function getMailTemplate(MailTemplateQuery $request)
    {
        $data = $request->validated();
        $type = $data['type'];

        $content = Storage::get('mail_template/' .($type === MailHistory::TYPE_NORMAL ? 'normal' : 'urgent') . '.txt');
        return $this->sendResponse(['content' => $content]);
    }

    public function listMailJob(MailJobQuery $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        if (empty($data['per_page']))
        {
            $size = 20;
        } else {
            $size = $data['per_page'];
        }
        $mails = MailJobHistory::with('office')->where(['office_id' => $user->office_id])->paginate($size);
        return $this->sendResponse([
            'data'  =>  $mails->items(),
            'total' =>  $mails->total(),
            'per_page'  =>  $mails->perPage(),
            'current_page'  =>  $mails->currentPage()
        ]);
    }
}
