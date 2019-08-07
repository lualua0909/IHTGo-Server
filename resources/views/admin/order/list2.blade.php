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
                                <input name="search" type="text" class="form-control" placeholder="{{__('label.customer_name')}}, {{__('label.order_name') . ',' . __('label.code') . ',' . __('label.phone')}}">
                            </div>
                            <button type="submit" class="btn btn-info" style="position: absolute;top: 0; right: 0; z-index: 2;">Tìm</button>

                        </form>

                    </div>
                    <div class="col-md-8" style=" text-align: right;">
                        <form method="POST" action="{{route('order.post.list.new')}}">
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
                                <th>Mã đơn hàng</th>
                                <th>Tên đơn hàng</th>
                                <th>Loại xe</th>
                                <th>Trạng thái</th>
                                <th>Tổng tiền</th>
                                <th>Khách hàng</th>
                                <th>Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td><a href={{"detail/" .$order->id }}>{{ $order->code }}</a></td>
                                <td>{{ $order->name }} </td>
                                <td>@switch($order->car_type)
                                    @case(8)
                                    <span>Xe máy</span>
                                    @break
                                    @case(7)
                                    <span>Xe hơi</span>
                                    @break
                                    @default
                                    <span>Không biết xe gì</span>@endswitch</td>
                                <td>
                                    @switch($order->status)
                                    @case(1)
                                    <span style="border-radius: 5px; color: white; background-color: #f39c12; padding: 5px">Đang chờ</span>
                                    @break
                                    @case(2)
                                    <span style="border-radius: 5px; color: white; background-color: #3c8dbc; padding: 5px">Chưa giao</span>
                                    @break
                                    @case(3)
                                    <span style="border-radius: 5px; color: white; background-color: #dd4b39; padding: 5px">Đang giao</span>
                                    @break
                                    @case(4)
                                    <span style="border-radius: 5px; color: white; background-color: #00a65a; padding: 5px">Đã hoàn thành</span>
                                    @break
                                    @case(5)
                                    <span style="border-radius: 5px; color: white; background-color: gray; padding: 5px">Khách hủy</span>
                                    @break
                                    @case(6)
                                    <span style="border-radius: 5px; color: white; background-color: gray; padding: 5px">IHT hủy</span>
                                    @break
                                    @case(7)
                                    <span style="border-radius: 5px; color: white; background-color: gray; padding: 5px">Không thành công</span>
                                    @break

                                    @default
                                    <span>Không xác định</span>
                                    @endswitch
                                </td>
                                <td>{{ number_format($order->total_price) }} </td>
                                <td>{{ $order->user_id }}</td>
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