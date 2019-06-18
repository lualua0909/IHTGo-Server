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
                                <th>{{ __('label.stt') }}</th>
                                <th>{{ __('label.from_name') }}</th>
                                <th>{{ __('label.to_name') }}</th>
                                <th>{{ __('label.type') }}</th>
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
        </form>
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
                            'url': "{{route('evaluate.post.list')}}",
                            "data": function (d) {
                                d.type = $('input[name=type]').val(),
                                    d.keyword = $('input[name=search]').val()
                            }
                        },
                        "columns": [
                            {"data": "id"},
                            {"data": "from_name"},
                            {"data": 'to_name'},
                            {"data": "type"},
                            {"data": "created_at"}
                        ],
                        "columnDefs": [
                            {
                                "targets": 0,
                                "data": "id",
                                "render": function ( data, type, full, meta ) {
                                    return '<a href="{{route('evaluate.detail')}}/' + full.id +'">#'+data+'</a>';
                                }
                            },
                            {
                                "targets": 3,
                                class: 'text-center',
                                "render": function ( data, type, full, meta ) {
                                    return '<span style="display: block; padding: 5px;" class="label '+customerTypeColor[data]+'">'+customerType[data]+'</span>';
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
            }
        });
    </script>

@endsection