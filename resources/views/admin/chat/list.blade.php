@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <h2>Khach Hang</h2>
                <ul class="list-group">
                    @foreach($listCustomer as $customer)
                    <li class="list-group-item"><a href="{{route('chat.list', $customer->id)}}" data-id="{{$customer->id}}" class="userChat" data-chatkit="{{$customer->chatkit_id}}">{{$customer->name}} </a><span class="badge">{{ (in_array($customer->id, $notifications)) ? 'new' : ''}}</span></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <div id="boxMessage">
                    <div class="box box-primary direct-chat direct-chat-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title" id="nameChat"></h3>
                        </div>
                        <div class="box-body">
                            <div class="direct-chat-messages" style="height: 500px" id="direct-chat-messages">
                                @foreach($listMessage as $msg)
                                    @if($msg['user_id'] == request()->user()->chatkit_id)
                                        <div class="direct-chat-msg right">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-right">{{request()->user()->name}}</span>
                                            </div>
                                            <img class="direct-chat-img" src="{{asset('public/admin')}}/dist/img/user3-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                {{$msg['text']}}
                                            </div>
                                        </div>
                                        @else
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-left">{{$friend ? $friend->name : 'Khach'}}</span>
                                            </div>
                                            <img class="direct-chat-img" src="{{asset('public/admin')}}/dist/img/user1-128x128.jpg"><!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                {{$msg['text']}}
                                            </div>
                                        </div>
                                        @endif
                                @endforeach
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                                <div class="input-group">
                                    <input type="text" name="message" id="message" placeholder="Type Message ..." class="form-control">
                                    <span class="input-group-btn">
                                        <button type="button" id="sendMessage" class="btn btn-primary btn-flat">Send</button>
                                    </span>
                                </div>
                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!--/.direct-chat -->
                </div>
            </div>
            <div class="col-md-3">
                <h2>Tai Xe</h2>
                <ul class="list-group">
                    @foreach($listDriver as $driver)
                        <li class="list-group-item"><a href="{{route('chat.list', $driver->id)}}" data-id="{{$driver->id}}" class="userChat" data-chatkit="{{$driver->chatkit_id}}">{{$driver->name}} </a><span class="badge">{{ (in_array($driver->id, $notifications)) ? 'new' : ''}}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('script')
    <script>
        $(function () {

            var client = false;
            var html = '';
            var adminHtml1A = '<div class="direct-chat-msg right">';
            var adminHtml1C = '<div class="direct-chat-msg">';
            var adminHtml2 = '<div class="direct-chat-info clearfix">';
            var adminHtml3A = '<span class="direct-chat-name pull-right">';
            var adminHtml3C = '<span class="direct-chat-name pull-left">';
            var adminHtml4 = '</span>';
            var adminHtml5A = '<span class="direct-chat-timestamp pull-left">';
            var adminHtml5C = '<span class="direct-chat-timestamp pull-right">';
            var adminHtml6 = '</span>';
            var adminHtml7 = '</div>';
            var adminHtml8A = '<img class="direct-chat-img" src="{{asset("admin")}}/dist/img/user3-128x128.jpg">';
            var adminHtml8C = '<img class="direct-chat-img" src="{{asset("admin")}}/dist/img/user1-128x128.jpg">';
            var adminHtml9 = '<div class="direct-chat-text">';
            var adminHtml9A = '<div class="direct-chat-text right">';
            var adminHtml10 = '</div>';
            var adminHtml11 = '</div>';
            var user_id = {{auth()->user()->id}};

            Echo.private('message')
                .listen('NewMessageNotification', (e) => {
                    if (e.data.to_id == user_id) {
                        if (client){
                            html = adminHtml9 + e.data.message + adminHtml10;
                        } else {
                            html = adminHtml1C + adminHtml2 + adminHtml3C + e.data.name + adminHtml4 + adminHtml7 + adminHtml8C + adminHtml9 + e.data.message + adminHtml10 + adminHtml11;
                        }
                        $('#direct-chat-messages').append(html)
                        $('#direct-chat-messages').scrollTop($('#direct-chat-messages')[0].scrollHeight);
                        client = true;
                    }

                });

            $('#sendMessage').on('click', function () {
                var message = $('#message').val();
                if (message !== ''){
                    $.post("{{route('api.chat.message', request()->user()->id)}}",
                        {
                            msg: message,
                            room_id: "{{($roomID) ? $roomID : null}}"
                        },
                        function(data, status){
                            if (status === 'success'){
                                var html = '';
                                if (client){
                                    html = adminHtml1A + adminHtml2 + adminHtml3A + '{{request()->user()->name}}' + adminHtml4 + adminHtml7 + adminHtml8A + adminHtml9 + message + adminHtml10 + adminHtml11;
                                }else {
                                    html = adminHtml1A + adminHtml9A + message + adminHtml11 + adminHtml11;
                                }
                                $('#direct-chat-messages').append(html)
                                $('#message').val('');
                                $('#direct-chat-messages').scrollTop($('#direct-chat-messages')[0].scrollHeight);
                                client = false;
                            }
                            //alert("Data: " + data + "\nStatus: " + status);
                        });
                }

            });

            $('input[name=message]').on( 'keyup', function (e) {
                if (e.which == 13) {
                    var message = $('#message').val();
                    if (message !== ''){
                        $.post("{{route('api.chat.message', request()->user()->id)}}",
                            {
                                msg: message,
                                room_id: "{{($roomID) ? $roomID : null}}"
                            },
                            function(data, status){
                                if (status === 'success'){
                                    var html = '';
                                    if (client){
                                        html = adminHtml1A + adminHtml2 + adminHtml3A + '{{request()->user()->name}}' + adminHtml4 + adminHtml7 + adminHtml8A + adminHtml9 + message + adminHtml10 + adminHtml11;
                                    }else {
                                        html = adminHtml1A + adminHtml9A + message + adminHtml11 + adminHtml11;
                                    }
                                    $('#direct-chat-messages').append(html)
                                    $('#message').val('');
                                    $('#direct-chat-messages').scrollTop($('#direct-chat-messages')[0].scrollHeight);
                                    client = false;
                                }
                            });
                    }
                }
            });
        });
    </script>

@endsection