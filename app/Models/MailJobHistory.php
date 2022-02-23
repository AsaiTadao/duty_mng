<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailJobHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'content',
        'children_class_id',
        'type',
        'cnt'
    ];

    protected $appends = ['office_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mails()
    {
        return $this->hasMany(MailHistory::class);
    }
    public function office()
    {
        return $this->belongsTo(Office::class);
    }
    public function getOfficeNameAttribute()
    {
        if ($this->office) return $this->office->name;
        return '';
    }
}
