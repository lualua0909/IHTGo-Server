@extends('layouts.admin')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-success">
                <div class="box-body box-profile">
                    <button class="btn btn-sm pull-right btn-update-avatar" data-toggle="tooltip" data-placement="bottom" title="Update Avatar"><i class="fa fa-pencil-square-o"></i></button>
                    <img class="profile-user-img img-responsive img-circle" src="">

                    <h3 class="profile-username text-center">{{$item->user->name}} </h3>
                    <h5 class="text-center">{{($item->code) ? $item->code : ''}}</h5>

                    <p class="text-muted text-center" data-toggle="tooltip" data-placement="top">
                        <span class="label label-info">{{$userStatus[$item->user->activated]}}</span>
                        <span class="label label-warning">{{$userBaned[$item->user->baned]}}</span>
                    </p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>{{__('label.phone')}}</b> <a class="pull-right">{{$item->user->phone}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('label.email')}}</b> <a class="pull-right">{{$item->user->email}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('label.gender')}}</b> <a class="pull-right">{{$genderType[$item->user->gender]}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('label.type')}}</b> <a class="pull-right">{{$customerType[$item->type]}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('label.birthday')}}</b> <a class="pull-right">{{ optional($item->user)->birthday}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('label.address')}}</b> <a class="pull-right">{{$item->address}}</a>
                        </li>
                        @if($item->type == \App\Helpers\Business::CUSTOMER_TYPE_COMPANY)
                            <li class="list-group-item">
                                <b>{{__('label.phone_company')}}</b> <a class="pull-right">{{$item->phone_company}}</a>
                            </li>
                             <li class="list-group-item">
                                 <b>{{__('label.tax_code')}}</b> <a class="pull-right">{{$item->tax_code}}</a>
                             </li>
                            <li class="list-group-item">
                                <b>{{__('label.debt')}}</b> <button id="debt" class="btn btn-success pull-right">{{ __('label.export') }}</button>
                            </li>
                         @endif
                    </ul>
                    @if(!$item->user->activated)
                        <a onclick="return confirm_delete('{{ __('label.are_you_sure') }}')" href="{{route('customer.activated', $item->id)}}" class="btn btn-success btn-block"><b>{{__('label.active')}}</b></a>
                    @endif
                    <a class="btn btn-danger btn-block btn-baned"><b>{{ ($item->user->baned) ? __('label.un_baned') : __('label.baned') }}</b></a>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>{{ __('label.code') }}</th>
                            <th>{{ __('label.payment_type') }}</th>
                            <th>{{ __('label.status') }}</th>
                            <th>{{ __('label.total_price') }}</th>
                            <th>{{ __('label.created') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($item->order as $i)
                            <tr>
                                <td><a target="_blank" href="{{route('order.detail', $i->id)}}">{{ $i->code }}</a></td>
                                <td><span style="display: block; padding: 5px;" class="label {{$orderMethodColor[$i->payment_type]}}">{{ $orderMethod[$i->payment_type] }}</span></td>
                                <td><span style="display: block; padding: 5px;" class="label {{$orderStatusColor[$i->status]}}">{{ $orderStatus[$i->status] }}</span></td>
                                <td class="price">{{ $i->total_price }}</td>
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
                    <form role="form" target="_blank" action="{{route('customer.exportDebt')}}" method="post" id="fr_export">
                        {{csrf_field()}}
                        <input type="hidden" name="customer_id" value="{{$item->id}}" />
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
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/datepicker/datepicker3.css">
@endsection

@section('script')
    <script src="{{asset('admin')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('admin')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{!! asset('public/admin/dist/js/jquery.number.min.js') !!}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
    <script src="{{asset('admin')}}/plugins/datepicker/bootstrap-datepicker.js"></script>
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

            $('.price').number( true, 0 );

            if($("#example1").length > 0) {
                $("#example1").DataTable(
                    {
                        "order": [[ 4, "desc" ]],

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

            $('.btn-update-avatar').click(function (e) {
                e.preventDefault();
                $('input[name=avatar]').click();
                $('input[name=avatar]').change(function(e){
                    $('#frChangeAvatar').submit();
                });
            });

            $('.btn-baned').click(function(e){
                e.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "{{__('label.change_baned_customer')}}",
                    icon: "warning",
                    dangerMode: true,
                    buttons: ["Cancel", "{{ ($item->user->baned) ? __('label.un_baned') : __('label.baned')}}"],
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "post",
                            url: "{{route('user.ajaxBaned', $item->user_id)}}",
                        }).done(function (data) {
                            if (data.code == 200) {
                                window.location.reload(true);
                            } else {
                                swal({
                                    title: "Error!",
                                    text: data.message,
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

@endsection