<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Lockscreen</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('public/admin') }}/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/admin') }}/dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <a href="{{ route('login') }}" class="btn btn-success btn-lg btn-block">{{ __('label.sign_in') }}</a>

    </div>
    <div class="lockscreen-footer text-center">
        <small>Copyright © 2018 - 2019 INNOVATIVE CONSULTING. All rights reserved. </small>
        <br>
        <small>Human Resource Information System - 2018 </small>
        <br>
        <small>Build: 18.00.00</small>
    </div>
</div>
<!-- /.center -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('public/admin'/plugins/jQuery/jquery-2.2.3.min.js) }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('public/admin/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
