<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Child extends Model
{
    use HasFactory;
    use SoftDeletes, HasApiTokens;

    protected $fillable = [
        'name',
        'number',
        'password',
        'email',
        'office_id',
        'enrollment_class',
        'qr',
        'gender',
        'birthday',
        'class_id',
        'admission_date',
        'exit_date',
    ];
}
