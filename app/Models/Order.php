<?php

namespace App\Models;

use App\Helpers\Business;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Double;

class Order extends BaseModel
{

    public static function getListNew()
    {
        $orders = DB::table('orders as o')
            ->select(
                "o.*",
                "u.name as user_name",
                "c.id as customer_id",
                'od.sender_address',
                'od.receive_address',
                DB::raw("(select p.name FROM provinces p WHERE p.province_id=od.sender_province_id) as sender_province_name"),
                DB::raw("(SELECT p.name FROM provinces p WHERE p.province_id=od.receive_province_id) as receive_province_name"),
                DB::raw("(SELECT d.name FROM districts d WHERE d.id=od.sender_district_id) as sender_district_name"),
                DB::raw("(SELECT d.name FROM districts d WHERE d.id=od.receive_district_id) as receive_district_name")
            )
            ->join('order_details as od', 'od.order_id', '=', 'o.id')
            ->join('users as u', 'u.id', '=', 'o.user_id')
            ->join('customers as c', 'c.user_id', '=', 'u.id')
            ->orderBy('o.id', 'DESC')
            ->paginate(20);
        return $orders;
    }
    //search theo trang thai & phuong thuc thanh toan
    public static function postOptionListNew($status, $payment_type)
    {
        $orders = DB::table('orders as o')
            ->select(
                "o.*",
                "u.name as user_name",
                "c.id as customer_id",
                DB::raw("(select p.name FROM provinces p WHERE p.province_id=od.sender_province_id) as sender_province_name"),
                DB::raw("(SELECT p.name FROM provinces p WHERE p.province_id=od.receive_province_id) as receive_province_name"),
                DB::raw("(SELECT d.name FROM districts d WHERE d.id=od.sender_district_id) as sender_district_name"),
                DB::raw("(SELECT d.name FROM districts d WHERE d.id=od.receive_district_id) as receive_district_name")
            )
            ->join('order_details as od', 'od.order_id', '=', 'o.id')
            ->join('users as u', 'u.id', '=', 'o.user_id')
            ->join('customers as c', 'c.user_id', '=', 'u.id')->orderBy('o.id', 'DESC');

        if ($status != 0) {
            $orders = $orders->where('o.status', $status);
        }
        if ($payment_type != 0) {
            $orders = $orders->where('o.payment_type', $payment_type);
        }

        return $orders->orderBy('o.id', 'desc')->paginate(20);
    }
    //search theo ten kh, ten don hang, coupon_code, sdt
    public static function postSearchListNew($search)
    {
        $orders = DB::table('orders as o')
            ->select(
                "o.*",
                "u.name as user_name",
                "c.id as customer_id",
                DB::raw("(select p.name FROM provinces p WHERE p.province_id=od.sender_province_id) as sender_province_name"),
                DB::raw("(SELECT p.name FROM provinces p WHERE p.province_id=od.receive_province_id) as receive_province_name"),
                DB::raw("(SELECT d.name FROM districts d WHERE d.id=od.sender_district_id) as sender_district_name"),
                DB::raw("(SELECT d.name FROM districts d WHERE d.id=od.receive_district_id) as receive_district_name")
            )
            ->join('order_details as od', 'od.order_id', '=', 'o.id')
            ->join('users as u', 'u.id', '=', 'o.user_id')
            ->join('customers as c', 'c.user_id', '=', 'u.id')
            ->where('o.coupon_code', 'LIKE', '%' .  $search . '%')
            ->orWhere('o.name', 'LIKE', '%' .  $search . '%')
            ->orWhere('od.sender_name', 'LIKE', '%' .  $search . '%')
            ->orWhere('od.sender_phone', 'LIKE', '%' .  $search . '%')
            ->orWhere('od.receive_name', 'LIKE', '%' .  $search . '%')
            ->orWhere('od.receive_phone', 'LIKE', '%' .  $search . '%')
            ->orderBy('o.id', 'desc')->paginate(20);
        return $orders;
    }

