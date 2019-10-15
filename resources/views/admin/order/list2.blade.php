@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-7">                
                    <form class="form-inline" method="POST" action="{{route('order.option.list.new')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                                <label>Ngày:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="date" value="{{$date}}" class="form-control pull-right" id="reservation">
                                </div>
                                <!-- /.input group -->
                            </div>
                        <div class="form-group ">
                            <label>Trạng thái:</label>
                            <select name="status" class="form-control">
                                <option value="0" @if($status == "0") selected @endif>All</option>
                                <option value="1" @if($status == "1") selected @endif>Đang chờ</option>
                                <option value="2" @if($status == "2") selected @endif>Chưa giao</option>
                                <option value="3" @if($status == "3") selected @endif>Đang giao</option>
                                <option value="4" @if($status == "4") selected @endif>Đã hoàn thành</option>
                                <option value="5" @if($status == "5") selected @endif>Khách hủy</option>
                                <option value="6" @if($status == "6") selected @endif>IHT hủy</option>
                                <option value="7" @if($status == "7") selected @endif>Không thành công</option>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label>Loại đơn:</label>
                            <select name="car_option" class="form-control">
                                <option value="0" @if($car_option == "0") selected @endif>All</option>
                                <option value="1" @if($car_option == "1") selected @endif>Hàng hóa</option>
                                <option value="2" @if($car_option == "2") selected @endif>Chứng từ</option>
                                <option value="4" @if($car_option == "4") selected @endif>Làm hàng</option>
                            </select>
                        </div>
                        <div class="btn-group"> <button type="submit" class="btn btn-info">Tìm</button></div>
                    </form>
                </div>
                <div class="col-md-3">
                    <form method="POST" action="{{route('order.post.search.list.new')}}">
                        {{ csrf_field() }}
                        <div class="has-feedback">
                            <input name="search" type="text" value="{{$search}}" class="form-control" placeholder="{{__('label.customer_name')}}, {{__('label.order_name') . ',' . __('label.coupon_code') . ',' . __('label.phone')}}">
                        </div>
                        <button type="submit" class="btn btn-info" style="position: absolute;top: 0; right: 0; z-index: 2;">Tìm</button>
                    </form>
                </div>
                <div class="col-md-2">
                    <div class="box-tools pull-right">
                            <a href="{{route('order.add')}}" class="btn btn-success btn-sm">
                                <i class="fa fa-plus"></i> {{ __('label.add_new') }}</a>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <table id="tableItem" class="table table-bordered table-striped">
                        <thead>
                            <tr class="info">
                                <th>Mã QR</th>
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
                            <tr onclick="orderDetail({{$order->id}})">
                                <td class="text-center">{!! QrCode::size(50)->generate($order->code); !!} <br> {{$order->code}}</td>
                                <td>{{ $order->coupon_code }}</td>
                                <td>{{ $order->name }}</td>
                                <td>
                                    @switch($order->status)
                                    @case(1)
                                    <span class="label label-warning">Đang chờ</span>
                                    @break
                                    @case(2)
                                    <span class="label label-info">Chưa giao</span>
                                    @break
                                    @case(3)
                                    <span class="label label-danger">Đang giao</span>
                                    @break
                                    @case(4)
                                    <span class="label label-success">Đã hoàn thành</span>
                                    @break
                                    @case(5)
                                    <span class="label label-default">Khách hủy</span>
                                    @break
                                    @case(6)
                                    <span class="label label-default">IHT hủy</span>
                                    @break
                                    @case(7)
                                    <span class=" label label-default">Không thành công</span>
                                    @break

                                    @default
                                    <span>Không xác định</span>
                                    @endswitch
                                </td>
                                <td>
                                    @switch($order->car_option)
                                    @case(1)
                                    <span class="label label-success">Hàng hóa</span>
                                    @break
                                    @case(2)
                                    <span class="label label-warning">Chứng từ</span>
                                    @break
                                    @case(3)
                                    <span class="label label-success">Hàng hóa</span>
                                    @break

                                    @default
                                    <span class="label label-info">Làm hàng</span>
                                    @endswitch
                                </td>
                                <td>{{ number_format($order->total_price) }} </td>
                                <td><a href="{{url('admin/customer/detail/'.$order->customer_id.'')}}"> {{ $order->user_name }}</a></td>
                                <td>
                                    {{ $order->sender_address }}
                                </td>
                                <td>
                                    {{ $order->receive_address }}
                                </td>
                                <td>{{date('d/m/Y H:i:s', strtotime($order->created_at))}}</td>
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
@section('style')
<link rel="stylesheet" href="{{asset('public/admin')}}/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="{{asset('public/admin')}}/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="{{asset('public/admin')}}/plugins/daterangepicker/daterangepicker.css">

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{asset('public/admin')}}/plugins/daterangepicker/daterangepicker.js"></script>

<script src="{{asset('public/admin')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('public/admin')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="{{asset('public/admin')}}/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>
    function orderDetail(id)
        {
            window.open('detail/'+id, '_blank');
        }
    $(function() {
        $('#reservation').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });
        $('#start_date, #end_date').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy'
        });
    });
</script>

@endsection