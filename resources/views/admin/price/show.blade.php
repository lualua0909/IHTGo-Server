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
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>LOẠI XE</th>
            <th>LOẠI GIAO HÀNG</th>
            <th>PHÍ BAN ĐẦU (VND) </th>
            <th>TÍNH THEO</th>
            <th>GIÁ TRỊ ĐẦU</th>
            <th>NÂNG CAO</th>
            <th>PHÍ SAU MỖI KM TIẾP THEO (VND)</th>
        </tr>
        </thead>
        <tbody>
            @foreach($listResult as $item)
            <tr>
                <td>{{ $listTypeCar[$item->type_car] }}</td>
                <td>@if($item->type){{ $listType[$item->type] }}@endif</td>
                <td class="price">{{$item->min_value}}</td>
                <td>{{$listOption[$item->option]}}</td>
                <td>{{$item->min}}</td>
                <td>
                    @if($item->advance)
                        <table class="table table-detail table-bordered table-striped">
                            <tr>
                                <th>@lang('label.from')</th>
                                <th>@lang('label.to')</th>
                                <th>@lang('label.value')</th>
                            </tr>
                            @foreach($item->advance as $advance)
                                <tr>
                                    <td>{{$advance['from']}}</td>
                                    <td>{{$advance['to']}}</td>
                                    <td class="price">{{$advance['value']}}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </td>
                <td class="price">{{$item->increase_value}}</td>
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