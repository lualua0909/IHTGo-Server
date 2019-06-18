@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <form role="form"
                          action="{{($item) ? route('price.action', $item->id) : route('price.action') }}"
                          method="post">
                        {{csrf_field()}}
                        <div class="box-header with-border">
                            <h3 class="box-title">{{$title}}</h3>
                            <div class="box-tools pull-right">
                                <button type="submit" class="btn btn-primary">{{__('label.submit')}}</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label>{{ __('label.type') }} (*)</label>
                                    <div class="form-group">
                                        <select class="form-control" id="type" name="type"
                                                title="{{ __('label.type') }}">
                                            <option disabled selected value>{{ __('label.please_choose_field') }}</option>
                                            @foreach($typeMoney as $k => $type)
                                                <option {{ ((old('type') && (old('type') == $k) || ($item && $item->type == $k)) ? 'selected' : '') }}
                                                        value="{{ $k }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="has-error">{{$errors->first('type')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label>{{ __('label.name') }} (*)</label>
                                    <input type="text" required id="name"
                                           value="{{(old('name')) ? old('name') : (($item) ? $item->name : '') }}"
                                           name="name" class="form-control" placeholder="{{ __('label.name') }}">
                                    <span class="has-error">{{$errors->first('name')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label>{{ __('label.value') }} (*)</label>
                                    <input type="text" required id="value"
                                           value="{{(old('value')) ? old('value') : (($item) ? $item->value : '') }}"
                                           name="value" class="form-control price" placeholder="{{ __('label.value') }}">
                                    <span class="has-error">{{$errors->first('value')}}</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">

            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>{{ __('label.stt') }}</th>
                        <th>{{ __('label.type') }}</th>
                        <th>{{ __('label.name') }}</th>
                        <th>{{ __('label.value') }}</th>
                        <th class="text-center">{{ __('label.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listResult as $key => $item)
                        <tr>
                            @php $class = ($item->type == \App\Helpers\Business::SETTING_MONEY_BY_KM) ? 'success' : ($item->type == \App\Helpers\Business::SETTING_MONEY_BY_SIZE) ? 'info' : 'warning'; @endphp
                            <td> {{ $key + 1 }} </td>
                            <td><span class="label label-{{$class}}">{{$typeMoney[$item->type] }}</span></td>
                            <td>{{ $item->name }}</td>
                            <td class="price">{{ $item->value }}</td>
                            <td class="text-center">
                                @can('action-price')
                                    <a href="{{route('price.list', $item->id)}}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan
                                @can('delete-price')
                                    <a onclick="return confirm_delete('{{ __('label.are_you_sure') }}')" href="{{route('setting.delete', $item->id)}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-close"></i>
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('script')
    <script src="{{asset('admin')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('admin')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{!! asset('/admin/dist/js/jquery.number.min.js') !!}"></script>
    <script>
        $(function () {
            $('.price').number( true, 0 );

            if($("#example1").length > 0) {
                $("#example1").DataTable(
                    {
                        "language": {
                            "lengthMenu": "{{ __('label.lengthMenu') }}",
                            "zeroRecords": "{{ __('label.zeroRecords') }}",
                            "info": "{{ __('label.info') }}",
                            "infoEmpty": "{{ __('label.infoEmpty') }}",
                            "search": "{{ __('label.search') }}",
                            "paginate": {
                                "first":      "{{ __('label.first') }}",
                                "last":       "{{ __('label.last') }}",
                                "next":       "{{ __('label.next') }}",
                                "previous":   "{{ __('label.previous') }}"
                            },
                            "infoFiltered": "({{ __('label.infoFiltered') }})"
                        }
                    }
                );
            }
        });
    </script>

@endsection