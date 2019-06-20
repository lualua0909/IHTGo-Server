<?php

namespace App\Models;

use App\Models\Data\District;
use App\Models\Data\Province;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
       'order_id', 'sender_name', 'sender_phone','sender_address', 'sender_date', 'receive_name', 'receive_phone',
        'receive_address', 'warehouse_id', 'receive_date', 'km', 'weight', 'sender_province_id', 'sender_district_id',
        'receive_province_id', 'receive_district_id', 'price_id', 'note', 'driver_note', 'take_money', 'admin_note'
    ];

    public $timestamps = false;

    public function getSenderDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function getReceiveDateAttribute($value)
    {
        if ($value){
            return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provinceSender()
    {
        return $this->belongsTo(Province::class, 'sender_province_id', 'province_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function districtSender()
    {
        return $this->belongsTo(District::class, 'sender_district_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provinceReceive()
    {
        return $this->belongsTo(Province::class, 'receive_province_id', 'province_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function districtReceive()
    {
        return $this->belongsTo(District::class, 'receive_district_id', 'id');
    }

    public function price()
    {
        return $this->belongsTo(ManagerPrice::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class)->select(['code', 'manager_id']);
    }
}