    //search theo ngay
    public static function postSearchDate($start_date, $end_date)
    {

        $start = ($start_date) ? Carbon::createFromFormat('d/m/Y', $start_date)->format('Y-m-d') : Carbon::now()->subMonth()->startOfMonth();

        $end = ($end_date) ? Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d') : Carbon::now()->subMonth()->endOfMonth()->addDay();
        $orders = DB::table('orders as o')
            ->select(
                "o.*",
                "u.name as user_name",
                "c.id as customer_id",
                DB::raw("(select p.name FROM provinces p WHERE p.province_id=od.sender_province_id) as sender_province_name"),
                DB::raw("(SELECT p.name FROM provinces p WHERE p.province_id=od.receive_province_id) as receive_province_name"),
                DB::raw("(SELECT d.name FROM districts d WHERE d.id=od.sender_district_id) as sender_district_name"),
                DB::raw("(SELECT d.name FROM districts d WHERE d.id=od.receive_district_id) as receive_district_name")
            )
            ->join('order_details as od', 'od.order_id', '=', 'o.id')
            ->join('users as u', 'u.id', '=', 'o.user_id')
            ->join('customers as c', 'c.user_id', '=', 'u.id')
            ->whereBetween('o.created_at', [$start . ' 00:00:00', $end . ' 23:59:59'])
            ->orderBy('o.id', 'desc')->paginate(20);
        return $orders;
    }

    protected $fillable = [
        'code', 'name', 'car_type', 'total_price', 'payment_type', 'user_id', 'status', 'is_payment', 'car_option',
        'is_admin', 'coupon_code', 'payer', 'is_speed',
    ];

