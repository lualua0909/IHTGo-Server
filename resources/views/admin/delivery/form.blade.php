@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-body">
                <form role="form" action="{{route('delivery.createDelivery')}}" method="post">
                    {{csrf_field()}}
                    <div class="box-header">
                        <h3 class="box-title">{{$title}}</h3>
                        <div class="box-tools pull-right">
                            <button type="submit" class="btn btn-primary">{{__('label.submit')}}</button>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                    <label>{{ __('label.order') }} (*)</label>
                    <select class="form-control select2" id="order" @if(!$item) required @endif name="order[]"
                    title="{{ __('label.order') }}" style="width: 100%"  multiple="multiple">
                    </select>
                    <span class="has-error">{{$errors->first('order')}}</span>
                    @if($item)
                    @endif
                    </div>
                    <div class="form-group">
                        <label>{{ __('label.driver') }} (*)</label>
                        <select class="form-control select2" id="driver" name="driver_id"
                                title="{{ __('label.driver') }}" style="width: 100%">
                            <option value="0"
                                    selected>{{ __('label.please_choose_field') }}</option>
                            @foreach($listDriver as $driver)
                                <option {{ ((old('driver_id') && (old('driver_id') == $driver->id) || ($item && $item->driver_id == $driver->id)) ? 'selected' : '') }}
                                        value="{{ $driver->id }}">{{ $driver->user->name }}</option>
                            @endforeach
                        </select>
                        <span class="has-error">{{$errors->first('driver_id')}}</span>
                    </div>
                    <div class="form-group">
                        <label>{{ __('label.car') }} (*)</label>
                        <select class="form-control select2" id="car" name="car_id"
                                title="{{ __('label.car') }}" style="width: 100%">
                            <option value="0"
                                    selected>{{ __('label.please_choose_field') }}</option>
                            @foreach($listCar as $car)
                                <option {{ ((old('car_id') && (old('car_id') == $car->id) || ($item && $item->car_id == $car->id)) ? 'selected' : '') }}
                                        value="{{ $car->id }}">{{ $car->name }}</option>
                            @endforeach
                        </select>
                        <span class="has-error">{{$errors->first('car_id')}}</span>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection


@section('style')
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/select2/select2.css">
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/iCheck/square/blue.css">

@endsection

@section('script')
    <script src="{{asset('admin')}}/plugins/select2/select2.js"></script>
    <script src="{{asset('admin')}}/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="{{ asset('admin') }}/plugins/iCheck/icheck.min.js"></script>

    <script>
        $( document ).ready(function() {
            //Initialize Select2 Elements
            $(".select2").select2();

            $('#order').select2({
                minimumInputLength: 2,
                minimumResultsForSearch: 10,
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
                    url: '{{route('order.ajaxSelect2', \App\Helpers\Business::ORDER_STATUS_WAITING)}}',
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
                                    text: item.code + ' (' + item.name + ')',
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