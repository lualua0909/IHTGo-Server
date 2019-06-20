<!-- jQuery 2.2.3 -->
<script src="{{ asset('public/admin') }}/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('public/admin') }}/bootstrap/js/bootstrap.min.js"></script>
{{--<script src="/js/app.js"></script>--}}
<!-- SlimScroll -->
<script src="{{ asset('public/admin') }}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('public/admin') }}/plugins/fastclick/fastclick.js"></script>
<script src="/js/noty/lib/noty.min.js"></script>

<script src="{{ asset('js/echo.js') }}"></script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script src="{{asset('js')}}/notifications.js"></script>
<script>
    $( window ).load(function() {
        setTimeout(getNotification('{{route('api.notification.order')}}', 'count-order', 'show-order'), 1000);
        setTimeout(getNotification('{{route('api.notification.chat')}}', 'count-chat', 'show-chat'), 1000);
    });

    Pusher.logToConsole = false;
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{config()->get('broadcasting.connections.pusher.key')}}',
        cluster: '{{config()->get('broadcasting.connections.pusher.options.cluster')}}',
        encrypted: true,
        logToConsole: false
    });

    Echo.private('order')
        .listen('OrderNotification', (e) => {
            document.getElementById('notiAudio').play();
            storeNotification(e.data.route, {{\App\Helpers\Business::NOTIFICATION_TYPE_ORDER}}, e.data.content);
            setTimeout(getNotification('{{route('api.notification.order')}}', 'count-order', 'show-order'), 3000);
            new Noty({
                type: e.data.type,
                text: e.data.content,
            }).show();
        }).listen('CustomerNotification', (e) => {
            document.getElementById('notiAudio').play();
            storeNotification(e.data.route, {{\App\Helpers\Business::NOTIFICATION_TYPE_ORDER}}, e.data.content);
            setTimeout(getNotification('{{route('api.notification.order')}}', 'count-order', 'show-order'), 3000);
            new Noty({
                type: e.data.type,
                text: e.data.content,
            }).show();
        });

    Echo.private('message')
        .listen('NewMessageNotification', (e) => {
            storeNotification('{{route('chat.list')}}' + '/' + e.data.userID, {{\App\Helpers\Business::NOTIFICATION_TYPE_CHAT}}, e.data.content, e.data.userID);
            setTimeout(getNotification('{{route('api.notification.chat')}}', 'count-chat', 'show-chat'), 3000);
            document.getElementById('notiAudio').play();
        });
    var BASE_URL = '{{url('')}}';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>



@yield('script')

<script src="{{asset('js')}}/my_script.js"></script>

<!-- AdminLTE App -->
<script src="{{ asset('public/admin') }}/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/admin') }}/dist/js/demo.js"></script>