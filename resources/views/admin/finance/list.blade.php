@extends('layouts.admin')
@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $title }}</h3>
                @can('create-finance')
                    <div class="box-tools pull-right">
                        <a href="{{route('finance.add', \App\Helpers\Business::FINANCE_TYPE_IN)}}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> {{ __('label.add_new') . ' ' . __('label.finance_in') }}</a>
                        <a href="{{route('finance.add', \App\Helpers\Business::FINANCE_TYPE_OUT)}}" class="btn btn-warning btn-sm">
                            <i class="fa fa-plus"></i> {{ __('label.add_new') . ' ' . __('label.finance_out') }}</a>
                    </div>
                @endcan
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-default btn-block" id="daterange">
                            <i class="fa fa-calendar"></i>
                            <span> Last 30 Days</span>
                            <i class="fa fa-caret-down"></i>
                        </button>
                    </div>
                    <div class="col-md-8 pull-right">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-primary btn-finance-type active" data-type="">All</button>
                            @foreach($financeType as $k => $v)
                                <button type="button" class="btn btn-primary btn-finance-type" data-type="{{$k}}">{{$v}}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <table id="tableItem" class="table table-bordered table-striped">
                            <thead>
                            <tr class="info">
                                <th>{{ __('label.name') }}</th>
                                <th>{{ __('label.type') }}</th>
                                <th>{{ __('label.total_price') }}</th>
                                <th>{{ __('label.employer') }}</th>
                                <th>{{ __('label.date') }}</th>
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
        <form id="" target="_blank" method="post" action="" style="display: none">
            {{ csrf_field() }}
            <input name="type" type="hidden"/>
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

                var financeTypeColor = [];
                var financeType = [];


                @foreach($financeTypeColor as $k => $v)
                    financeTypeColor[{{$k}}] = '{{$v}}';
                @endforeach
                @foreach($financeType as $k => $v)
                    financeType[{{$k}}] = '{{$v}}';
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
                    "order": [[4, "desc"]],
                    "ajax": {
                        'type': "POST",
                        'url': "{{route('finance.getList')}}",
                        "data": function (d) {
                            d.type = $('input[name=type]').val(),
                            d.startDate = $('input[name=start_date]').val(),
                            d.endDate = $('input[name=end_date]').val()
                        }
                    },
                    "columns": [
                        {"data": "name"},
                        {"data": 'type'},
                        {"data": 'total'},
                        {"data": "employee"},
                        {"data": "date"},
                        {"data": "created_at"}
                    ],
                    "columnDefs": [
                        {
                            "targets": 0,
                            "data": "name",
                            "render": function ( data, type, full ) {
                                return '<a href="{{route('finance.edit')}}/' + full.type + '/' + full.id +'">#'+data+'</a>';
                            }
                        },
                        {
                            "targets": 1,
                            class: 'text-center',
                            "render": function ( data ) {
                                return '<span style="display: block; padding: 5px;" class="label '+financeTypeColor[data]+'">'+financeType[data]+'</span>';
                            }
                        },
                        {
                            "targets": 2,
                            class: 'text-center',
                            "render": function ( data) {
                                //$('.price').number( true, 0 );
                                //$.number(data);
                                return '<span class="price">'+$.number(data)+'</span>';
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

                $('.btn-finance-type').click(function(e){
                    e.preventDefault();
                    $('.btn-finance-type').removeClass('active');
                    $('input[name=type]').val($(this).data('type'));
                    $(this).addClass('active');
                    tableItem.draw();
                });
            }
        });
    </script>

@endsection