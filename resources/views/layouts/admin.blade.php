<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ (isset($title)) ? $title : 'Admin Manager' }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('public/admin') }}/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    @yield('style')
<!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/admin') }}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('public/admin') }}/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="{{ asset('js/noty/lib/noty.css') }}">
    <link rel="stylesheet" href="{{ asset('js/noty/lib/themes/mint.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <style type="text/css">
        span.has-error {
            color: red !important;
        }
    </style>
<!-- Site wrapper -->
<div class="wrapper">
    <header class="main-header">
        @include('admin.header')
    </header>
    <aside class="main-sidebar">
        @include('admin.siderbar')
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.message')
        @yield('content')
    </div>
    <footer class="main-footer">
        @include('admin.footer')
    </footer>
    <div class="control-sidebar-bg"></div>
</div>
@include('admin.script')
</body>
</html>
