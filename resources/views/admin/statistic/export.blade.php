<!DOCTYPE html>
<html lang="">
<body>
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
        <th>Loại Khách Hàng</th>
        <th>Số Đơn Hàng</th>
        <th>Người Trả Phí</th>
        <th>Mã NPP</th>
        <th>Tên NPP</th>
        <th>Mã NVGH</th>
        <th>Tên NVGH</th>
        <th>Mã Khách Hàng</th>
        <th>Tên Khách Hàng</th>
        <th>Địa Chỉ Khách Hàng</th>
        <th>Tên Đơn Hàng</th>
        <th>Tên Người Gửi</th>
        <th>Địa Chỉ Gửi</th>
        <th>Địa Chỉ Nhận</th>
        <th>Trạng Thái</th>
        <th>Ngày Đặt Hàng</th>
        <th>Ngày Phân Bổ</th>
        <th>Loại Đơn Hàng</th>
        <th>Phí Vận Chuyển</th>
        <th>Phí VC đã thanh toán / Ghi nợ</th>
        <th>Số Tiền Đã Thu</th>
        <th>Thu Hộ</th>
        <th>Ghi Chú</th>
    </tr>
    </thead>
    <tbody>
    @foreach($listResult as $k => $value)
        <tr>
            <td>{{ $k + 1 }}</td>
            <td>{{ ($value->company_id) ? $value->coName : 'Ca Nhan' }}</td>
            <td>{{ $value->code }}</td>
            <td>{{ $listPayer[$value->payer] }}</td>
            <td>{{ $value->npp_code }}</td>
            <td>{{ $value->npp_name }}</td>
            <td>{{ $value->nvgh_code }}</td>
            <td>{{ $value->nvgh_name }}</td>
            <td>{{ $value->customer_code }}</td>
            <td>{{ $value->customer_name }}</td>
            <td>{{ $value->address }}</td>
            <td>{{ $value->order_name }}</td>
            <td>{{ $value->sender_name }}</td>
            <td>{{ $value->sender_address . ' - ' . $value->sender_district . ' - ' . $value->sender_province }}</td>
            <td>{{ $value->receive_address . ' - ' . $value->receive_district . ' - ' . $value->receive_province }}</td>
            <td>{{ $orderStatus[$value->status] }}</td>
            <td>{{ $value->sender_date }}</td>
            <td>{{ $value->delivery_date }}</td>
            <td>{{ $orderType[$value->car_option] }}</td>
            <td>{{ $value->total_price }}</td>
            <td>{{ $value->is_payment ? $orderPayment[$value->is_payment] : null }}</td>
            <td>0</td>
            <td>{{ $value->take_money }}</td>
            <td>{{ $value->note }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>