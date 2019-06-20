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
                    <div class="col-md-3 col-md-offset-9">
                        <div class="box-tools pull-right">
                            <button id="debt" class="btn btn-success pull-right">{{ __('label.export') }}</button>
                        </div>
                    </div>
                    <br><br>
                    <div class="col-md-12">
                        <table id="tableItem" class="table table-bordered table-striped">
                            <thead>
                                <tr class="info">
                                    <th>{{ __('label.name') }}</th>
                                    <th>{{ __('label.from') }}</th>
                                    <th>{{ __('label.to') }}</th>
                                    <th>{{ __('label.money') }}</th>
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

    <div class="modal fade modal-success" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">{{ __('label.export') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form role="form" target="_blank" action="{{route('dept.export')}}" method="post" id="fr_export">
                            {{csrf_field()}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('label.start_date')}}  (*):</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="start_date" class="form-control pull-right" id="start_date" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('label.end_date')}}  (*):</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="end_date" class="form-control pull-right" id="end_date" required />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">{{ __('label.cancel') }}</button>
                    <button type="button" class="btn btn-outline" id="submit">{{ __('label.export') }}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/admin')}}/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="{{asset('public/admin')}}/plugins/datepicker/datepicker3.css">
@endsection

@section('script')
    <script src="{{asset('public/admin')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/admin')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{{asset('public/admin')}}/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="{!! asset('public/admin/dist/js/jquery.number.min.js') !!}"></script>
    <script>
        $(function () {
            $('#start_date, #end_date').datepicker({
                autoclose: true,
                format:'dd/mm/yyyy'
            });
            if($('#debt').length > 0){
                $('#debt').on('click', function(){
                    $('#myModal').modal('show');
                });
            }

            $('#submit').on('click', function () {
                $('#fr_export').submit();
                $('#myModal').modal('hide');
            });

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
                            {"data": 'from'},
                            {"data": 'to'},
                            {"data": 'money'}
                            ],
                        "columnDefs": [
                            {
                                "targets": 3,
                                "data": "id",
                                "render": function ( data, type, full, meta ) {
                                    return '<span>'+$.number(data)+'</span>';
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