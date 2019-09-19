@extends('layouts.admin')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-success">
                <div class="box-body box-profile">
                    <button class="btn btn-sm pull-right btn-update-avatar" data-toggle="tooltip" data-placement="bottom" title="Update Avatar"><i class="fa fa-pencil-square-o"></i></button>
                    <img class="profile-user-img img-responsive img-circle" src="{{ optional($item->user)->image ? route('api.image.show', ['id' => optional($item->user->image)->id, 'type' => optional($item->user->image)->type]) : '' }}">

                    <h3 class="profile-username text-center">{{optional($item->user)->name}} </h3>
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
                        @if($item->type == \App\Helpers\Business::CUSTOMER_TYPE_COMPANY)
                            <li class="list-group-item">
                                <b>{{__('label.company')}}</b> <a class="pull-right">{{optional($item->company)->name}}</a>
                            </li>
                        @endif
                        <li class="list-group-item">
                            <b>{{__('label.birthday')}}</b> <a class="pull-right">{{ optional($item->user)->birthday}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{__('label.address')}}</b> <a class="pull-right">{{$item->address}}</a>
                        </li>
                    </ul>
                    @if(!$item->user->activated)
                        <a onclick="return confirm_delete('{{ __('label.are_you_sure') }}')" href="{{route('customer.activated', $item->id)}}" class="btn btn-success btn-block"><b>{{__('label.active')}}</b></a>
                    @endif
                    <a class="btn {{$item->user->baned ? 'btn-success' : 'btn-danger'}} btn-block btn-baned"><b>{{ ($item->user->baned) ? __('label.un_baned') : __('label.baned') }}</b></a>
                    <a class="btn btn-warning btn-block btn-delete"><b>Xoá tài khoản</b></a>
                    <a class="btn btn-info btn-block"  data-toggle="modal" data-target="#changeInfo"><b>Thay đổi thông tin</b></a>
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
                            <th>Mã bill</th>
                            <th>Tên đơn hàng</th>
                            <th>{{ __('label.payment_type') }}</th>
                            <th>{{ __('label.status') }}</th>
                            <th>{{ __('label.total_price') }}</th>
                            <th>{{ __('label.created') }}</th>
                            <th></th>
                        </tr>
                        </thead>

                        @if(optional($item->user)->multiOrder)
                            <tbody>
                            @foreach($item->user->multiOrder as $i)
                                <tr>
                                    <td><a target="_blank" href="{{route('order.detail', $i->id)}}">{{ $i->coupon_code }}</a></td>
                                    <td><a target="_blank" href="{{route('order.detail', $i->id)}}">{{ $i->name }}</a></td>
                                    <td><span style="display: block; padding: 5px;" class="label {{$orderMethodColor[$i->payment_type]}}">{{ $orderMethod[$i->payment_type] }}</span></td>
                                    <td><span style="display: block; padding: 5px;" class="label {{$orderStatusColor[$i->status]}}">{{ $orderStatus[$i->status] }}</span></td>
                                    <td class="price">{{ $i->total_price }}</td>
                                    <td>{{date_format($i->created_at,"d/m/Y H:i:s")}}</td>
                                    @if(Auth::user()->level==1)
                                    <td> 
                                        @if($i->status==1)
                                        <a type="button" class="btn btn-danger" href="../../order/order-delete/{{$i->id}}">Xóa</a>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<form action="{{route('image.web.store')}}" id="frChangeAvatar" method="post" enctype="multipart/form-data" style="display: none">
    {{ csrf_field() }}
    <input type="file" name="file" accept="image/jpeg, image/png" />
    <input type="text" name="service_id" value="{{$item->user_id}}" />
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
                    <form role="form" target="_blank" action="{{route('dept.export')}}" method="post" id="fr_export">
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
<!-- Modal -->
<div id="changeInfo" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Thông tin:<strong> {{optional($item->user)->name}} </strong></h4>
        </div>
        <form class="form-horizontal" action="/action_page.php">
            <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-sm-2" >{{__('label.phone')}}:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name='phone' placeholder="Enter phone" value="{{$item->user->phone}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" >{{__('label.email')}}:</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" name='email' placeholder="Enter email" value="{{$item->user->email}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" >{{__('label.address')}}:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name='address' placeholder="Enter address" value="{{$item->address}}">
                        </div>
                    </div>
                    <div class="form-group"> 
                        <label class="control-label col-sm-2" >{{__('label.type')}}:</label>
                        <label class="radio-inline"><input type="radio" name="type" value="1">Cá nhân</label>
                        <label class="radio-inline"><input type="radio" name="type" value="2">Công ty</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
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
    <script src="{!! asset('public/admin/dist/js/jquery.number.min.js') !!}"></script>
    <script src="{!! asset('public/js/sweetalert2.js') !!}"></script>
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
                $('input[name=file]').click();
                $('input[name=file]').change(function(e){
                    $('#frChangeAvatar').submit();
                });
            });

            $('.btn-baned').click(function(e){
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Bạn muốn thay đổi trạng thái!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xác nhận!',
                    buttons: ["Cancel", "{{ ($item->user->baned) ? __('label.un_baned') : __('label.baned')}}"],
                }).then((willDelete) => {
                    if (willDelete.value) {
                        $.ajax({
                            type: "post",
                            url: "{{route('user.ajaxBaned', $item->user_id)}}",
                        }).done(function (data) {
                            if (data.code == 200) {
                                window.location.reload(true);
                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: data.message,
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });

            $('.btn-delete').click(function(e){
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Bạn muốn xoá vĩnh viễn khách hàng!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xác nhận!',
                }).then((willDelete) => {
                    if (willDelete.value) {
                        window.location.href = '{{route('user.deleteForce', $item->user_id)}}'
                    }
                });
            });
        });
    </script>

@endsection