<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildcarePlan extends Model
{
    use HasFactory;

    const PLAN_UNREGISTERED = 0;
    const PLAN_REGISTERED = 1;
}
