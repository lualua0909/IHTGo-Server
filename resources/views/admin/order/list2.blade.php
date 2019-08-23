@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12 pull-right">
                    <div class="col-md-4">
                        <form method="POST" action="{{route('order.post.search.list.new')}}">
                            {{ csrf_field() }}
                            <div class="has-feedback">
                                <input name="search" type="text" class="form-control" placeholder="{{__('label.customer_name')}}, {{__('label.order_name') . ',' . __('label.coupon_code') . ',' . __('label.phone')}}">
                            </div>
                            <button type="submit" class="btn btn-info" style="position: absolute;top: 0; right: 0; z-index: 2;">Tìm</button>

                        </form>

                    </div>
                    <div class="col-md-8" style=" text-align: right;">
                        <form method="POST" action="{{route('order.option.list.new')}}">
                            {{ csrf_field() }}
                            <div class="btn-group ">
                                <select name="status" class="form-control">
                                    <option value="0" selected>All</option>
                                    <option value="1">Đang chờ</option>
                                    <option value="2">Chưa giao</option>
                                    <option value="3">Đang giao</option>
                                    <option value="4">Đã hoàn thành</option>

                                </select>
                            </div>
                            <div class="btn-group ">
                                <select name="payment_type" class="form-control">
                                    <option value="0" selected>All</option>
                                    <option value="1">Tiền mặt</option>
                                    <option value="2">Theo tháng</option>
                                </select>
                            </div>
                            <div class="btn-group"> <button type="submit" class="btn btn-info">Tìm</button></div>
                        </form>
                    </div>
                </div>
                <br><br>
                <div class="col-md-12">
                    <table id="tableItem" class="table table-bordered table-striped">
                        <thead>
                            <tr class="info">
                                <th>Mã bill</th>
                                <th>Tên đơn hàng</th>
                                <th>Trạng thái</th>
                                <th>Loại đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th>Khách hàng</th>
                                <th>Địa chỉ gửi</th>
                                <th>Địa chỉ nhận</th>
                                <th>Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td><a href={{"detail/" .$order->id }}>{{ $order->coupon_code }}</a></td>
                                <td><a href={{"detail/" .$order->id }}>{{ $order->name }} </a></td>
                                <td>
                                    @switch($order->status)
                                    @case(1)
                                    <span class="bage-warning">Đang chờ</span>
                                    @break
                                    @case(2)
                                    <span class="bage-info">Chưa giao</span>
                                    @break
                                    @case(3)
                                    <span class="bage-danger">Đang giao</span>
                                    @break
                                    @case(4)
                                    <span class="bage-success">Đã hoàn thành</span>
                                    @break
                                    @case(5)
                                    <span class="bage-basic">Khách hủy</span>
                                    @break
                                    @case(6)
                                    <span class="bage-basic">IHT hủy</span>
                                    @break
                                    @case(7)
                                    <span class="bage-basic">Không thành công</span>
                                    @break

                                    @default
                                    <span>Không xác định</span>
                                    @endswitch
                                </td>
                                <td>
                                @switch($order->car_option)
                                    @case(1)
                                    <span class="bage-success">Hàng hóa</span>
                                    @break
                                    @case(2)
                                    <span class="bage-warning">Chứng từ</span>
                                    @break
                                    @case(3)
                                    <span class="bage-success">Hàng hóa</span>
                                    @break

                                    @default
                                    <span class="bage-info">Làm hàng</span>
                                    @endswitch
                                </td>
                                <td>{{ number_format($order->total_price) }} </td>
                                <td><a href="{{url('admin/customer/detail/'.$order->customer_id.'')}}"> {{ $order->user_name }}</a></td>
                                <td>{{ $order->sender_district_name }} {{ $order->sender_province_name }}</td>
                                <td>{{ $order->receive_district_name }} {{ $order->receive_province_name }}</td>
                                <td>{{ $order->created_at }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $orders->links()}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection