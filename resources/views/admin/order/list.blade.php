@extends('layouts.admin')
@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <div class="col-md-3 col-md-offset-9">
                    @can('create-order')
                        <div class="box-tools pull-right">
                            <a href="{{route('order.add')}}" class="btn btn-success btn-sm">
                                <i class="fa fa-plus"></i> {{ __('label.add_new') }}</a>
                        </div>
                    @endcan
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <div class="has-feedback">
                            <input name="search" type="text" class="form-control" placeholder="{{__('label.customer_name')}}, {{__('label.order_name') . ',' . __('label.code') . ',' . __('label.phone')}}">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="col-md-4 pull-right">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-warning btn-order-payment active" data-payment="">All</button>
                            @foreach($orderPayment as $k => $v)
                                <button type="button" class="btn btn-warning btn-order-payment" data-payment="{{$k}}">{{$v}}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-5 pull-right">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-primary btn-order-type active" data-type="">All</button>
                            @foreach($orderType as $k => $v)
                                <button type="button" class="btn btn-primary btn-order-type" data-type="{{$k}}">{{$v}}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-default btn-block" id="daterange">
                            <i class="fa fa-calendar"></i>
                            <span> Last 30 Days</span>
                            <i class="fa fa-caret-down"></i>
                        </button>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-info btn-order-status active" data-type="">All</button>
                            @foreach($orderStatus as $key => $value)
                                <button type="button" class="btn btn-info btn-order-status" data-type="{{$key}}">{{$value}}</button>
                            @endforeach
                        </div>
                    </div>
                    <br><br>
                    <div class="col-md-12">
                        <table id="tableItem" class="table table-bordered table-striped">
                            <thead>
                            <tr class="info">
                                <th>{{ __('label.order_code') }}</th>
                                <th>{{ __('label.name') }}</th>
                                <th>{{ __('label.type_car') }}</th>
                                <th>{{ __('label.status') }}</th>
                                <th>{{ __('label.payment') }}</th>
                                <th>{{ __('label.total_price') }}</th>
                                <th>{{ __('label.customer') }}</th>
                                <th>{{ __('label.address_sender') }}</th>
                                <th>{{ __('label.address_receive') }}</th>
                                <th>{{ __('label.created') }}</th>
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
            <input name="payment" type="hidden"/>
            <input name="status" type="hidden"/>
            <input name="start_date" type="hidden"/>
            <input name="end_date" type="hidden"/>
        </form>
    </section>
    <!-- /.content -->
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/admin')}}/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="{{asset('public/admin')}}/plugins/bootstrap-daterangepicker/daterangepicker.css">
@endsection

@section('script')
    <script src="{{asset('public/admin')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/admin')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{asset('public/admin')}}/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="{!! asset('public/admin/dist/js/jquery.number.min.js') !!}"></script>

    <script>
        $(function () {
            if($("#tableItem").length > 0) {

                var orderTypeColor = [];
                var orderType = [];

                var orderPaymentColor = [];
                var orderPayment = [];

                var orderStatusColor = [];
                var orderStatus = [];
                @foreach($orderStatusColor as $k => $v)
                    orderStatusColor[{{$k}}] = '{{$v}}';
                @endforeach
                @foreach($orderStatus as $k => $v)
                    orderStatus[{{$k}}] = '{{$v}}';
                @endforeach

                @foreach($orderType as $k => $v)
                    orderType[{{$k}}] = '{{$v}}';
                @endforeach

                @foreach($orderPaymentColor as $k => $v)
                    orderPaymentColor[{{$k}}] = '{{$v}}';
                @endforeach

                @foreach($orderPayment as $k => $v)
                    orderPayment[{{$k}}] = '{{$v}}';
                @endforeach

                var endDate = moment(),
                    startDate = moment().subtract(29, 'days');

                $('input[name=startDate]').val(startDate.format('DD/MM/YY'));
                $('input[name=endDate]').val(endDate.format('DD/MM/YY'));

                var tableItem = $("#tableItem").DataTable({
                        "processing": true,
                        "serverSide": true,
                        "searching": false,
                        "lengthChange": false,
                        "order": [[9, "desc"]],
                        "ajax": {
                            'type': "POST",
                            'url': "{{route('order.post.list')}}",
                            "data": function (d) {
                                d.type = $('input[name=type]').val(),
                                d.payment = $('input[name=payment]').val(),
                                d.status = $('input[name=status]').val(),
                                d.startDate = $('input[name=start_date]').val(),
                                d.endDate = $('input[name=end_date]').val(),
                                d.keyword = $('input[name=search]').val()
                            }
                        },
                        "columns": [
                            {"data": "code"},
                            {"data": "name"},
                            {"data": 'car_type'},
                            {"data": "status"},
                            {"data": "is_payment"},
                            {"data": 'total_price'},
                            {"data": "customer"},
                            {"data": "code"},
                            {"data": "code"},
                            {"data": "created_at"}
                        ],
                        "columnDefs": [
                            {
                                "targets": 0,
                                "data": "code",
                                "render": function ( data, type, full, meta ) {
                                    return '<a href="{{route('order.detail')}}/' + full.id +'">#'+data+'</a>';
                                }
                            },
                            {
                                "targets": 2,
                                class: 'text-center',
                                "render": function ( data, type, full, meta ) {
                                    return orderType[data];
                                }
                            },
                            {
                                "targets": 3,
                                class: 'text-center',
                                "render": function ( data, type, full, meta ) {
                                    var result = data;
                                    if (data == null){
                                        result = 1
                                    }
                                    return '<span style="display: block; padding: 5px;" class="label '+orderStatusColor[result]+'">'+orderStatus[result]+'</span>';
                                }
                            },
                            {
                                "targets": 4,
                                class: 'text-center',
                                "render": function ( data, type, full, meta ) {
                                    return '<span style="display: block; padding: 5px;" class="label '+orderPaymentColor[data]+'">'+orderPayment[data]+'</span>';
                                }
                            },
                            {
                                "targets": 5,
                                class: 'text-center',
                                "render": function ( data, type, full, meta ) {
                                    return '<span class="price">'+$.number(data)+'</span>';
                                }
                            },
                            {
                                "targets": 6,
                                "data": "customer",
                                "render": function ( data, type, full, meta ) {
                                    return '<a href="{{route('customer.detail')}}/' + full.cid +'">'+data+'</a>';
                                }
                            },
                            {
                                "targets": 7,
                                "render": function ( data, type, full, meta ) {
                                    return full.dsName + ' ' + full.psName;
                                }
                            },
                            {
                                "targets": 8,
                                "render": function ( data, type, full, meta ) {
                                    return full.drName + ' ' + full.prName;
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

                $('#daterange').daterangepicker(
                    {
                        ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        },
                        startDate: startDate,
                        endDate: endDate
                    },
                    function (start, end) {
                        $('#daterange span').html(start.format('DD/MM/YY') + ' - ' + end.format('DD/MM/YY'));
                        $('input[name=start_date]').val(start.format('DD/MM/YY'));
                        $('input[name=end_date]').val(end.format('DD/MM/YY'));
                        tableItem.draw();
                    }
                );

                $('.btn-order-type').click(function(e){
                    e.preventDefault();
                    $('.btn-order-type').removeClass('active');
                    $('input[name=type]').val($(this).data('type'));
                    $(this).addClass('active');
                    tableItem.draw();
                });

                $('.btn-order-payment').click(function(e){
                    e.preventDefault();
                    $('.btn-order-payment').removeClass('active');
                    $('input[name=payment]').val($(this).data('payment'));
                    $(this).addClass('active');
                    tableItem.draw();
                });

                $('.btn-order-status').click(function(e){
                    e.preventDefault();
                    $('.btn-order-status').removeClass('active');
                    $('input[name=status]').val($(this).data('type'));
                    $(this).addClass('active');
                    tableItem.draw();
                });

                $('input[name=search]').on( 'keyup', function (e) {
                    if (e.which == 13) {
                        tableItem.search( this.value ).draw();
                    }
                });
            }
        });
    </script>

@endsection
