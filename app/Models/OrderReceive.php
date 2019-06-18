<?php

namespace App\Models;

use App\Models\Data\District;
use App\Models\Data\Province;
use Illuminate\Database\Eloquent\Model;

class OrderReceive extends Model
{
    protected $fillable = [
        'name', 'phone', 'address', 'province_id', 'district_id', 'order_id'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
