<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Child extends Authenticatable
{
    use HasFactory;
    use SoftDeletes, HasApiTokens;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function child_info()
    {
        return $this->hasOne(ChildInformation::class, 'child_id', 'id');
    }
}
