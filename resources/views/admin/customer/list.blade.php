@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="has-feedback">
                            <input name="search" type="text" class="form-control" placeholder="{{__('label.name')}}, {{__('label.email') . ',' . __('label.phone')}}">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="col-md-6 pull-right">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-primary btn-customer-type active" data-type="">All</button>
                            @foreach($customerType as $k => $v)
                                <button type="button" class="btn btn-primary btn-customer-type" data-type="{{$k}}">{{$v}}</button>
                            @endforeach
                        </div>
                    </div>
                    <br><br>
                    <div class="col-md-12">
                        <table id="tableItem" class="table table-bordered table-striped">
                            <thead>
                                <tr class="info">
                                    <th>{{ __('label.name') }}</th>
                                    <th>{{ __('label.phone') }}</th>
                                    <th>{{ __('label.email') }}</th>
                                    <th>{{ __('label.type') }}</th>
                                    <th>{{ __('label.created') }}</th>
                                    <th>{{ __('label.chat') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
        <form id="download_excel_customer" target="_blank" method="post" action="" style="display: none">
            {{ csrf_field() }}
            <input name="type" type="hidden"/>
        </form>
        <div class="col-md-4" id="boxMessage" style="display: none">
            <!-- DIRECT CHAT PRIMARY -->
            <div class="box box-primary direct-chat direct-chat-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" id="nameChat"></h3>

                    <div class="box-tools pull-right">
                        <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                            <i class="fa fa-comments"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                        <!-- Message. Default to the left -->
                        <div class="direct-chat-msg">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                            </div>
                            <!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                Is this template really for free? That's unbelievable!
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->

                        <!-- Message to the right -->
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                            </div>
                            <!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="../dist/img/user3-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                You better believe it!
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->
                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="../dist/img/user1-128x128.jpg" alt="User Image">

                                    <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              Count Dracula
                              <small class="contacts-list-date pull-right">2/28/2015</small>
                            </span>
                                        <span class="contacts-list-msg">How have you been? I was...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                        </ul>
                        <!-- /.contatcts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <form action="#" method="post">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-btn">
                        <button type="button" id="sendMessage" class="btn btn-primary btn-flat">Send</button>
                      </span>
                        </div>
                    </form>
                </div>
                <!-- /.box-footer-->
            </div>
            <!--/.direct-chat -->
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('script')
    <script src="{{asset('admin')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('admin')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <script>
        $(function () {
            if($("#tableItem").length > 0) {
                var customerTypeColor = [];
                var customerType = [];
                @foreach($customerTypeColor as $k => $v)
                    customerTypeColor[{{$k}}] = '{{$v}}';
                @endforeach

                @foreach($customerType as $k => $v)
                    customerType[{{$k}}] = '{{$v}}';
                @endforeach

                var tableItem = $("#tableItem").DataTable({
                        "processing": true,
                        "serverSide": true,
                        "searching": false,
                        "lengthChange": false,
                        "order": [[4, "desc"]],
                        "ajax": {
                            'type': "POST",
                            'url': "{{route('customer.post.list')}}",
                            "data": function (d) {
                                d.type = $('input[name=type]').val(),
                                d.keyword = $('input[name=search]').val()
                            }
                        },
                        "columns": [
                            {"data": "name"},
                            {"data": 'phone'},
                            {"data": 'email'},
                            {"data": "type"},
                            {"data": "created_at"},
                            {"data": "chatkit_id"}
                        ],
                        "columnDefs": [
                            {
                                "targets": 0,
                                "data": "id",
                                "render": function ( data, type, full, meta ) {
                                    return '<a href="{{route('customer.detail')}}/' + full.id + '">#'+data+'</a>';
                                }
                            },
                            {
                                "targets": 3,
                                class: 'text-center',
                                "render": function ( data, type, full, meta ) {
                                    return '<span style="display: block; padding: 5px;" class="label '+customerTypeColor[data]+'">'+customerType[data]+'</span>';
                                }
                            },
                            {
                                "targets": 5,
                                class: 'text-center',
                                "render": function ( data, type, full, meta ) {
                                    return '<button data-customer="' + full.name + '" class="btn btn-success" id="btn-chat" data-chatkit="' + data + '">@lang('label.chat')</button>';
                                }
                            }
                        ],
                        "language": {
                            "lengthMenu": "{{ __('label.lengthMenu') }}",
                            "zeroRecords": "{{ __('label.zeroRecords') }}",
                            "info": "{{ __('label.info') }}",
                            "infoEmpty": "{{ __('label.infoEmpty') }}",
                            "search": "{{ __('label.search') }}",
                            "paginate": {
                                "first":      "{{ __('label.first') }}",
                                "last":       "{{ __('label.last') }}",
                                "next":       "{{ __('label.next') }}",
                                "previous":   "{{ __('label.previous') }}"
                            },
                            "infoFiltered": "({{ __('label.infoFiltered') }})"
                        }
                    });
                $('.btn-customer-type').click(function(e){
                    e.preventDefault();
                    $('.btn-customer-type').removeClass('active');
                    $('input[name=type]').val($(this).data('type'));
                    $(this).addClass('active');
                    tableItem.draw();
                });

                $('input[name=search]').on( 'keyup', function (e) {
                    if (e.which == 13) {
                        tableItem.search( this.value ).draw();
                    }
                });

                $('#tableItem tbody').on('click','button', function() {
                    //alert($(this).data('chatkit'));
                    $('#nameChat').text($(this).data('customer'));
                    $('#boxMessage').show();
                });
            }
        });
    </script>

@endsection