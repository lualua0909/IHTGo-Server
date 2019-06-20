@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-body">
                <form role="form" action="{{($item) ? route('collection.update', $item->id) : route('collection.store') }}" method="post">
                    {{csrf_field()}}
                    <div class="box-header">
                        <h3 class="box-title">{{$title}}</h3>
                        <div class="box-tools pull-right">
                            <button type="submit" class="btn btn-primary">{{__('label.submit')}}</button>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            @if($item)
                                <div class="form-group">
                                    <label>{{ __('label.driver') }} (*)</label>
                                    <select class="form-control select2" id="employee_id" name="employee_id"
                                            title="{{ __('label.driver') }}" style="width: 100%">
                                        <option value="0"
                                                selected>{{ __('label.please_choose_field') }}</option>
                                        @foreach($listDriver as $i)
                                            <option {{ ((old('employee_id') && (old('employee_id') == $i->id) || ($item && $item->employee_id == $i->id)) ? 'selected' : '') }}
                                                    value="{{ $i->id }}">{{ $i->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="has-error">{{$errors->first('employee_id')}}</span>
                                </div>
                            @endif
                            <div class="form-group">
                                <label>{{ __('label.name') }} (*)</label>
                                <input type="text" required id="name" value="{{(old('name')) ? old('name') : (($item) ? $item->name : '') }}" name="name" class="form-control" placeholder="{{ __('label.name') }}">
                                <span class="has-error">{{$errors->first('name')}}</span>
                            </div>
                            <div class="form-group">
                                <label>{{ __('label.money') }} (*)</label>
                                <input type="text" required id="money" value="{{(old('money')) ? old('money') : (($item) ? $item->money : '') }}" name="money" class="form-control" placeholder="{{ __('label.money') }}">
                                <span class="has-error">{{$errors->first('money')}}</span>
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
@endsection

@section('script')
    <script src="{!! asset('public/admin/dist/js/jquery.number.min.js') !!}"></script>
    <script src="{{asset('public/admin')}}/plugins/select2/select2.js"></script>
    <script>
        $(function () {
            $('#money').number(true, 0);
            $('.select2').select2();
        });
    </script>
@endsection

