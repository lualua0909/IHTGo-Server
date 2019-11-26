<!DOCTYPE html>
<html lang="">

<body>
    <table>
        <thead>
            <tr>
                <th>Địa Chỉ | {{ $item->address }}</th>
            </tr>
            <tr>
                <th>Phone | {{ $item->phone }}</th>
            </tr>
            <tr>
                <th>Fax | {{ $item->tax }}</th>
            </tr>
        </thead>
    </table>
    <table>
        <thead>
            <tr>
                <td colspan="13" style="text-align: center">
                    <h1 style="color: yellow">BẢNG KÊ CÔNG NỢ {{$item->name}}</h1>
                </td>
            </tr>
        </thead>
    </table>
    <table>
        <tr>
            <th>Từ Ngày: </th>
            <td>{{ $start }}</td>
        </tr>
        <tr>
            <th>Đến Ngày: </th>
            <td>{{ $end }}</td>
        </tr>
    </table>
    <table>
        <thead>
            <tr style="background-color: #0B90C4">
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Mã bill</th>
                <th>Tên Đơn Hàng</th>
                <th>Tên Người Gửi</th>
                <th>SDT Người Gửi</th>
                <th>Địa Chỉ Gửi</th>
                <th>Tên Người Nhận</th>
                <th>SDT Người Nhận</th>
                <th>Địa Chỉ Nhận</th>
                <th>Trạng Thái</th>
                <th>Thanh Toán</th>
                <th>Ngày Đặt Hàng</th>
                <th>Ngày Phân Bổ</th>
                <th>Loại Đơn Hàng</th>
                <th>Phí Vận Chuyển</th>
                <th>Số Tiền Đã Thu</th>
                <th>Thu Hộ</th>
                <th>Ghi Chú</th>
                <th>Admin Ghi Chú</th>
            </tr>
        </thead>
        <tbody>
            @foreach($listResult as $k => $value)
            <tr>
                <td>{{ $k + 1 }}</td>
                <td>{{ $value->code ?? '' }}</td>
                <td>{{ $value->coupon_code ?? '' }}</td>
                <td>{{ $value->order_name ??''}}</td>
                <td>{{ $value->sender_name ??''}}</td>
                <td>{{ $value->sender_phone ??''}}</td>
                <td>{{ $value->sender_address ??''}}</td>
                <td>{{ $value->receive_name ??''}}</td>
                <td>{{ $value->receive_phone ??''}}</td>
                <td>{{ $value->receive_address ??''}}</td>
                <td>{{ $orderStatus[$value->status] ??''}}</td>
                <td>{{ $orderPayment[$value->is_payment] ??''}}</td>
                <td>{{ $value->sender_date ??''}}</td>
                <td>{{ $value->delivery_date ??''}}</td>
                <td>{{ $orderType[$value->car_option] ??''}}</td>
                <td>{{ $value->total_price ??''}}</td>
                <td>0</td>
                <td>{{ $value->take_money ??''}}</td>
                <td>{{ $value->note ??'' }}</td>
                <td>{{ $value->admin_note ??'' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>