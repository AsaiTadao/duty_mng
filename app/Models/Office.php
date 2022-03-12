<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Office extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'number',
        'region_id',
        'industry_group_id',
        'office_group_id',
        'rest_deduction_id',
        'type'
    ];

    protected $appends = [
        'is_headquarter',
        'is_nursery'
    ];

    const TYPE_OTHERS = 1;
    const TYPE_NURSERY = 2;

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function group()
    {
        return $this->belongsTo(OfficeGroup::class, 'office_group_id', 'id');
    }

    public function getIsHeadquarterAttribute()
    {
        if (!$this->attributes['name']) return false;
        return Str::endsWith($this->attributes['name'], '本社');
    }

    public function getIsNurseryAttribute()
    {
        if (!$this->attributes['name']) return false;
        return $this->type === self::TYPE_NURSERY;
    }

    public function office_information()
    {
        return $this->hasOne(OfficeInformation::class);
    }

    public function getCapacityAttribute()
    {
        if ($this->office_information) return $this->office_information->capacity;
        return null;
    }

    public function getCertifTypeEnabledAttribute()
    {
        if ($this->office_information)
        {
            return $this->office_information->business_type_id === BusinessType::TYPE_2 || $this->office_information->business_type_id === BusinessType::TYPE_2;
        }
        return false;
    }
}
