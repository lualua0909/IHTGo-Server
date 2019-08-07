@extends('layouts.admin')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-info"></i> {{__('label.customer_order')}}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-detail">
                            <tr>
                                <th>{{ __('label.customer_name') }}</th>
                                <td><a href="{{route('customer.detail', optional(optional($item->customer)->customer)->id)}}">{{ optional($item->customer)->name }}</a></td>
                            </tr>
                            <tr>
                                <th>{{ __('label.email') }}</th>
                                <td>{{ optional($item->customer)->email }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.phone') }}</th>
                                <td>{{ optional($item->customer)->phone }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.created') }}</th>
                                <td>{{ optional($item->customer)->created_at }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-info"></i> {{__('label.sender')}}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-detail">
                            <tr>
                                <th style="width: 40%">{{ __('label.sender_name') }}</th>
                                <td>{{ optional($item->detail)->sender_name }}</td>
                            </tr>
                            <tr>
                                <th style="width: 40%">{{ __('label.sender_phone') }}</th>
                                <td>{{ optional($item->detail)->sender_phone }}</td>
                            </tr>
                            <tr>
                                <th style="width: 40%">{{ __('label.sender_address') }}</th>
                                <td>{{ optional($item->detail)->sender_address . ', ' . optional(optional($item->detail)->districtSender)->name . ', ' . optional(optional($item->detail)->provinceSender)->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.created') }}</th>
                                <td>{{ optional($item->customer)->created_at }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-info"></i> {{__('label.receiver')}}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-detail">
                            <tr>
                                <th style="width: 40%">{{ __('label.receive_name') }}</th>
                                <td>{{ optional($item->detail)->receive_name }}</td>
                            </tr>
                            <tr>
                                <th style="width: 40%">{{ __('label.receive_phone') }}</th>
                                <td>{{ optional($item->detail)->receive_phone }}</td>
                            </tr>
                            <tr>
                                <th style="width: 40%">{{ __('label.receive_address') }}</th>
                                <td>{{ optional($item->detail)->receive_address . ', ' . optional(optional($item->detail)->districtReceive)->name . ', ' . optional(optional($item->detail)->provinceReceive)->name }}</td>
                            </tr>
                            <tr>
                                <th style="width: 40%">{{ __('label.receive_date') }}</th>
                                <td>{{ optional($item->detail)->receive_date }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-clock-o"></i> {{__('label.content')}}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-detail">
                            <tr>
                                <th>{{ __('label.name') }}</th>
                                <td>{{ $item->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.code') }}</th>
                                <td>{{ $item->code }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.coupon_code') }}</th>
                                <td>
                                    @if($item->coupon_code)
                                    {{ $item->coupon_code }}
                                        @else
                                        <form action="{{route('order.coupon_code', $item->id)}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" required id="coupon_code" value="{{(old('coupon_code')) ? old('coupon_code') : (($item) ? $item->coupon_code : '') }}" name="coupon_code" class="form-control" placeholder="{{ __('label.coupon_code') }}">
                                                <span class="has-error">{{$errors->first('coupon_code')}}</span>
                                            </div>
                                            <button class="btn pull-left btn-success">@lang('label.submit')</button>
                                        </form>
                                        @endif
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('label.created') }}</th>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.type_car') }}</th>
                                <td>{{ $orderType[$item->car_type] }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.payer') }}</th>
                                <td>{{ $listPayer[$item->payer] }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.speed') }}</th>
                                <td>{{ $listSpeed[$item->is_speed] }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.warehouse') }}</th>
                                <td>
                                    @if(optional($item->detail)->warehouse)
                                        {{optional(optional($item->detail)->warehouse)->code}}
                                        @else
                                        <button class="btn pull-right btn-warning" id="create_warehouse">{{ __('label.warehouse') }}</button>
                                    @endif
                                </td>
                            </tr>
                            @if($item->car_option)
                                <tr>
                                    <th>{{ __('label.th') }}</th>
                                    <td>
                                        @if($item->car_option)
                                            <button class="{{$listTypeColor[$item->car_option]}}">{{ $listType[$item->car_option] }}</button>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th>{{ __('label.total_price') }}</th>
                                @if($item->total_price == '-1')
                                    <td><input type="text" value="" class="price" id="editPrice" /> <button class="btn btn-success" id="buttonPrice">@lang('label.submit')</button></td>
                                @else
                                <td class="price">{{ $item->total_price }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>{{ __('label.weight') }}</th>
                                <td>{{optional($item->detail)->weight}}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.take_money') }}</th>
                                <td>{{optional($item->detail)->take_money}}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.payment_type') }}</th>
                                <td><button class="{{$orderMethodColor[$item->payment_type]}}">{{ $orderMethod[$item->payment_type] }}</button></td>
                            </tr>
                            <tr>
                                <th>{{ __('label.payment') }}</th>
                                <td>
                                    @if($item->is_payment)
                                        <button class="{{$orderPaymentColor[$item->is_payment]}}">{{ $orderPayment[$item->is_payment] }}</button>
                                        @else
                                    <form action="{{route('order.payment', $item->id)}}" method="post">
                                        @csrf
                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="is_payment" value="{{\App\Helpers\Business::PAYMENT_DONE}}">
                                                @lang('label.payment_done')
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="is_payment" value="{{\App\Helpers\Business::PAYMENT_DEPT}}">
                                                @lang('label.payment_dept')
                                            </label>
                                        </div>
                                        <button class="btn pull-left btn-success">@lang('label.submit')</button>
                                    </div>
                                    </form>
                                        @endif
                                </td>

                            </tr>
                            <tr>
                            <th>{{ __('label.note') }}</th>
                            <td>{{optional($item->detail)->note}}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.driver_note') }}</th>
                                <td>{{optional($item->detail)->driver_note}}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.admin_note') }}</th>
                                <td>
                                    @if(optional($item->detail)->admin_note)
                                        {{ optional($item->detail)->admin_note }}
                                    @else
                                        <form action="{{route('order.admin_note', $item->id)}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" required id="admin_note" value="{{(old('admin_note')) ? old('admin_note') : (($item) ? $item->admin_note : '') }}" name="admin_note" class="form-control" placeholder="{{ __('label.admin_note') }}">
                                                <span class="has-error">{{$errors->first('admin_note')}}</span>
                                            </div>
                                            <button class="btn pull-left btn-success">@lang('label.submit')</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @if($item->delivery)
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-clock-o"></i> {{__('label.delivery_detail')}}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-detail">
                            <tr>
                                <th>{{ __('label.status') }}</th>
                                <td><button data-status="{{$item->status}}" class="{{$orderStatusColor[$item->status]}} {{ ($item->status == \App\Helpers\Business::ORDER_STATUS_DONE_DELIVERY || $item->status == \App\Helpers\Business::ORDER_STATUS_CUSTOMER_CANCEL || $item->status == \App\Helpers\Business::ORDER_STATUS_IHT_CANCEL) ? '' : 'select-status' }}">{{ $orderStatus[$item->status] }}</button></td>
                            </tr>
                            <tr>
                                <th>{{ __('label.user_delivery') }}</th>
                                <td><a href="{{route('user.detail', $item->delivery->user->id)}}">{{ $item->delivery->user->name }}</a></td>
                            </tr>
                            <tr>
                                <th>{{ __('label.driver') }}</th>
                                <td><a href="{{route('driver.detail', $item->delivery->driver->id)}}">{{ $item->delivery->driver->user->name }}</a></td>
                            </tr>
                            <tr>
                                <th>{{ __('label.car') }}</th>
                                <td><a href="{{route('car.detail', $item->delivery->car->id)}}">{{ $item->delivery->car->name . ' (' . $item->delivery->car->number . ')' }}</a></td>
                            </tr>
                            <tr>
                                <th>{{ __('label.driver_note') }}</th>
                                <td>{{ optional($item->detail)->driver_note }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.delete') }}</th>
                                <td><a onclick="return confirm_delete('{{ __('label.are_you_sure') }}')" href="{{route('delivery.delete', $item->delivery->id)}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-close"></i>
                                    </a></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-clock-o"></i> Lịch sử giao hàng</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-detail">
                            @foreach($item->route as $route)
                                @if($route->status == \App\Helpers\Business::ORDER_DELIVERY_GIAO)
                                    <tr>
                                        <th>Thời gian giao</th>
                                        <td>{{$route->date}}</td>
                                    </tr>
                                    @elseif($route->status == \App\Helpers\Business::ORDER_DELIVERY_BEING)
                                    <tr>
                                        <th>Thời gian nhận</th>
                                        <td>{{$route->date}}</td>
                                    </tr>
                                @elseif($route->status == \App\Helpers\Business::ORDER_DELIVERY_DONE)
                                    <tr>
                                        <th>Thời gian hoàn thành</th>
                                        <td>{{$route->date}}</td>
                                    </tr>
                                @elseif($route->status == \App\Helpers\Business::ORDER_DELIVERY_FAIL)
                                    <tr>
                                        <th>Thời gian huỷ</th>
                                        <td>{{$route->date}}</td>
                                    </tr>
                                    @endif

                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            @else
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-clock-o"></i> {{__('label.delivery_detail')}}</h3>
                        </div>
                        <div class="box-body">
                            <button class="{{$orderStatusColor[$item->status]}}">{{ $orderStatus[$item->status] }}</button>
                            <br>
                            @if($item->status == \App\Helpers\Business::ORDER_STATUS_WAITING)
                                <div class="pull-right">
                                    <button class="btn pull-right btn-success" id="create_delivery">{{ __('label.create_delivery') }}</button>
                                    --  OR --
                                    <button class="btn pull-left btn-primary" id="create_driver">{{ __('label.create_delivery_driver') }}</button>
                                </div>

                                <a  onclick="return confirm_delete('{{ __('label.are_you_sure') }}')" href="{{route('order.updateStatus', ['id' => $item->id, 'status' => \App\Helpers\Business::ORDER_STATUS_IHT_CANCEL])}}" class="btn btn-danger pull-left">{{ __('label.cancel_order') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal fade modal-success" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">{{ __('label.create_delivery') }}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <form role="form" action="{{route('delivery.store')}}" method="post" id="fr_delivery">
                                        {{csrf_field()}}
                                        <input type="hidden" name="order_id" value="{{$item->id}}" />
                                        <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" />
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('label.driver') }} (*)</label>
                                                <select class="form-control select2 class_driver" id="id_driver" required name="driver_id"
                                                        title="{{ __('label.driver') }}" style="width: 100%">
                                                    <option value="0"
                                                            selected>{{ __('label.please_choose_field') }}</option>
                                                </select>
                                                <span class="has-error">{{$errors->first('driver_id')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('label.car') }} (*)</label>
                                                <select class="form-control select2" id="id_car" required name="car_id"
                                                        title="{{ __('label.car') }}" style="width: 100%">
                                                    <option value="0"
                                                            selected>{{ __('label.please_choose_field') }}</option>
                                                </select>
                                                <span class="has-error">{{$errors->first('car_id')}}</span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">{{ __('label.cancel') }}</button>
                                <button type="button" class="btn btn-outline" id="submit">{{ __('label.submit') }}</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div>
                <div class="modal fade modal-primary" id="myModalDriver" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">{{ __('label.create_delivery') }}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <form role="form" action="{{route('delivery.storeDriver')}}" method="post" id="fr_delivery_driver">
                                        {{csrf_field()}}
                                        <input type="hidden" name="order_id" value="{{$item->id}}" />
                                        <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" />
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('label.driver') }} (*)</label>
                                                <select class="form-control select2 class_driver" id="id_driver_only" required name="id_driver_only"
                                                        title="{{ __('label.driver') }}" style="width: 100%">
                                                    <option value="0"
                                                            selected>{{ __('label.please_choose_field') }}</option>
                                                </select>
                                                <span class="has-error">{{$errors->first('id_driver_only')}}</span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">{{ __('label.cancel') }}</button>
                                <button type="button" class="btn btn-outline" id="submitDriver">{{ __('label.submit') }}</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div>
            @endif
        </div>
        <div class="box box-danger">
            <div class="box-body">
                <div class="row margin-bottom">
                    @foreach($item->images as $k => $image)
                        <div class="col-sm-3">
                            <a href="{{route('api.image.show', ['id' => $image->id])}}" data-fancybox data-caption="Caption for single image">
                                <img class="img-responsive" src="{{route('api.image.show', ['id' => $image->id, 'type' => $image->type])}}" alt="Photo">                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="box box-success">
            <div class="box-body">
                {!! $map['html'] !!}
                <div id="directionsDiv"></div>
            </div>
        </div>
    </section>

    <div class="modal fade modal-warning" id="myWarehouse" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">{{ __('label.warehouse') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form role="form" action="{{route('order.warehouse')}}" method="post" id="fr_warehouse">
                            {{csrf_field()}}
                            <input type="hidden" name="order_id" value="{{$item->id}}" />
                            <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" />
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __('label.warehouse') }} (*)</label>
                                    <select class="form-control select2" id="id_warehouse" required name="id_warehouse"
                                            title="{{ __('label.warehouse') }}" style="width: 100%">
                                        <option value="0"
                                                selected>{{ __('label.please_choose_field') }}</option>
                                        @foreach($listWarehouse as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->code }}</option>
                                        @endforeach
                                    </select>
                                    <span class="has-error">{{$errors->first('id_warehouse')}}</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">{{ __('label.cancel') }}</button>
                    <button type="button" class="btn btn-outline" id="submitWarehouse">{{ __('label.submit') }}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/admin')}}/plugins/select2/select2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css">
    <style type="text/css">
        table.table-detail th {
            background-color: #e8e8e8;
            color: #0a0a0a;
            text-align: center;
        }

    </style>
@endsection

@section('script')
    {!! $map['js'] !!}
    <script src="{{asset('public/admin')}}/plugins/select2/select2.js"></script>
    <script src="{!! asset('public/js/sweetalert2.js') !!}"></script>
    <script src="{!! asset('public/admin/dist/js/jquery.number.min.js') !!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    <script>
        $( document ).ready(function() {
            $('.select2').select2();
            $('.price').number( true, 0 );

            if($('#create_delivery').length > 0){
                $('#create_delivery').on('click', function(){
                    $('#myModal').modal('show');
                });
            }

            if($('#create_driver').length > 0){
                $('#create_driver').on('click', function(){
                    $('#myModalDriver').modal('show');
                });
            }

            if($('#create_warehouse').length > 0){
                $('#create_warehouse').on('click', function(){
                    $('#myWarehouse').modal('show');
                });
            }

            if (($('#id_driver').length > 0 && $('#id_car').length > 0) || $('#id_driver_only').length > 0) {
                $('.class_driver').select2({
                    language: {
                        inputTooShort: function () {
                            return '{{__('label.please_enter_2_character')}}';
                        },
                        searching: function() {
                            return "{{__('label.searching')}}...";
                        },
                        loadingMore: function() {
                            return "{{__('label.loading_more_results')}}";
                        },
                        noResults: function() {
                            return "{{__('label.no_results_found')}}";
                        },
                    },
                    ajax: {
                        url: '{{route('driver.ajaxSelect2')}}',
                        data: function (params) {
                            var query = {
                                keyword: params.term,
                            }

                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name + ' (' + item.phone + ')',
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });

                $('#id_car').select2({
                    language: {
                        inputTooShort: function () {
                            return '{{__('label.please_enter_2_character')}}';
                        },
                        searching: function() {
                            return "{{__('label.searching')}}...";
                        },
                        loadingMore: function() {
                            return "{{__('label.loading_more_results')}}";
                        },
                        noResults: function() {
                            return "{{__('label.no_results_found')}}";
                        },
                    },
                    ajax: {
                        url: '{{route('car.ajax')}}',
                        data: function (params) {
                            var query = {
                                searchtext: params.term,
                            }

                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name + ' (' + item.number + ' - ' + item.weight + ')',
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });

                $('#submit').on('click', function () {
                    if ($('#id_car').val() >0 && $('#id_driver').val() > 0){
                        $('#fr_delivery').submit();
                    } else {
                        alert('vui long chon day du cac yeu cau');
                        return false;
                    }
                });

                $('#submitDriver').on('click', function () {
                    if ($('#id_driver_only').val() > 0){
                        $('#fr_delivery_driver').submit();
                    } else {
                        alert('vui long chon day du cac yeu cau');
                        return false;
                    }
                });
            }

            $('#submitWarehouse').on('click', function () {
                if ($('#id_warehouse').val() > 0){
                    $('#fr_warehouse').submit();
                } else {
                    alert('vui long chon day du cac yeu cau');
                    return false;
                }
            });

            $('.select-status').on('click', function(){
                var statusThis = parseInt($(this).data('status'));
                var id = {{$item->id}};
                var showCancelButton = false;
                var confirmButtonText = '{{ __('label.order_active') }}';
                var cancelButtonText = '{{ __('label.cancel_order') }}';
                if(statusThis == 1){
                    showCancelButton = true;
                }else if(statusThis == 2){
                    showCancelButton = true;
                    confirmButtonText = '{{ __('label.being_delivery') }}';
                }else if(statusThis == 3){
                    confirmButtonText = '{{ __('label.change_status') }}';
                }

                Swal.fire({
                    title: '{{ __('label.are_you_sure') }}',
                    text: '{{ __('label.change_status') }}',
                    type: 'warning',
                    showCancelButton: showCancelButton,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: cancelButtonText,
                    showCloseButton: true
                }).then( function(result) {
                    if (result.value) {
                        $.ajax({
                            url: '{{route('order.update')}}/' + id,
                            type: 'POST',
                            cache: false,
                            data: {'status': statusThis + 1},
                            success: function(response){
                                if(response.code == 200){
                                    window.location.reload(true);
                                }else{
                                    Swal.fire(
                                        '{{ __('label.failed') }}',
                                        '',
                                        'error'
                                    )
                                }
                            }
                        });
                    } else if (
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        $.ajax({
                            url: '',
                            type: 'POST',
                            cache: false,
                            data: {'status': {{\App\Helpers\Business::ORDER_STATUS_IHT_CANCEL}} },
                            success: function(response){
                                if(response.code == 200){
                                    window.location.reload(true);
                                }else{
                                    Swal.fire(
                                        '{{ __('label.failed') }}',
                                        '',
                                        'error'
                                    )
                                }
                            }
                        });
                    }
                })
            });
            
            $('#buttonPrice').on('click', function () {
                var price = $('#editPrice').val();
                $.post("{{route('order.ajaxPrice')}}/{{$item->id}}",
                    {
                        price: price
                    },
                    function(data, status){
                        if (status == 'success'){
                            window.location.reload(true);
                        } else {
                            alert('co loi, vui long thu lai');
                        }
                    });
            })

        });

    </script>
@endsection
