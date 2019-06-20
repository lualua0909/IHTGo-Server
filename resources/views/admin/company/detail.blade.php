@extends('layouts.admin')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-body box-profile">
                        <h3 class="profile-username text-center">{{$item->name}} </h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{__('label.phone')}}</b> <a class="pull-right">{{$item->phone}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{__('label.tax')}}</b> <a class="pull-right">{{$item->tax}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{__('label.address')}}</b> <a class="pull-right">{{$item->address}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{__('label.debt')}}</b> <button id="debt" class="btn btn-success pull-right">{{ __('label.export') }}</button>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-body">
                        <table id="itemTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('label.name') }}</th>
                                <th>{{ __('label.created') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($item->customer as $i)
                                <tr>
                                    <td><a target="_blank" href="{{route('customer.detail', $i->id)}}">{{ optional($i->user)->name }}</a></td>
                                    <td>{!! \App\Helpers\Util::showCreatedAt($i->created_at) !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <form action="" id="frChangeAvatar" method="post" enctype="multipart/form-data" style="display: none">
        {{ csrf_field() }}
        <input type="file" name="avatar" accept="image/jpeg, image/png" />
    </form>
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
                        <form role="form" target="_blank" action="{{route('company.export')}}" method="post" id="fr_export">
                            {{csrf_field()}}
                            <input type="hidden" name="company_id" value="{{$item->id}}" />
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


            if($("#itemTable").length > 0) {
                $("#itemTable").DataTable(
                    {
                        "order": [[ 1, "desc" ]],

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
                    }
                );
            }


        });
    </script>

@endsection