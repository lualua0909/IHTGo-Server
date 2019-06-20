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
                                <th>{{ __('label.content') }}</th>
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
        </form>
    </section>
    <!-- /.content -->
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/admin')}}/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="{{asset('public/admin')}}/plugins/datepicker/datepicker3.css">
@endsection

@section('script')
    <script src="{{asset('public/admin')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/admin')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('public/admin')}}/plugins/datepicker/bootstrap-datepicker.js"></script>

    <script>
        $(function () {

            $('#datepicker').datepicker({
                autoclose: true,
                format:'dd/mm/yyyy'
            });

            if($("#tableItem").length > 0) {

                var tableItem = $("#tableItem").DataTable({
                    "processing": true,
                    "serverSide": true,
                    "searching": false,
                    "lengthChange": false,
                    "ajax": {
                        'type': "POST",
                        'url': "{{route('log.getList')}}",
                        "data": function (d) {
                            d.date = $('input[name=date]').val()
                        }
                    },
                    "columns": [
                        {"data": "content"},
                        {"data": 'created'}
                    ],
                    "columnDefs": [
                        {
                            "targets": 0,
                            "data": "code",
                            "render": function ( data, type, full, meta ) {
                                var result = JSON.parse(data)
                                return '<ul>' +
                                    '       <li>Time: ' + result.time + '</li>' +
                                    '       <li>User: ' + result.user + '</li>' +
                                    '       <li>Link: ' + result.screen + '</li>' +
                                    '   </ul>';
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
            }
        });
    </script>

@endsection