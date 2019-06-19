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
<script>
    var socket = new WebSocket('ws://{{config('app.websocket', '127.0.0.1:9898')}}/server');

    socket.onopen = function() {
        var message = "welcome to thaile";
        console.log(message);
        //socket.send(message);
    };

    socket.onclose = function(event) {
        if (event.wasClean) {
            console.log('Connection closed cleanly');
        } else {
            console.log('Broken connections');
        }
        console.log('Key: ' + event.code + ' cause: ' + event.reason);
    };

    socket.onmessage = function(event) {
        var result = JSON.parse(event.data);
        document.getElementById('notiAudio').play();
        new Noty({
            type: result.type,
            text: result.content,
        }).show();
        //window.location.reload(true);
    };

    socket.onerror = function(error) {
        console.log("Error " + error.message);
    };

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
