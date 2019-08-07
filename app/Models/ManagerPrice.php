<?php

namespace App\Models;

use App\Helpers\Business;
use App\Models\Data\District;
use App\Models\Data\Province;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ManagerPrice extends Model
{
    protected $fillable = [
        'option', 'type', 'min', 'min_value', 'user_id', 'increase', 'increase_value', 'publish', 'type_car', 'note',
        'from', 'to', 'time_sende', 'time_receive', 'address_payment', 'address_receive'
    ];

//    protected $casts = [
//      'advance' => 'array'
//    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublish($query)
    {
        return $query->where('publish', Business::PUBLISH);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'id']);
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'to', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'from', 'province_id');
    }

    public function fromProvince()
    {
        return $this->belongsTo(Province::class, 'from', 'province_id');
    }

    public function toProvince()
    {
        return $this->belongsTo(Province::class, 'to', 'province_id');
    }
}
