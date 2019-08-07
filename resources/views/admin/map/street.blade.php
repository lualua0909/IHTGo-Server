@extends('layouts.admin')

@section('content')
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-inline" action="" method="post">
                            @csrf
                            <div class="form-group" style="width: 35%;">
                                <select class="form-control select2" id="id_driver" name="driver_id"
                                        title="{{ __('label.driver') }}" style="width: 100%">
                                    <option value="0"
                                            selected>{{ __('label.please_choose_field_driver') }}</option>
                                </select>
                            </div>
                            <div class="form-group" style="width: 35%;">
                                <select class="form-control select2" id="id_order" name="order_id"
                                        title="{{ __('label.order') }}" style="width: 100%">
                                    <option value="0"
                                            selected>{{ __('label.please_choose_field_order') }}</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">{{__('label.search')}}</button>
                        </form>
                    </div>
                    <hr>
                </div>

                {!! $map['html'] !!}
                <div id="directionsDiv"></div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/admin')}}/plugins/select2/select2.css">
@endsection
@section('script')
    <script>
        var centreGot = false;
      </script>
    {!! $map['js'] !!}

    <script src="{{asset('public/admin')}}/plugins/select2/select2.js"></script>
    <script>
        $('#id_driver').select2({
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
    </script>
@endsection

