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
                            <a href="{{route('collection.add')}}" class="btn btn-success btn-sm">
                                <i class="fa fa-plus"></i> {{ __('label.add_new') }}</a>
                        </div>
                    @endcan
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="tableItem" class="table table-bordered table-striped">
                            <thead>
                            <tr class="info">
                                <th>{{ __('label.name') }}</th>
                                <th>{{ __('label.money') }}</th>
                                <th>{{ __('label.status') }}</th>
                                <th>{{ __('label.user') }}</th>
                                <th>{{ __('label.employee') }}</th>
                                <th>{{ __('label.created') }}</th>
                                <th>{{ __('label.action') }}</th>
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
            <input name="name" type="hidden"/>
            <input name="address" type="hidden"/>
        </form>
    </section>
    <!-- /.content -->
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/admin')}}/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('script')
    <script src="{{asset('public/admin')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/admin')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{!! asset('public/admin/dist/js/jquery.number.min.js') !!}"></script>
    <script>
        $(function () {
            if($("#tableItem").length > 0) {

                var deptStatusColor = [];
                var deptStatus = [];
                @foreach($deptStatusColor as $k => $v)
                    deptStatusColor[{{$k}}] = '{{$v}}';
                @endforeach
                @foreach($deptStatus as $k => $v)
                    deptStatus[{{$k}}] = '{{$v}}';
                @endforeach

                var tableItem = $("#tableItem").DataTable({
                    "processing": true,
                    "serverSide": true,
                    "searching": false,
                    "lengthChange": false,
                    "order": [[5, "desc"]],
                    "ajax": {
                        'type': "POST",
                        'url': "{{route('collection.post.list')}}",
                        "data": function (d) {
                                d.name = $('input[name=name]').val(),
                                d.address = $('input[name=address]').val()
                        }
                    },
                    "columns": [
                        {"data": "name"},
                        {"data": "money"},
                        {"data": "status"},
                        {"data": "user"},
                        {"data": "employee"},
                        {"data": "created_at"},
                        {"data": "id"}
                    ],
                    "columnDefs": [
                        {
                            "targets": 0,
                            "data": "code",
                            "render": function ( data, type, full, meta ) {
                                return data;
                            }
                        },
                        {
                            "targets": 1,
                            class: 'text-center',
                            "render": function ( data, type, full, meta ) {
                                return '<span class="price">'+$.number(data)+'</span>';
                            }
                        },
                        {
                            "targets": 2,
                            "data": "code",
                            "render": function ( data, type, full, meta ) {
                                return '<span style="display: block; padding: 5px;" class="label '+deptStatusColor[data]+'">'+deptStatus[data]+'</span>';
                            }
                        },
                        {
                            "targets": 6,
                            "data": "id",
                            "render": function ( data, type, full, meta ) {
                                $('#' + data).click( function () {
                                    if ( confirm( "Are you sure you want to delete the selected rows?" ) ) {
                                        $('#frm-delete' + data).submit();
                                    }
                                } );
                                return '<a ' +
                                    'href="/admin/collection/edit/' + data + '"' +
                                    'class="btn btn-primary">' +
                                    '<i class="fa fa-edit"></i> ' +
                                    '</a> ' +
                                    '<button id="' + data + '" data-placement="top" data-original-title="Delete permanently" data-toggle="modal" class="tooltips btn btn-danger btn-delete btn-table-destroy red-intense"><i class="fa fa-times"></i> </button>' +
                                    '<form id="frm-delete' + data +'" action="/admin/collection/' + data + '"method="post">' +
                                    '    {{ csrf_field() }}' +
                                    '    {{ method_field("DELETE") }}' +
                                    '</form>';
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
            }
        });
    </script>

@endsection