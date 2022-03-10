<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\Attachment;
use App\Models\User;
use Illuminate\Support\Str;

class AttachmentService {
    public function createAttachmentFile($file, User $user, $fileName = false)
    {
        if (!$file)
        {
            return null;
        }
        if ($fileName === false)
        {
            $fileName = self::randomFileName($file);
        }
        $path = $file->storeAs('attachments', $fileName, 'public');
        $url = Storage::url($path);
        $attachment = new Attachment();
        $attachment->path = $path;
        $attachment->url = $url;
        $attachment->user_id = $user->id;
        return $attachment;
    }
    public static function randomFileName($file)
    {
        $extension = $file->getClientOriginalExtension();
        $now = new \DateTime();
        $rnd = Str::random(8);
        return $now->getTimestamp() . '_' . $rnd . '.' . ($extension ? $extension : 'dat');
    }
}