    public function setIsPaymentAttribute($value)
    {
        $this->attributes['is_payment'] = $value ? $value : 0;
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($order) {
            $order->code = static::generateOrderCode();
        });
    }

    /**
     * @return string
     */
    public static function generateOrderCode()
    {
        $countRecordToday = Order::whereDate('created_at', Carbon::now()->toDateString())->count();
        $countRecordToday = (int) $countRecordToday + 1;
        do {
            $orderCode = sprintf("IHT%s%'.03d", date('Ymd'), $countRecordToday);
            $countRecordToday++;
        } while (Order::where('code', $orderCode)->first());
        return $orderCode;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detail()
    {
        return $this->hasOne(OrderDetail::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class, 'service_id', 'id')->where(['type' => Business::IMAGE_UPLOAD_TYPE_ORDER])->select(['id', 'type']);
    }

    /**
     * @param $orderID
     * @return mixed
     */
    public static function driverDevice($orderID)
    {
        $token = DB::table('deliveries as d')
            ->join('drivers as dr', 'dr.id', '=', 'd.driver_id')
            ->join('devices as de', 'de.user_id', '=', 'dr.user_id')
            ->where(['d.order_id' => $orderID])
            ->first();
        return $token->fcm;
    }

    public static function findFCMByDelivery($deliveryID)
    {
        $token = DB::table('deliveries as d')
            ->join('drivers as dr', 'dr.id', '=', 'd.driver_id')
            ->join('devices as de', 'de.user_id', '=', 'dr.user_id')
            ->where(['d.id' => $deliveryID])
            ->first();
        return $token;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function route()
    {
        return $this->hasMany(OrderDelivery::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receive()
    {
        return $this->hasMany(OrderReceive::class);
    }
    //raymond---lịch sử thông tin người gửi/nhận
    public static function loadInfoSender($request)
    {
        $user_id = Auth::user();

        $search = $request->get('term');
        $res = DB::table(config('constants.ORDER_DETAIL_TABLE'))
            ->select([DB::RAW('DISTINCT(sender_name)'), 'sender_phone', 'sender_address', 'sender_province_id', 'sender_district_id'])
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('order_details.sender_name', 'LIKE', '%' . $search . '%')
            ->where('orders.user_id', $user_id)->distinct()->get();


        return response()->json($res);
    }
    public static function loadInfoReceive($request)
    {
        $user_id = Auth::user()->id;
        $search = $request->get('term');
        $res = DB::table(config('constants.ORDER_DETAIL_TABLE'))
            ->select('receive_name', 'receive_phone', 'receive_address', 'receive_province_id', 'receive_district_id')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('order_details.receive_name', 'LIKE', '%' . $search . '%')
            ->where('orders.user_id', $user_id)->orderBy('orders.id', 'desc')->distinct()->get();
        return response()->json($res);
    }
    //raymond
    public static function getOrderPaymentDetail($id)
    {
        $res = DB::table('orders as o')
            ->join('order_detail_ext as ode', 'ode.order_id', '=', 'o.id')
            ->where('o.id', $id)
            ->select('ode.*')
            ->first();
        return $res;
    }
    public static function calculatePayment($request)
    {
        dd($request->start_time_inventory, $request->finish_time_inventory);
        $total_price = self::payment($request);


        DB::table('order_details')
            ->where('order_id', $request->id)
            ->update(
                [
                    'length' => ($request->length == null || $request->length == 0) ? 1 : $request->length,
                    'width' => ($request->width == null || $request->width == 0) ? 1 : $request->width,
                    'height' => ($request->height == null || $request->height == 0) ? 1 : $request->height,
                    'weight' => ($request->weight == null || $request->weight == 0) ? 1 : $request->weight,
                ]
            );
        DB::table('orders')
            ->where('id', $request->id)
            ->update([
                'total_price' => $total_price,
                'is_speed' => $request->is_speed != null ? $request->is_speed : 0,
                'car_option' => $request->car_option,
            ]);
        $order_detail_ext = DB::table('order_detail_ext')
            ->where('order_id', $request->id)
            ->first();
        if ($order_detail_ext == null) {
            DB::table('order_detail_ext')
                ->where('order_id', $request->id)
                ->insert(
                    [
                        'order_id' => $request->id,
                        'distance' => ($request->distance == null || $request->distance == 0) ? 1 : $request->distance,
                        'hand_on' => ($request->hand_on == null || $request->hand_on == '') ? 0 : $request->hand_on,
                        'discharge' => ($request->discharge == null || $request->discharge == '') ? 0 : $request->discharge,
                        'start_time_inventory' => $request->start_time_inventory == '' ? null : $request->start_time_inventory,
                        'finish_time_inventory' => $request->finish_time_inventory == '' ? null : $request->finish_time_inventory,
                        'created_at' => \Carbon\Carbon::now(),
                    ]
                );
        } else {
            DB::table('order_detail_ext')
                ->where('order_id', $request->id)
                ->update(
                    [
                        'order_id' => $request->id,
                        'distance' => ($request->distance == null || $request->distance == 0) ? 1 : $request->distance,
                        'hand_on' => ($request->hand_on == null || $request->hand_on == '') ? 0 : $request->hand_on,
                        'discharge' => ($request->discharge == null || $request->discharge == '') ? 0 : $request->discharge,
                        'start_time_inventory' => $request->start_time_inventory == '' ? null : $request->start_time_inventory,
                        'finish_time_inventory' => $request->finish_time_inventory == '' ? null : $request->finish_time_inventory,
                        'updated_at' => \Carbon\Carbon::now(),
                    ]
                );
        }

        return 200;
    }
    public static function payment($request)
    {

        $payment = 0;
        $weight = ((float) $request->weight != 0 || (float) $request->weight != null) ? (float) $request->weight : 1;

        //kiểm tra loại đơn hàng
        if ($request->car_option == 1) { //hàng hóa
            $payment = self::calculate($request);
            if ($request->is_speed == 1) {
                $payment = $payment * 2;
            }
            if ($request->hand_on == 1) {
                $payment = $payment + 10000;
            }
            if ($request->discharge == 1) {
                if ($weight > 51 && $weight <= 150) {
                    $payment = $payment + 50000;
                } elseif ($weight >= 151 && $weight <= 300) {
                    $payment = $payment + 100000;
                } elseif ($weight > 300) {
                    $payment = $payment + 100000 + (1000 * ($weight - 300));
                }
            }
        } elseif ($request->car_option == 2) { //chứng từ
            //kiểm tra khu vực đơn hàng & quảng đường đơn hàng
            $sender_address = $request->sender_address;
            $receive_address = $request->receive_address;
            $char_BD = "Bình Dương";
            $char_HCM = "Hồ Chí Minh";
            $sender_BD = strpos($sender_address, $char_BD);
            $sender_HCM = strpos($sender_address, $char_HCM);
            $receive_DB = strpos($receive_address, $char_BD);
            $receive_HCM = strpos($receive_address, $char_HCM);
            if (($sender_BD != false || $sender_HCM != false) && ($receive_DB != false || $receive_HCM != false)) {
                $payment = 70000;
            } else {
                $payment = 140000;
            }
            if ($request->is_speed == 1) {
                $payment = $payment * 2;
            }
            if ($request->hand_on == 1) {
                $payment = $payment + 10000;
            }
        } elseif ($request->car_option == 4) //gửi hàng vào kho
        {
            $payment = self::calculate($request);

            $start_time_inventory = $request->start_time_inventory;
            $finish_time_inventory = $request->finish_time_inventory;

            $time_inventory = abs(strtotime($finish_time_inventory) - strtotime($start_time_inventory));
            $y = 365 * 60 * 60 * 24;
            $m = 30 * 60 * 60 * 24;
            $d = 60 * 60 * 24;
            $h = 60 * 60;
            $ms = 60;

            $years = floor($time_inventory / $y);
            $months = floor(($time_inventory - $years * $y) / $m);
            $days = floor(($time_inventory - $years * $y - $months * $m) / $d);
            $hours = floor(($time_inventory - $years * $y - $months * $m - $days * $d) / $h);
            $minutes = floor(($time_inventory - $years * $y - $months * $m - $days * $d - $hours * $h) / $ms);
            if ($minutes <= 30) {
                $payment = $payment + 50000;
            } elseif ($minutes > 30) {
                $payment = $payment + 70000;
            }
            if ($hours >= 1) {
                $a = 70000;
                $payment = $payment + ($a * ($hours - 1));
            }
        }
        return $payment;
    }
    public static function calculate($request)
    {
        $payment = 0;
        $distance = (float) $request->distance != 0 ? (float) $request->distance : 1;
        $length = (float) $request->length != 0 ? (float) $request->length : 1;
        $width = (float) $request->width != 0 ? (float) $request->width : 1;
        $height = (float) $request->height != 0 ? (float) $request->height : 1;
        $weight = (float) $request->weight != 0 ? (float) $request->weight : 1;
        $size = ($length * $width * $height) / 5000;
        //xe may
        if ($weight <= 20 && $size <= 9.6) {
            if ($distance <= 25) {
                $payment = 70000;
            } else {
                $payment = 3500 * $distance;
            }
        } else {
            //kiem tra hang hoa co qua tai khong
            $value = ($size < $weight) ? $weight : $size;
            $value = $value - 30;
            //xe tai
            if ($distance <= 35 && $value <= 30) {
                $payment = 250000;
            } else {
                //bình thường
                if ($distance > 35 && $value < 30) {
                    $payment = 7000 * ($distance - 35) + 250000;
                } else if ($value > 30 && $distance < 35) {
                    if ($value <= 50) {
                        $payment = 3000 * $value + 250000;
                    } elseif ($value > 50 && $value < 100) {
                        $payment = 2000 * $value + 250000;
                    } elseif ($value > 100) {
                        $payment = 1000 * $value + 250000;
                    }
                }
                //quá tải
                if ($distance > 35 && $value > 30) {
                    if ($value <= 50) {
                        $payment = 3000 * $value + (7000 * ($distance - 35)) + 250000;
                    } elseif ($value > 50 && $value < 100) {
                        $payment = 2000 * $value + (7000 * ($distance - 35)) + 250000;
                    } elseif ($value > 100) {
                        $payment = 1000 * $value + (7000 * ($distance - 35)) + 250000;
                    }
                }
            }
        }
        return $payment;
    }
}
