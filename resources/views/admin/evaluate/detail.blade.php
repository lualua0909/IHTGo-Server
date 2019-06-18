@extends('layouts.admin')
@section('content')
    @php
        $routeTo = ($item->type == \App\Helpers\Business::EVALUATE_TYPE_SERVICE) ? 'order.detail' :  (($item->type == \App\Helpers\Business::EVALUATE_TYPE_DRIVE) ? 'driver.detail' : 'customer.detail');
        $routeFrom = ($item->type == \App\Helpers\Business::EVALUATE_TYPE_CUSTOMER) ? 'driver.detail' : 'customer.detail';
    @endphp

    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-info"></i> {{__('label.detail')}}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-detail">
                            <tr>
                                <th>{{ __('label.type') }}</th>
                                <td><button class="btn btn-block btn-info">{{ $evaluateType[$item->type] }}</button></td>
                            </tr>
                            <tr>
                                <th>{{ __('label.targets') }}</th>
                                <td>
                                    <ol>
                                        @foreach($item->other($item->content) as $c)
                                            <li>{{ $c->name }}</li>
                                        @endforeach
                                    </ol>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('label.rate') }}</th>
                                <td>{{ $item->rate }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.note') }}</th>
                                <td>{{ $item->note }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.created') }}</th>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-info"></i> {{__('label.from_name')}}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-detail">
                            <tr>
                                <th>{{ __('label.name') }}</th>
                                <td><a href="{{route($routeFrom, $item->from_id)}}">{{ optional($item->from)->name }}</a></td>
                            </tr>
                            <tr>
                                <th>{{ __('label.email') }}</th>
                                <td>{{ optional($item->from)->email }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.phone') }}</th>
                                <td>{{ optional($item->from)->phone }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.gender') }}</th>
                                <td>{{ $genderType[optional($item->from)->gender] }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.created') }}</th>
                                <td>{{ optional($item->from)->created_at }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @if($item->to->count())
            <div class="col-md-4">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-info"></i> {{__('label.to_name')}}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-detail">
                            <tr>
                                <th>{{ __('label.name') }}</th>
                                <td><a href="{{route($routeTo, $item->to_id)}}">{{ optional($item->to)->name }}</a></td>
                            </tr>
                            <tr>
                                <th>{{ __('label.email') }}</th>
                                <td>{{ optional($item->to)->email }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.phone') }}</th>
                                <td>{{ optional($item->to)->phone }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.gender') }}</th>
                                <td>{{ $genderType[optional($item->to)->gender] }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('label.created') }}</th>
                                <td>{{ optional($item->to)->created_at }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @endif
            {{--<div class="col-md-12">--}}
                {{--<div class="box box-primary">--}}
                    {{--<div class="box-header with-border">--}}
                        {{--<h3 class="box-title"><i class="fa fa-clock-o"></i> {{__('label.content')}}</h3>--}}
                    {{--</div>--}}
                    {{--<div class="box-body">--}}
                        {{--<table id="" class="table table-bordered table-hover table-striped">--}}
                            {{--<thead>--}}
                                {{--<tr>--}}
                                    {{--<th>{{__('label.name')}}</th>--}}
                                    {{--<th>{{__('label.comment')}}</th>--}}
                                {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                                {{--@foreach($item->content as $k => $content)--}}
                                    {{--<tr>--}}
                                        {{--<th>{{ $content['name'] }}</th>--}}
                                        {{--<td>{{ $content['comment'] }}</td>--}}
                                    {{--</tr>--}}
                                {{--@endforeach--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
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

