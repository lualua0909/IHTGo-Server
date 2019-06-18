<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IHT APP</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    @php
        function getDataByType($arrInput, $type, $typeCar=false){
        $output = [];
        $outputResponse = [];
            foreach ($arrInput as $item){
                if ($item->type == $type){
                    array_push($output, $item);
                }
            }
            if ($typeCar){
                foreach ($output as $itemCar){
                    if ($itemCar->type_car == $typeCar){
                        array_push($outputResponse, $itemCar);
                    }

                }
            }else{
                $outputResponse = $output;
            }
            return $outputResponse;
        }
    @endphp
    <h4 class="text-center">GIAO HÀNG TRONG NGÀY NỘI TỈNH BÌNH DƯƠNG</h4>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>PHƯƠNG TIỆN VẬN CHUYỂN</th>
                <th>TRỌNG LƯỢNG TỐI ĐA (KG)</th>
                <th>CƯỚC PHÍ (VND)</th>
            </tr>
        </thead>
        <tbody>
        @foreach(getDataByType($listResult, \App\Helpers\Business::PRICE_BY_TH1, \App\Helpers\Business::CAR_TYPE_MOTORBIKE) as $item)
            <tr>
                <td>{{ $listTypeCar[$item->type_car] }}</td>
                <td>{{$item->min}}</td>
                <td class="price">{{$item->min_value}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>PHƯƠNG TIỆN VẬN CHUYỂN</th>
            <th>CƯỚC PHÍ BAN ĐẦU (VND)</th>
            <th>CƯỚC PHÍ THÊM</th>
            <th>THÊM ĐỊA ĐIỂM GIAO HÀNG</th>
        </tr>
        </thead>
        <tbody>
        @foreach(getDataByType($listResult, \App\Helpers\Business::PRICE_BY_TH1, \App\Helpers\Business::CAR_TYPE_TRUCK) as $item)
            <tr>
                <td>{{ $listTypeCar[$item->type_car] }}</td>
                <td class="price">{{$item->min_value}}</td>
                <td><span class="price">{{$item->increase_value}}</span> x {{$item->increase}} KG</td>
                <td><span class="price">{{$item->address_payment}}</span> / {{$item->address_receive}} Địa Chỉ</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <hr />
    <h4 class="text-center">GIAO CHỨNG TỪ TRONG NGÀY TỪ TP.HCM - BÌNH DƯƠNG VÀ NGƯỢC LẠI</h4>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th colspan="2" class="text-center">HÀNH TRÌNH</th>
            <th rowspan="2">PHÍ (VND)</th>
        </tr>
        <tr>
            <td>TỪ</td>
            <td>ĐẾN BÌNH DƯƠNG</td>
        </tr>
        </thead>
        <tbody>
        @foreach(getDataByType($listResult, \App\Helpers\Business::PRICE_BY_TH2) as $item)
            <tr>
                <td>{{ $item->province->name }}</td>
                <td>{{$item->district->name}}</td>
                <td class="price">{{$item->min_value}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <hr />
    <h4 class="text-center">GIAO CHỨNG TỪ TRONG NGÀY TỪ TP.HCM - BÌNH DƯƠNG VÀ NGƯỢC LẠI</h4>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th colspan="2">HÀNH TRÌNH</th>
            <th colspan="2">CHỈ TIÊU THỜI GIAN</th>
            <th colspan="2">GIÁ CƯỚC</th>
        </tr>
        <tr>
            <td>TỪ</td>
            <td>ĐẾN</td>
            <td>THỜI GIAN NHẬN</td>
            <td>THỜI GIAN GIAO</td>
            <td>ĐẾN 5KG (VND)</td>
            <td>MỖI KG TIẾP THEO (VND)</td>
        </tr>
        </thead>
        <tbody>
        @foreach(getDataByType($listResult, \App\Helpers\Business::PRICE_BY_TH3) as $item)
            <tr>
                <td>{{ $item->province->name }}</td>
                <td>{{$item->district->name}}</td>
                <td>{{$item->time_sende}}h</td>
                <td>{{$item->time_receive}}h</td>
                <td><span class="price">{{$item->min_value}}</span> VND</td>
                <td>Sau {{$item->increase}}kg: + <span class="price">{{$item->increase_value}}</span></td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{!! asset('/admin/dist/js/jquery.number.min.js') !!}"></script>
<script>
    $(function () {
        $('.price').number( true, 0 );
    });
</script>
</body>
</html>