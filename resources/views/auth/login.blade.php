<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ __('label.sign_in') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('public/admin') }}/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/admin') }}/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('public/admin') }}/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box" style="width: 450px">
    <!-- /.login-logo -->
    <div class="panel panel-primary">
            <div class="panel-heading text-center">
                <h3 class="panel-title">Welcome to Book Car System</h3>
            </div>
            <div class="panel-body">
                
            
    <div class="login-box-body">
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="{{ __('label.username') }}" name="email" value="{{ old('email') }}" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="{{ __('label.password') }}" name="password" required id="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
                @endif
            </div>
            <div class="form-group">
                <select class="form-control lang" required="required">
                    <option value="vn" {{ (\Illuminate\Support\Facades\App::getLocale() == 'vn') ? 'selected' : '' }}>Việt Nam (VN)</option>
                    <option value="en" {{ (\Illuminate\Support\Facades\App::getLocale() == 'en') ? 'selected' : '' }}>English (EN)</option>
                </select>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>  {{ __('label.remember_me') }}
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('label.sign_in') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <!-- /.social-auth-links -->

        <a href="{{ route('password.request') }}">{{ __('label.i_forgot_my_password') }}</a><br><br>
        <div>
            <small>Copyright © 2018 - 2019 ThaiLe. All rights reserved. </small>
            <br>
            <small>ThaiLe Resource Information System - 2018 </small>
            <br>
            <small>Build: 18.00.00</small>
        </div>

    </div>
    </div>
        </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('public/admin') }}/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('public/admin') }}/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="{{ asset('public/admin') }}/plugins/iCheck/icheck.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });

    $('select.lang').on('change', function(){
        var locale = $(this).val();
        $.ajax({
            url: '{{ route('language') }}',
            type: 'POST',
            data: {locales: locale},
            dataType: 'json',
            success: function(data){

            },
            error: function(data){

            },
            beforeSend: function(){

            },
            complete: function(data){
                window.location.reload(true);
            }
        });
    });
</script>
</body>
</html>
