@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-body">
                <form role="form" action="{{($item) ? route('finance.update', ['type' => $type, 'id' => $item->id]) : route('finance.store', $type) }}" method="post">
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
                            <label>{{ __('label.name') }} (*)</label>
                            <input {{ ($item) ? 'readonly' : '' }} type="text" required id="name" value="{{(old('name')) ? old('name') : (($item) ? $item->name : '') }}" name="name" class="form-control" placeholder="{{ __('label.name') }}">
                            <span class="has-error">{{$errors->first('name')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.total') }} (*)</label>
                            <input type="text" required id="total" value="{{(old('total')) ? old('total') : (($item) ? $item->total : '') }}" name="total" class="form-control" placeholder="{{ __('label.total') }}">
                            <span class="has-error">{{$errors->first('total')}}</span>
                        </div>
                        @if($type == 1)
                            <div class="form-group">
                                <label>{{ __('label.payment') }} (*)</label>
                                <input type="text" required id="payment" value="{{(old('payment')) ? old('payment') : (($item) ? $item->payment : '') }}" name="payment" class="form-control" placeholder="{{ __('label.payment') }}">
                                <span class="has-error">{{$errors->first('payment')}}</span>
                            </div>
                            <div class="form-group">
                                <label>{{ __('label.own') }} (*)</label>
                                <input type="text" required id="own" value="{{(old('own')) ? old('own') : (($item) ? $item->own : '') }}" name="own" class="form-control" placeholder="{{ __('label.own') }}">
                                <span class="has-error">{{$errors->first('own')}}</span>
                            </div>
                            <div class="form-group" style="width: 100%;">
                                <label>{{ __('label.order') }} (*)</label>
                                <select class="form-control select2" id="id_order" name="order_id"
                                        title="{{ __('label.order') }}" style="width: 100%">
                                    <option value="0"
                                            selected>{{ __('label.please_choose_field_order') }}</option>
                                </select>
                            </div>
                        @endif
                        <div class="form-group">
                            <label>{{__('label.date')}}  (*):</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="date" value="{{(old('date')) ? old('date') : ($item && $item->date) ? \Carbon\Carbon::createFromFormat('Y-m-d', $item->date)->format('d/m/Y') : null}}" class="form-control pull-right" id="datepicker" required />
                            </div>
                            <span class="has-error">{{ $errors->first('date') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{__('label.note')}}</label>
                            <textarea class="form-control" name="note" rows="3" placeholder="Enter ...">{{(old('note') ? old('note') : ($item) ? $item->note : '')}}</textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/datepicker/datepicker3.css">
@endsection

@section('script')
    <script src="{{ asset('admin') }}/plugins/select2/select2.full.min.js"></script>
    <script src="{{asset('admin')}}/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="{!! asset('/admin/dist/js/jquery.number.min.js') !!}"></script>
    <script>
        $(function () {
            $('#payment, #total, #own').number( true, 0 );

            //Initialize Select2 Elements
            $('#id_order').select2({
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
                    url: '{{route('order.ajaxSelect2')}}',
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
                                    text: item.code + ' (' + item.name + ', ' + item.sender_name + ')',
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });

            $('#datepicker').datepicker({
                autoclose: true,
                format:'dd/mm/yyyy'
            });
        });
    </script>
@endsection
