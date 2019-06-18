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
                            <input name="date" type="text" id="datepicker" class="form-control" />
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
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
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/datepicker/datepicker3.css">
@endsection

@section('script')
    <script src="{{asset('admin')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('admin')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('admin')}}/plugins/datepicker/bootstrap-datepicker.js"></script>

    <script>
        $(function () {

            $('#datepicker').datepicker({
                autoclose: true,
                format:'mm/yyyy'
            });

            if($("#tableItem").length > 0) {

                var tableItem = $("#tableItem").DataTable({
                        "processing": true,
                        "serverSide": true,
                        "searching": false,
                        "lengthChange": false,
                        "ajax": {
                            'type': "POST",
                            'url': "{{route('dept.post.list')}}",
                            "data": function (d) {
                                d.date = $('input[name=date]').val()
                            }
                        },
                        "columns": [
                            {"data": "name"},
                            {"data": 'phone'},
                            {"data": 'email'},
                            ],
                        "columnDefs": [
                            {
                                "targets": 0,
                                "data": "id",
                                "render": function ( data, type, full, meta ) {
                                    return '<a href="{{route('customer.detail')}}/' + full.id + '">#'+data+'</a>';
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

                $('input[name=date]').on( 'change', function (e) {
                    tableItem.search( this.value ).draw();
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