@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-body">
                <form role="form" action="{{($item) ? route('price.update', $item->id) : route('price.store', $type) }}" method="post">
                    {{csrf_field()}}
                    <div class="box-header">
                        <h3 class="box-title">{{$title}}</h3>
                        <div class="box-tools pull-right">
                            <button type="submit" class="btn btn-primary">{{__('label.submit')}}</button>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12">
                        @if($type == \App\Helpers\Business::PRICE_BY_TH1)
                        <div class="form-group">
                            <label>{{ __('label.type_car') }} (*)</label>
                            <div class="form-group">
                                <select class="form-control" id="type_car" required name="type_car"
                                        title="{{ __('label.type_car') }}">
                                    <option disabled selected value>{{ __('label.please_choose_field') }}</option>
                                    @foreach($listTypeCar as $c => $typeCar)
                                        <option {{ ((old('type_car') && (old('type_car') == $c) || ($item && $item->type_car == $c)) ? 'selected' : '') }}
                                                value="{{ $c }}">{{ $typeCar }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="has-error">{{$errors->first('type_car')}}</span>
                        </div>
                        @endif
                        @if($listDistrict)
                        <div class="form-group">
                            <label>{{ __('label.district') }} (*)</label>
                            <div class="form-group">
                                <select class="form-control" id="to" name="to"
                                        title="{{ __('label.district') }}">
                                    <option disabled selected value>{{ __('label.please_choose_field') }}</option>
                                    @foreach($listDistrict as $k => $district)
                                        <option {{ ((old('to') && (old('to') == $district->id) || ($item && $item->to == $district->id)) ? 'selected' : '') }}
                                                value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="has-error">{{$errors->first('to')}}</span>
                        </div>
                        @endif
                        {{--<div class="form-group">--}}
                            {{--<label>{{ __('label.type') }} (*)</label>--}}
                            {{--<div class="form-group">--}}
                                {{--<select class="form-control" id="type" name="type"--}}
                                        {{--title="{{ __('label.type') }}">--}}
                                    {{--<option disabled selected value>{{ __('label.please_choose_field') }}</option>--}}
                                    {{--@foreach($listType as $k => $type)--}}
                                        {{--<option {{ ((old('type') && (old('type') == $k) || ($item && $item->type == $k)) ? 'selected' : '') }}--}}
                                                {{--value="{{ $k }}">{{ $type }}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<span class="has-error">{{$errors->first('type')}}</span>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label>{{ __('label.option') }} (*)</label>--}}
                            {{--<div class="form-group">--}}
                                {{--<select class="form-control" id="option" required name="option"--}}
                                        {{--title="{{ __('label.option') }}">--}}
                                    {{--<option disabled selected value>{{ __('label.please_choose_field') }}</option>--}}
                                    {{--@foreach($listOption as $i => $option)--}}
                                        {{--<option {{ ((old('option') && (old('option') == $i) || ($item && $item->option == $i)) ? 'selected' : '') }}--}}
                                                {{--value="{{ $i }}">{{ $option }}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<span class="has-error">{{$errors->first('option')}}</span>--}}
                        {{--</div>--}}
                        <div class="row">
                            @if($type == \App\Helpers\Business::PRICE_BY_TH3)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('label.time_sende') }} (*)</label>
                                        <input type="text" required id="time_sende" value="{{(old('time_sende')) ? old('time_sende') : (($item) ? $item->time_sende : '') }}" name="time_sende" class="form-control" placeholder="{{ __('label.time_sende') }}">
                                        <span class="has-error">{{$errors->first('time_sende')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('label.time_receive') }} (*)</label>
                                        <input type="text" required id="time_receive" value="{{(old('time_receive')) ? old('time_receive') : (($item) ? $item->time_receive : '') }}" name="time_receive" class="form-control" placeholder="{{ __('label.time_receive') }}">
                                        <span class="has-error">{{$errors->first('time_receive')}}</span>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('label.min') }} (*)</label>
                                    <input {{ ($item) ? 'readonly' : '' }} type="text" required id="min" value="{{(old('min')) ? old('min') : (($item) ? $item->min : '') }}" name="min" class="form-control" placeholder="{{ __('label.min') }}">
                                    <span class="has-error">{{$errors->first('min')}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('label.min_value') }} (*)</label>
                                    <input {{ ($item) ? 'readonly' : '' }} type="text" required id="min_value" value="{{(old('min_value')) ? old('min_value') : (($item) ? $item->min_value : '') }}" name="min_value" class="form-control price" placeholder="{{ __('label.min_value') }}">
                                    <span class="has-error">{{$errors->first('min_value')}}</span>
                                </div>
                            </div>
                            {{--<div class="col-md-12">--}}
                                {{--<div id="sub-service" class="form-group row">--}}
                                    {{--<div class="col-md-12">--}}
                                        {{--<button id="button-sub" type="button" class="btn btn-primary">{{ __('label.advance') }}</button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('label.increase') }} (*)</label>
                                    <input type="text" id="increase" value="{{(old('increase')) ? old('increase') : (($item) ? $item->increase : '') }}" name="increase" class="form-control" placeholder="{{ __('label.increase') }}">
                                    <span class="has-error">{{$errors->first('increase')}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('label.increase_value') }} (*)</label>
                                    <input type="text" id="increase_value" value="{{(old('increase_value')) ? old('increase_value') : (($item) ? $item->increase_value : '') }}" name="increase_value" class="form-control price" placeholder="{{ __('label.increase_value') }}">
                                    <span class="has-error">{{$errors->first('increase_value')}}</span>
                                </div>
                            </div>
                            @if($type == \App\Helpers\Business::PRICE_BY_TH1)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('label.address_receive') }} (*)</label>
                                        <input type="text" id="address_receive" value="{{(old('address_receive')) ? old('address_receive') : (($item) ? $item->address_receive : '') }}" name="address_receive" class="form-control" placeholder="{{ __('label.address_receive') }}">
                                        <span class="has-error">{{$errors->first('address_receive')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('label.address_payment') }} (*)</label>
                                        <input type="text" id="address_payment" value="{{(old('address_payment')) ? old('address_payment') : (($item) ? $item->address_payment : '') }}" name="address_payment" class="form-control" placeholder="{{ __('label.address_payment') }}">
                                        <span class="has-error">{{$errors->first('address_payment')}}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.note') }}</label>
                            <input type="text" id="note" value="{{(old('note')) ? old('note') : (($item) ? $item->note : '') }}" name="note" class="form-control" placeholder="{{ __('label.note') }}">
                            <span class="has-error">{{$errors->first('note')}}</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('script')
    <script src="{!! asset('/admin/dist/js/jquery.number.min.js') !!}"></script>
    <script>
        $(function () {
            $('.price').number( true, 0 );

            // append
            var html = "<div><div class='col-md-3'>" +
                "            <label>{{ __('label.from') }} (*)</label>" +
                "            <input type='number' min='1' required name='from[]' class='form-control' placeholder='{{ __('label.from') }}'>" +
                "       </div>" +
                "       <div class='col-md-3'>" +
                "             <label>{{ __('label.to') }} (*)</label>" +
                "             <input type='number' min='1' required name='to[]' class='form-control' placeholder='{{ __('label.to') }}'>" +
                "       </div>" +
                "       <div class='col-md-4'>" +
                "             <label>{{ __('label.value') }} (*)</label>" +
                "             <input type='text' required name='value[]' class='form-control price' placeholder='{{ __('label.value') }}'>" +
                "       </div>" +
                "       <div class='col-md-2 remove-sub-service'><br />" +
                "       <i class='fa fa-fw fa-close' style='font-size:35px'></i>" +
                "       <span class='text-muted'></span></div></div>";

            $('#button-sub').on('click', function(){
                $('#sub-service').append(html);
                $('.price').number( true, 0 );
                $('.remove-sub-service').on('click', function(){
                    $(this).parent().remove();
                });
            });
        });
    </script>
@endsection
