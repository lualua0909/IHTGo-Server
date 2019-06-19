@extends('layouts.admin')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-info"></i> {{__('label.detail')}}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-detail">
                            <tr>
                                <th>{{ __('label.type_car') }}</th>
                                <td><button class="btn btn-block {{$listTypeCarColor[$item->type_car]}}">{{ $listTypeCar[$item->type_car] }}</button></td>
                            </tr>
                            <tr>
                                <th>{{ __('label.th') }}</th>
                                <td>
                                    @if($item->type)
                                        <button class="btn btn-block {{$listTypeColor[$item->type]}}">{{ $listType[$item->type] }}</button>
                                    @endif
                                </td>
                            </tr>
                            {{--@if($item->option)--}}
                            {{--<tr>--}}
                                {{--<th>{{ __('label.type') }}</th>--}}
                                {{--<td><button class="btn btn-block {{$listOptionColor[$item->option]}}">{{ $listOption[$item->option] }}</button></td>--}}
                            {{--</tr>--}}
                            {{--@endif--}}
                            <tr>
                                <th>@lang('label.min')</th>
                                <td>{{$item->min}}</td>
                            </tr>
                            <tr>
                                <th>@lang('label.min_value')</th>
                                <td class="price">{{$item->min_value}}</td>
                            </tr>
                            @if($item->to)
                            <tr>
                                <th>@lang('label.address')</th>
                                <td>
                                   Từ <strong>{{$item->province->name}}</strong> Đến <strong>{{$item->district->name}}</strong>
                                </td>
                            </tr>
                            @endif
                            @if($item->time_sende && $item->time_receive)
                                <tr>
                                    <th>@lang('label.time')</th>
                                    <td>
                                        Từ <strong>{{$item->time_sende}}h</strong> Đến <strong>{{$item->time_receive}}h</strong>
                                    </td>
                                </tr>
                            @endif
                            @if($item->increase)
                            <tr>
                                <th>@lang('label.increase')</th>
                                <td>{{$item->increase}}</td>
                            </tr>
                            @endif
                            @if($item->increase_value)
                            <tr>
                                <th>@lang('label.increase_value')</th>
                                <td class="price">{{$item->increase_value}}</td>
                            </tr>
                            @endif
                            @if($item->address_receive)
                                <tr>
                                    <th>@lang('label.address_receive')</th>
                                    <td>{{$item->address_receive}}</td>
                                </tr>
                            @endif
                            @if($item->address_payment)
                                <tr>
                                    <th>@lang('label.address_payment')</th>
                                    <td class="price">{{$item->address_payment}}</td>
                                </tr>
                            @endif
                            <tr>
                                <th>@lang('label.status')</th>
                                <td><button class="btn btn-block {{$listPublishColor[$item->publish]}}">{{ $listPublish[$item->publish] }}</button></td>
                            </tr>
                            <tr>
                                <th>@lang('label.employer')</th>
                                <td>{{$item->user->name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('label.note')</th>
                                <td>{{$item->note}}</td>
                            </tr>
                            <tr>
                                <th>@lang('label.created')</th>
                                <td>{{$item->created_at}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    <style type="text/css">
        table.table-detail th {
            background-color: #e8e8e8;
            color: #0a0a0a;
            text-align: center;
        }

    </style>
@endsection
@section('script')
    <script src="{!! asset('public/admin/dist/js/jquery.number.min.js') !!}"></script>
    <script>
        $(function () {
            $('.price').number( true, 0 );
        });
    </script>

@endsection

