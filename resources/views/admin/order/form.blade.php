@extends('layouts.admin')

@section('content')
<!-- Main content -->
<section class="content">
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-body">
            <form role="form" action="{{ route('order.store') }}" method="post">
                {{csrf_field()}}
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                    <div class="box-tools pull-right">
                        <button type="submit" class="btn btn-primary">{{__('label.submit')}}</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('label.customer') }} (*)</label>
                            <select class="form-control select2" id="customer" required name="user_id" title="{{ __('label.customer') }}" style="width: 100%">
                                <option selected>{{ __('label.please_choose_field') }}</option>
                            </select>
                            <span class="has-error">{{$errors->first('user_id')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.payment_type') }} (*)</label>
                            <select class="form-control select2" id="manager" name="payment_type" title="{{ __('label.payment_type') }}" style="width: 100%">
                                <option value="0" selected>{{ __('label.please_choose_field') }}</option>
                                @foreach($orderMethod as $p => $payment)
                                <option {{ ((old('payment_type') && (old('payment_type') == $p) || ($item && $item->payment_type == $p)) ? 'selected' : '') }} value="{{ $p }}">{{ $payment }}</option>
                                @endforeach
                            </select>
                            <span class="has-error">{{$errors->first('payment_type')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.payer') }} (*)</label>
                            <select class="form-control select2" id="payer" name="payer" title="{{ __('label.payer') }}" style="width: 100%">
                                <option value="0" selected>{{ __('label.please_choose_field') }}</option>
                                @foreach($listPayer as $pa => $payer)
                                <option {{ ((old('payer') && (old('payer') == $pa) || ($item && $item->payer == $pa)) ? 'selected' : '') }} value="{{ $pa }}">{{ $payer }}</option>
                                @endforeach
                            </select>
                            <span class="has-error">{{$errors->first('payer')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.th') }} (*)</label>
                            <select class="form-control select2" id="car_type" name="car_option" title="{{ __('label.th') }}" style="width: 100%">
                                <option value="0" selected>{{ __('label.please_choose_field') }}</option>
                                @foreach($listType as $t => $type)
                                <option {{ ((old('car_option') && (old('car_option') == $t) || ($item && $item->car_option == $t)) ? 'selected' : '') }} value="{{ $t }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            <span class="has-error">{{$errors->first('car_option')}}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tên đơn hàng (*)</label>
                            <input {{ ($item) ? 'readonly' : '' }} type="text" required id="name" value="{{(old('name')) ? old('name') : (($item) ? $item->name : '') }}" name="name" class="form-control" placeholder="{{ __('label.name') }}">
                            <span class="has-error">{{$errors->first('name')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.coupon_code') }} (*)</label>
                            <input required {{ ($item) ? 'readonly' : '' }} type="text" id="coupon_code" value="{{(old('coupon_code')) ? old('coupon_code') : (($item) ? $item->coupon_code : '') }}" name="coupon_code" class="form-control" placeholder="{{ __('label.coupon_code') }}">
                            <span class="has-error">{{$errors->first('coupon_code')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.take_money') }}</label>
                            <input type="text" id="take_money" value="{{(old('take_money')) ? old('take_money') : (($item) ? $item->take_money : '') }}" name="take_money" class="form-control" placeholder="{{ __('label.take_money') }}">
                            <span class="has-error">{{$errors->first('take_money')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.total_price') }} (*)</label>
                            <input type="text" required id="total_price" value="{{(old('total_price')) ? old('total_price') : (($item) ? $item->total_price : '') }}" name="total_price" class="form-control" placeholder="{{ __('label.total_price') }}">
                            <span class="has-error">{{$errors->first('total_price')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.weight') }} (kg *)</label>
                            <input type="text" required id="weight" value="{{(old('weight')) ? old('weight') : (($item) ? $item->weight : '') }}" name="weight" class="form-control" placeholder="{{ __('label.weight') }}">
                            <span class="has-error">{{$errors->first('weight')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.note') }} </label>
                            <textarea rows="5" id="note" name="note" class="form-control" placeholder="{{ __('label.note') }}">{{(old('note')) ? old('note') : (($item) ? $item->note : '') }}</textarea>
                            <span class="has-error">{{$errors->first('note')}}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('label.sender_name') }} (*)</label>
                            <input type="text" required id="sender_name" value="{{(old('sender_name')) ? old('sender_name') : (($item) ? $item->sender_name : '') }}" name="sender_name" class="form-control" placeholder="{{ __('label.sender_name') }}">
                            <span class="has-error">{{$errors->first('sender_name')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.sender_phone') }} (*)</label>
                            <input type="text" required id="sender_phone" value="{{(old('sender_phone')) ? old('sender_phone') : (($item) ? $item->sender_phone : '') }}" name="sender_phone" class="form-control" placeholder="{{ __('label.sender_phone') }}">
                            <span class="has-error">{{$errors->first('sender_phone')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.sender_address') }} (*)</label>
                            <input {{ ($item) ? 'readonly' : '' }} type="text" required id="sender_address" value="{{(old('sender_address')) ? old('sender_address') : (($item) ? $item->sender_address : '') }}" name="sender_address" class="form-control" placeholder="{{ __('label.sender_address') }}">
                            <span class="has-error">{{$errors->first('sender_address')}}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('label.receive_name') }} (*)</label>
                            <input {{ ($item) ? 'readonly' : '' }} type="text" required id="receive_name" value="{{(old('receive_name')) ? old('receive_name') : (($item) ? $item->receive_name : '') }}" name="receive_name" class="form-control" placeholder="{{ __('label.receive_name') }}">
                            <span class="has-error">{{$errors->first('receive_name')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.receive_phone') }} (*)</label>
                            <input type="text" required id="receive_phone" value="{{(old('receive_phone')) ? old('receive_phone') : (($item) ? $item->receive_phone : '') }}" name="receive_phone" class="form-control" placeholder="{{ __('label.receive_phone') }}">
                            <span class="has-error">{{$errors->first('receive_phone')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.receive_address') }} (*)</label>
                            <input type="text" required id="receive_address" value="{{(old('receive_address')) ? old('receive_address') : (($item) ? $item->receive_address : '') }}" name="receive_address" class="form-control" placeholder="{{ __('label.receive_address') }}">
                            <span class="has-error">{{$errors->first('receive_address')}}</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
@section('style')
<link rel="stylesheet" href="{{asset('public/admin')}}/plugins/select2/select2.css">
<link rel="stylesheet" href="{{asset('public/admin')}}/plugins/datepicker/datepicker3.css">
@endsection

@section('script')
<script src="{{asset('public/admin')}}/plugins/select2/select2.js"></script>
<script src="{{asset('public/admin')}}/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="{!! asset('public/admin/dist/js/jquery.number.min.js') !!}"></script>
<script>
    $(function() {
        $('#sender_date, #receive_date').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy'
        });

        $('#total_price, #take_money').number(true, 0);

        $('.select2').select2();

        $('#customer').select2({
            language: {
                inputTooShort: function() {
                    return "{{__('label.please_enter_2_character')}}";
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
                url: "{{route('customer.ajaxSelect2')}}",
                data: function(params) {
                    var query = {
                        searchtext: params.term,
                    }
                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name + '(' + item.phone + ')',
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
    });
</script>
@endsection