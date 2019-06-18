<?php

namespace App\Models;

use App\Helpers\Business;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Driver extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'lat', 'lng', 'available', 'identification', 'date', 'experience', 'current_address', 'warehouse_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function delivery()
    {
        return $this->hasOne(Delivery::class, 'driver_id', 'id');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function rateDriver($id)
    {
        return DB::table('evaluates')->where(['type' => Business::EVALUATE_TYPE_DRIVE, 'to_id' => $id])->select('rate')->avg('rate');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class)->select(['code', 'manager_id']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function car()
    {
        return $this->hasOne(Car::class, 'owner_id', 'id');
    }
}
