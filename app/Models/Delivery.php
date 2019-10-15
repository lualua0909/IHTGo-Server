<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Delivery extends Model
{
    protected $fillable = [
        'order_id', 'user_id', 'driver_id', 'car_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id')->select('name', 'number', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('name', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detail()
    {
        return $this->hasOne(OrderDelivery::class);
    }
    public static function getByID($id)
    {
        $data=DB::table('order_prepare as op')->where('op.order_id',$id)
        ->leftJoin('users as u','u.id','=','op.user_id')
        ->join('drivers as d','d.id','=','op.driver_id')
        ->join('users as u2','u2.id','=','d.user_id')
        ->leftJoin('users as u3','u3.id','=','op.user_cancel_id')
        ->select('op.*','u.name as user_name','u2.name as driver_name','u3.name as user_cancel_name')
        ->orderBy('op.id','desc')
        ->get();
        return $data;
    }
    public static function checkReceiverDriver($id)
    {
        $data=DB::table('order_prepare')->where('order_id',$id)->where('canceled_at',null)->first();
        return $data;
    }
}
