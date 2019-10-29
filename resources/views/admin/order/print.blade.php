<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>IHTGo - {{$order->code}}</title>

</head>

<body class="A5">
    <section class="sheet padding-10mm">
        <div class='row'>
            <div class='col-md-6'>
                <img src="https://ihtgo.com.vn/public/Images/Index/logo.png" width="200">
            </div>
            <div class='col-md-6'>
                <img src=" data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(100)->generate($order->code)) }} " style="text-align:center">
                <p>{{$order->code}}</p>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-6' style="border-right: 1px dotted">
                <h4>Thông tin người gửi</h4>
                <p>Tên: {{$order->sender_name}}</p>
                <p>Địa chỉ: {{$order->sender_address}}</p>
                <p>Số điện thoại: {{$order->sender_phone}}</p>
            </div>
            <div class='col-md-6'>
                <h4>Thông tin người nhận</h4>
                <p>Tên: {{$order->receive_name}}</p>
                <p>Địa chỉ: {{$order->receive_address}}</p>
                <p>Số điện thoại: {{$order->receive_phone}}</p>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-6' style="border-right: 1px dotted">
                <p>Tên đơn hàng:{{$order->name}}</p>
                <p>Phí giao hàng: {{number_format($order->total_price)}} (vnd)</p>
                <p>Thu hộ: {{number_format($order->take_money) }} (vnd)</p>
                <span>Tổng tiền:</span><span style="font-size:25px;font-weight:bold"> {{number_format($order->take_money + $order->total_price)}}</span> (vnd)
            </div>
            <div class='col-md-6'>
                @if($order->car_option == 1 || $order->car_option == 3) 
                    <p>Loại đơn hàng: Hàng hóa</p>
                    @if($order->hand_on==1 ||$order->is_speed==1)
                    <p>Dịch vụ:<span style="font-size:15px;font-weight:bold"> @if($order->is_speed==1) Hỏa tốc @endif @if($order->hand_on==1) Giao tận tay @endif </span> </p>
                    @endif
                    <p>Trọng lượng:{{$order->weight??""}} (kg)</p>
                    <p>DàixRộngxCao: {{$order->length??""}}x{{$order->width??""}}x{{$order->height??""}}(cm)</p>
                    <p>Ghi chú:{{$order->note??""}}</p>      
                @elseif($order->car_option == 2)
                    <p>Loại đơn hàng: Chứng từ</p>
                @else
                    @if($order->hand_on==1 ||$order->is_speed==1)
                    <p>Dịch vụ:<span style="font-size:15px;font-weight:bold"> @if($order->is_speed==1) Hỏa tốc @endif @if($order->hand_on==1) Giao tận tay @endif </span> </p>
                    @endif
                    <p>Trọng lượng:{{$order->weight??""}} (kg)</p>
                    <p>DàixRộngxCao: {{$order->length??""}}x{{$order->width??""}}x{{$order->height??""}}(cm)</p>
                    <p>Ghi chú:{{$order->note??""}}</p>    
                @endif
            </div>
        </div>
        <div>
            <div class='col-md-4'>
                <p>Chữ ký tài xế</p>
            </div>
            <div class='col-md-4'>
                <p>Chữ ký người gửi</p>
            </div>
            <div class='col-md-4'>
                <p>Chữ ký người nhận </p>
            </div>
        </div>
    </section>
</body>
<style>
    .row {
        width: 100%;
        margin-bottom: 1em;
        border-bottom: 1px dotted
    }

    .col-md-6 {
        position: relative;
        width: 50%;
        float: left;
    }

    .col-md-4 {
        position: relative;
        width: 33.33%;
        float: left;
        border: 1px solid;
        height: 13em;
        text-align: center;
    }

    @page {

        size: A5;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        window.print();
    });
</script>

</html>