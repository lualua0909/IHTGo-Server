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
                        </table>
                    </div>
                </div>
            </div>
            <!-- form thông tin người gửi -->
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
                                <td id="sender_address">{{ optional($item->detail)->sender_address }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- form thông tin người nhận -->
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
                                <td id="receive_address">{{ optional($item->detail)->receive_address }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- form thông tin đơn hàng-->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-clock-o"></i> {{__('label.content')}}</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-detail">
                                <tr>
                                    <th>QRCode</th>
                                    <td>{!! QrCode::size(100)->generate($item->code); !!} <br> {{$item->code}}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('label.name') }}</th>
                                    <td>{{ $item->name }}</td>
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
                                    <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('label.payer') }}</th>
                                    <td>
                                        <select class="form-control" id="payer">
                                            <option @if($item->payer==1) selected @endif value="1"> Người nhận</option>
                                            <option @if($item->payer==2) selected @endif value="2">Người gửi</option>                                         
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('label.payment_type') }}</th>
                                    <td><button class="{{$orderMethodColor[$item->payment_type]}}">{{ $orderMethod[$item->payment_type] }}</button></td>
                                </tr>
                                <tr>
                                <th>{{ __('label.note') }}</th>
                                <td>{{optional($item->detail)->note}}</td>
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
                <!-- form thông tin phương thức tính tiền-->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <form method="POST" action="{{ route('calculatePayment') }}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <input type="hidden" name="sender_address" value="{{ optional($item->detail)->sender_address . ', ' . optional(optional($item->detail)->districtSender)->name . ', ' . optional(optional($item->detail)->provinceSender)->name }}">
                            <input type="hidden" name="receive_address" value="{{ optional($item->detail)->receive_address . ', ' . optional(optional($item->detail)->districtReceive)->name . ', ' . optional(optional($item->detail)->provinceReceive)->name }}">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-clock-o"></i> Phương thức tính tiền</h3>
                            <div class="text-center car_option">
                                <label class="radio-inline"><input type="radio" id="goods" name="car_option" value="1" {{$item->car_option == 1 ? 'checked' : ($item->car_option == 3?'checked':'') }}>Hàng hóa</label>
                                <label class="radio-inline"><input type="radio" id="document" name="car_option" value="2" {{ $item->car_option == 2 ? 'checked' : ''}}>Chứng từ</label>
                                <label class="radio-inline"><input type="radio" id="inventory" name="car_option" value="4" {{$item->car_option == 4 ? 'checked' : ''}}>Gửi hàng vào kho</label>
                            </div>                        
                        </div>
                        <div class="box-body">
                            <table class="table table-detail">       
                                    <tr id="form_distance">
                                        <th>Quãng đường (km):</th>
                                        <td><input type="doubleval"  id="distance" name="distance" class="form-control" placeholder="Quãng đường" value="{{$payment != null ? $payment->distance : ''}}" required></td>
                                    </tr>
                                    <tr id="form_size">
                                        <th>Kích thước (cm):</th>
                                        <td style="display: flex;">
                                            <input type="doubleval" id="length" name="length"  class="form-control" placeholder="Dài" value="{{optional($item->detail)->length}}" required>
                                            <input type="doubleval" id="width"  name="width"  class="form-control" placeholder="Rộng" value="{{optional($item->detail)->width}}" required>
                                            <input type="doubleval" id="height" name="height"  class="form-control" placeholder="Cao" value="{{optional($item->detail)->height}}" required>
                                        </td>
                                    </tr>
                                    <tr id="form_weight">
                                        <th>Trọng lượng (kg)</th>
                                        <td><input type="floatval" id="weight" name="weight" class="form-control" placeholder="Trọng lượng" value="{{optional($item->detail)->weight}}" required></td>
                                    </tr>
                                    <tr id="form_service">
                                        <th>Phí dịch vụ gia tăng</th>
                                        <td> 
                                            <label class="checkbox-inline"><input type="checkbox" name="is_speed" value="1" {{$item->is_speed == 1? "checked":""}} >Hỏa tốc</label>
                                            <label class="checkbox-inline"><input type="checkbox" name="hand_on" value="1" {{$payment != null ? ( $payment->hand_on == 1? "checked":""):""}}>Giao tận tay</label>
                                        </td>
                                    </tr>
                                    <tr id="time_inventory">
                                        <th>Thời gian làm hàng</th>
                                        <td style="display: flex;">  
                                            <input type="text"  class="selector" name="start_time_inventory" value="{{$payment==null ? '' : date('m/d/Y H:i:s',$payment->start_time_inventory)}}">
                                            <input type="text"  class="selector" name="finish_time_inventory"  value="{{$payment ==null ? '' : date('m/d/Y H:i:s',$payment->finish_time_inventory )}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('label.take_money') }}</th>
                                        <td>{{number_format(optional($item->detail)->take_money)}} VND</td>
                                    </tr>    
                                    <tr>
                                        <th>Phí giao hàng</th>
                                        <td >
                                            <strong> <span > {{number_format( $item->total_price )}}</span> VND <strong>
                                            <div class="text-right">
                                                <button type="submit" class="btn  btn-success" id="btnCalculatePayment">Tính tiền</button>--OR--
                                                <button type="button" class="btn  btn-warning" data-toggle="modal" data-target="#changePayment">Thay đổi phí giao hàng</button>
                                            </div>
                                        </td>
                                    </tr>   
                            </table>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- form thông tin thay đổi lịch sử thay đổi phí giao hàng-->
                @if(count($history_change_payment) !=0)
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-clock-o"></i> Lịch sử thay đổi phí giao hàng</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tên nhân viên</th>
                                        <th>Lý do</th>
                                        <th>Số tiền</th>
                                        <th>Ngày</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($history_change_payment as $h)
                                        <tr>
                                            <td>{{$h->name}}</td>
                                            <td>{{$h->reason}}</td>
                                            <td>{{number_format($h->price)}} VND</td>
                                            <td>{{$h->created_at}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-12">
                @if($item->delivery)
                <!-- form chi tiết vận chuyển-->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-clock-o"></i> {{__('label.delivery_detail')}}</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-detail">
                                <tr>
                                    <th>{{ __('label.status') }}</th>
                                    <td><button data-status="{{$item->status}}" class="{{$orderStatusColor[$item->status]}} {{ ($item->status == \App\Helpers\Business::ORDER_STATUS_DONE_DELIVERY || $item->status == \App\Helpers\Business::ORDER_STATUS_CUSTOMER_CANCEL || $item->status == \App\Helpers\Business::ORDER_STATUS_IHT_CANCEL) ? '' : 'select-status' }}">{{ $orderStatus[$item->status] }}</button>
                                    <a type="button" class="btn btn-info" href="{{route('print',$item->id)}}">In đơn hàng</a>
                                </td>

                                </tr>
                                <tr>
                                
                                    <th>{{ __('label.user_delivery') }}</th>
                                    <td>
                                        @if($item->delivery->user_id != null )
                                        <a href="{{route('user.detail', $item->delivery->user->id)}}">{{$item->delivery->user->name}}</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('label.driver') }}</th>
                                    <td><a href="{{route('driver.detail', $item->delivery->driver->id)}}">{{ $item->delivery->driver->user->name }}</a></td>
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
                </div>
                <!-- form lịch sử giao hàng-->
                <div class="col-md-6">
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
                <!--form chi tiết vận chuyển -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-clock-o"></i> {{__('label.delivery_detail')}}</h3>
                        </div>
                        <div class="box-body">
                            <button class="{{$orderStatusColor[$item->status]}}">{{ $orderStatus[$item->status] }}</button>
                            <a type="button" class="btn btn-info" href="{{route('print',$item->id)}}">In đơn hàng</a>
                            @if($item->reason_cancel)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID nhân viên</th>
                                        <th>Lý do</th>
                                        <th>Ngày</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$item->user_cancel_id}}</td>
                                        <td>{{$item->reason_cancel}}</td>
                                        <td>{{date('d/m/Y H:i:s', strtotime($item->canceled_at))}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                            <br>
                            @if($item->status == \App\Helpers\Business::ORDER_STATUS_NO_DELIVERY)
                                <div class="pull-right">
                                    <!-- <button class="btn pull-right btn-success" id="create_delivery">{{ __('label.create_delivery') }}</button>
                                    --  OR -- -->
                                    <button class="btn pull-left btn-primary" id="create_driver">Phân công giao hàng</button>
                                </div>
                                
                            @endif
                                @if(Auth::user()->id ==1 || Auth::user()->id ==27)
                                    <button class="btn btn-danger pull-left" data-toggle="modal" data-target="#cancelOrder">{{ __('label.cancel_order') }}</button>
                                @endif
                        </div>
                    </div>
                </div>
                <!-- Tạo giao hàng (chọn tài xế & xe) -->
                <!-- <div class="modal fade modal-success" id="myModal" role="dialog">
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
                    </div>
                </div> -->
                <!--modal Phân công tài xế -->
                <div class="modal fade modal-primary" id="myModalDriver" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Phân công giao hàng</h4>
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
                    </div>
                </div>
                @endif
            </div>
            <!-- thông tin vận chuyển, phân công tài xế lấy hàng -->
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-clock-o"></i> Thông tin lấy hàng</h3>
                            @if($checkReceiverDriver==null)
                            <button type="button" class="btn btn-primary" style="margin-left:2em" data-toggle="modal" data-target="#receiverDriver">Phân công lấy hàng</button>
                            @endif
                        </div>
                        <div class="box-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nhân viên</th>
                                        <th>Tên tài xế</th>
                                        <th>Thời gian</th>
                                        <th>Cập nhật</th>
                                        <th>Nhân viên hủy</th>
                                        <th>Lý do hủy</th>
                                        <th>Thời gian hủy</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($receiverDriver as $k)
                                    <tr>
                                        <td>{{$k->user_name ??''}}</td>
                                        <td>{{$k->driver_name ??''}}</td>
                                        <td>{{$k->created_at == null? '': date('d/m/Y H:i:s', strtotime($k->created_at))}}</td>
                                        <td>{{$k->updated_at == null? '': date('d/m/Y H:i:s', strtotime($k->updated_at))}}</td>
                                        <td>{{$k->user_cancel_name == null ? '': $k->user_cancel_name}}</td>
                                        <td>{{$k->reason_cancel == null? '': $k->reason_cancel}}</td>
                                        <td>{{$k->canceled_at == null? '': date('d/m/Y H:i:s', strtotime($k->canceled_at))}}</td>
                                        <td>
                                            @if($k->canceled_at == null)
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#cancelReceiverDriver" onclick="cancelReceiverDriver({{$k->id}})">x</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- form hiển thị hình ảnh đơn hàng-->
        <div class="box box-danger">
            <div class="box-body">
                <div class="row margin-bottom">
                    @foreach($item->images as $k => $image)
                        <div class="col-sm-3">
                            <a href="{{route('api.image.show', ['id' => $image->id])}}" data-fancybox data-caption="Caption for single image">
                                <img class="img-responsive" src="{{route('api.image.show', ['id' => $image->id, 'type' => $image->type])}}" alt="Photo"></a>
                        </div>
                    @endforeach
                    <div class="col-sm-3">
                        <form id="upload-image" role="form" action="https://ihtgo.com.vn/api/upload-image" enctype="multipart/form-data" method="post">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" id="order_id" value="{{$item->id}}">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile"
                                    name="image" onchange="readURL(event, 1)">
                            </div>
                            <img id="img1" width="300" height="200"
                                onclick="openImgModal({{$item->image_link}})" data-toggle="modal" data-target="#imgModal"
                                src="{{'https://ihtgo.com.vn/'.$item->image_link}}" alt="Photo"  onerror="this.onerror=null;this.src='https://ihtgo.com.vn/public/storage/not-found.jpeg' ;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- hiển thị bản đồ -->
        <div class="box box-success">
            <div class="box-body">
                {!! $map['html'] !!}
                <div id="directionsDiv"></div>
            </div>
        </div>
    </section>
    <!-- modal chọn nhà kho -->
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
    <!-- Modal thay đổi phí giao hàng-->
    <div class="modal fade" id="changePayment" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form method="POST" action="{{ route('order-change-payment') }}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Thay đổi phí giao hàng</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pwd">Nhập số tiền (VND) (*):</label>
                            <input type="number" class="form-control" name='total_price' required>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Lý do (*):</label>
                            <textarea  rows="5" class="form-control" name='reason' required></textarea>    
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" >Lưu</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
    <!-- Modal huy-->
    <div class="modal fade" id="cancelOrder" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form method="POST" action="{{ route('cancel') }}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Hủy đơn hàng</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pwd">Lý do (*):</label>
                            <textarea  rows="5" class="form-control" name='reason' required></textarea>    
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" >Lưu</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
    <!-- Modal hủy phân công lấy đơn-->
    <div class="modal fade" id="cancelReceiverDriver" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form method="POST" action="{{route('delivery.cancelReceiverDriver')}}">
                {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <input type="hidden" name="order_prepare_id" id="order_prepare_id" value="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Hủy phân công lấy đơn</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pwd">Lý do (*):</label>
                            <textarea  rows="5" class="form-control" name='reason' required></textarea>    
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" >Lưu</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
    <!--modal Phân công tài xế lấy đơn -->
    <div class="modal fade modal-primary" id="receiverDriver" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Phân công lấy hàng</h4>
                </div>
                <form role="form" action="{{route('delivery.receiverDriver')}}" method="post" id="fr_delivery_driver">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="row">
                                <input type="hidden" name="order_id" value="{{$item->id}}" />
                                <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" />
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('label.driver') }} (*)</label>
                                        <select class="form-control select2 class_driver"  required name="id_driver_only"
                                                title="{{ __('label.driver') }}" style="width: 100%">
                                            <option value="0"
                                                    selected>{{ __('label.please_choose_field') }}</option>
                                        </select>
                                        <span class="has-error">{{$errors->first('id_driver_only')}}</span>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">{{ __('label.cancel') }}</button>
                        <button type="submit" class="btn btn-outline">{{ __('label.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal image order -->
    <div id="imgModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <img id="modalContent" src="{{'https://ihtgo.com.vn/' .$item->image_link }}" alt="Photo"  onerror="this.onerror=null;this.src='https://ihtgo.com.vn/public/storage/not-found.jpeg' ;">
            </div>
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
    <script src="{{asset('public/admin')}}/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>
    //change image order
        var imgModal = document.getElementById('imgModal');
        window.onclick = function(event) {
            if (event.target == imgModal) {
                imgModal.style.display = "none";
            }
        }

        function readURL(event, id) {
            var output = document.getElementById('img' + id);
            output.src = URL.createObjectURL(event.target.files[0]);
        };

        function openImgModal(image_link) {
            var image='';
            if(image_link){
                image= "http://ihtgo.com.vn/" +image_link;
            }else{
                image="http://ihtgo.com.vn/public/storage/not-found.jpeg";
            }

            var img = document.getElementById('modalContent');
            img.src = image;
            imgModal.style.display = "block";
        }
        document.addEventListener('touchstart', function(e) {
            if (event.target == imgModal) {
                imgModal.style.display = "none";
            }
        });
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#upload-image').submit(function(event){
                event.preventDefault();
                var id = $('#order_id').val();
                var image = $('#customFile')[0].files[0];
                var formData = new FormData();
                formData.append("image",image);
                formData.append("id",id);
                $.ajax({
                    type:'POST',
                    url: "https://iht-cors-server.herokuapp.com/https://ihtgo.com.vn/api/upload-image",
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        console.log(response);
                        alert('Cập nhật hình ảnh đơn hàng thành công');
                    },
                    error:function(response){
                        console.log(response);
                        alert("Cập nhật hình ảnh đơn hàng thất bại");
                    }   
                });

            });
            $("#customFile").change(function() {
                $('#upload-image').submit();
            });
        });
         //end change image order
        
        function cancelReceiverDriver(id){
        $('#order_prepare_id').val(id);
        }
        $( document ).ready(function() {
            
            $('.select2').select2();
            $('.price').number( true, 0 );

            // if($('#create_delivery').length > 0){
            //     $('#create_delivery').on('click', function(){
            //         $('#myModal').modal('show');
            //     });
            // }

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
            });
                if ($('#goods').is(":checked")) {
                    $('#form_size').css('display', 'table-row');
                    $('#form_weight').css('display', 'table-row');
                    $('#form_discharge').css('display', 'inline');
                    $('#form_service').css('display', 'table-row');//dịch vụ gia tăng
                    $('#time_inventory').css('display', 'none');//thời gian làm hàng
                    $('#form_distance').css('display', 'table-row');//QUÃNG ĐƯỜNG
                }
                if ($('#document').is(":checked")) {
                    $('#form_size').css('display', 'none');//form kích thước
                    $('#form_weight').css('display', 'none');//form trọng lượng
                    $('#form_distance').css('display', 'none');//QUÃNG ĐƯỜNG
                    $('#time_inventory').css('display', 'none');//thời gian làm hàng
                    $('#form_service').css('display', 'table-row');//dịch vụ gia tăng
                }
                if($('#inventory').is(":checked")) {
                    $('#form_size').css('display', 'table-row');//form kích thước
                    $('#form_weight').css('display', 'table-row');//form trọng lượng
                    $('#form_distance').css('display', 'table-row');//làm hàng
                    $('#form_service').css('display', 'none');//dịch vụ gia tăng
                }
        });
        $('#goods').change(function () {
            if ($('#goods').is(":checked")) {
                $('#form_size').css('display', 'table-row');
                $('#form_weight').css('display', 'table-row');
                $('#form_discharge').css('display', 'inline');
                $('#form_service').css('display', 'table-row');//dịch vụ gia tăng
                $('#time_inventory').css('display', 'none');//thời gian làm hàng
                $('#form_distance').css('display', 'table-row');//QUÃNG ĐƯỜNG
            }
        });
        $('#document').change(function () {
            if ($(this).is(":checked")) {
                $('#form_size').css('display', 'none');//form kích thước
                $('#form_weight').css('display', 'none');//form trọng lượng
                $('#form_distance').css('display', 'none');//QUÃNG ĐƯỜNG
                $('#form_discharge').css('display', 'none');//bốc xếp
                $('#time_inventory').css('display', 'none');//thời gian làm hàng
                $('#form_service').css('display', 'table-row');//dịch vụ gia tăng
            }
        });
        $('#inventory').change(function() {
            if($(this).is(":checked")) {
                $('#form_size').css('display', 'table-row');//form kích thước
                $('#form_weight').css('display', 'table-row');//form trọng lượng
                $('#form_distance').css('display', 'table-row');//làm hàng
                $('#time_inventory').css('display', 'table-row');//bốc xếp
                $('#form_service').css('display', 'none');//dịch vụ gia tăng
            }
        });
        $('#btnCalculatePayment').click(function() {
            if($('#document').is(":checked")) {
                $('#length').val(1);
                $('#width').val(1);
                $('#height').val(1);
                $('#weight').val(1);
                $('#distance').val(1);
            }
        });
        $('#payer').change(function () {
            var order_id={{$item->id}};
            var payer= $("#payer").val(); 
            //alert(order_id);
            $.ajax({
                type: 'POST',
                url: "{{ route('change-payer') }}",
                data: {
                    'order_id':order_id,
                    'payer': payer
                },
                success: function (data) {
                    alert('Bạn đã thay đổi thông tin người thanh toán thành công!');
                },error:function(data){
                    alert('Bạn đã thay đổi thông tin người thanh toán thất bại!');
                }
            });
        });
    </script>
@endsection
