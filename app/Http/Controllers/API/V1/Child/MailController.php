<?php

namespace App\Http\Controllers\API\V1\Child;

use App\Http\Controllers\API\V1\BaseController;
use App\Http\Requests\Child\MailRequest;
use App\Http\Requests\Child\MailTemplateQuery;
use App\Jobs\MailNotifJob;
use App\Models\MailHistory;
use Illuminate\Support\Facades\Storage;

class MailController extends BaseController
{
    public function dispatchMail(MailRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        MailNotifJob::dispatch($data['subject'], $data['content'], $data['children_class_id'], $data['type'], $user->id, $user->office_id);
        return $this->sendResponse();
    }

    public function getMailTemplate(MailTemplateQuery $request)
    {
        $data = $request->validated();
        $type = $data['type'];

        $content = Storage::get('mail_template/' .($type === MailHistory::TYPE_NORMAL ? 'normal' : 'urgent') . '.txt');
        return $this->sendResponse(['content' => $content]);
    }
}
