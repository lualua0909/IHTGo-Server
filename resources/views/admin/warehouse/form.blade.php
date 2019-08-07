@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-body">
                <form role="form" action="{{($item) ? route('warehouse.update', $item->id) : route('warehouse.store') }}" method="post">
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
                            <label>{{ __('label.code') }} (*)</label>
                            <input {{ ($item) ? 'readonly' : '' }} type="text" required id="code" value="{{(old('code')) ? old('code') : (($item) ? $item->code : '') }}" name="code" class="form-control" placeholder="{{ __('label.code') }}">
                            <span class="has-error">{{$errors->first('code')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.distribution') }} (*)</label>
                            <input type="text" required id="distribution" value="{{(old('distribution')) ? old('distribution') : (($item) ? $item->distribution : '') }}" name="distribution" class="form-control" placeholder="{{ __('label.distribution') }}">
                            <span class="has-error">{{$errors->first('distribution')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.acreage') }} (*)</label>
                            <input type="number" min="1" required id="acreage" value="{{(old('acreage')) ? old('acreage') : (($item) ? $item->acreage : '') }}" name="acreage" class="form-control" placeholder="{{ __('label.acreage') }}">
                            <span class="has-error">{{$errors->first('acreage')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.address') }} (*)</label>
                            <input type="text" required id="address" value="{{(old('address')) ? old('address') : (($item) ? $item->address : '') }}" name="address" class="form-control" placeholder="{{ __('label.address') }}">
                            <span class="has-error">{{$errors->first('address')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.manager') }} (*)</label>
                            <select class="form-control select2" id="manager" name="manager_id"
                                    title="{{ __('label.manager') }}" style="width: 100%">
                                <option value="0"
                                        selected>{{ __('label.please_choose_field') }}</option>
                                @foreach($listUser as $user)
                                    <option {{ ((old('manager_id') && (old('manager_id') == $user->id) || ($item && $item->manager_id == $user->id)) ? 'selected' : '') }}
                                            value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <span class="has-error">{{$errors->first('manager_id')}}</span>
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
    <script src="{{asset('public/admin')}}/plugins/select2/select2.js"></script>
    <script>
        $(function () {
            $('#manager').select2();
        });
    </script>
@endsection
