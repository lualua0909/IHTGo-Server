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
                        <div class="form-group">
                            <label>{{ __('label.from') }} (*)</label>
                            <div class="form-group">
                                <select class="form-control" id="from" name="from"
                                        title="{{ __('label.from') }}">
                                    <option disabled selected value>{{ __('label.please_choose_field') }}</option>
                                    @foreach($listProvince as $k => $from)
                                        <option {{ ((old('from') && (old('from') == $from->province_id) || ($item && $item->to == $from->province_id)) ? 'selected' : '') }}
                                                value="{{ $from->province_id }}">{{ $from->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="has-error">{{$errors->first('from')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.to') }} (*)</label>
                            <div class="form-group">
                                <select class="form-control" id="to" name="to"
                                        title="{{ __('label.province') }}">
                                    <option disabled selected value>{{ __('label.please_choose_field') }}</option>
                                    @foreach($listProvince as $to)
                                        <option {{ ((old('to') && (old('to') == $to->province_id) || ($item && $item->to == $to->province_id)) ? 'selected' : '') }}
                                                value="{{ $to->province_id }}">{{ $to->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="has-error">{{$errors->first('to')}}</span>
                        </div>
                        <div class="row">
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
    <script src="{!! asset('public/admin/dist/js/jquery.number.min.js') !!}"></script>
    <script>
        $(function () {
            $('.price').number( true, 0 );
        });
    </script>
@endsection
