@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-body">
                    <form role="form" action="{{($item) ? route('user.update', $item->id) : route('user.store') }}" method="post">
                        {{csrf_field()}}
                    <div class="box-header">
                        <h3 class="box-title">{{$title}}</h3>
                        <div class="box-tools pull-right">
                            <button type="submit" class="btn btn-primary">{{__('label.submit')}}</button>
                        </div>
                    </div>
                        <br>
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-info"></i> {{__('label.user_info')}}</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>{{ __('label.code') }} (*)</label>
                                        <input {{ ($item) ? 'readonly' : '' }} type="text" required id="code" value="{{(old('code')) ? old('code') : (($item) ? $item->code : '') }}" name="code" class="form-control" placeholder="{{ __('label.code') }}">
                                        <span class="has-error">{{$errors->first('code')}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('label.name') }} (*)</label>
                                        <input type="text" required id="name" value="{{(old('name')) ? old('name') : (($item) ? $item->name : '') }}" name="name" class="form-control" placeholder="{{ __('label.name') }}">
                                        <span class="has-error">{{$errors->first('name')}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('label.phone') }} (*)</label>
                                        <input type="text" required id="phone" value="{{(old('phone')) ? old('phone') : (($item) ? $item->phone : '') }}" name="phone" class="form-control" placeholder="{{ __('label.phone') }}">
                                        <span class="has-error">{{$errors->first('phone')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-info"></i> {{__('label.login_info')}}</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>{{ __('label.email') }} (*)</label>
                                        <input {{ ($item) ? 'readonly' : '' }} type="email" required id="email" value="{{(old('email')) ? old('email') : (($item) ? $item->email : '') }}" name="email" class="form-control" placeholder="{{ __('label.email') }}">
                                        <span class="has-error">{{$errors->first('email')}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('label.password') }} (*)</label>
                                        <input type="password" {{ (!$item) ? 'required' : '' }} id="password" value="" name="password" class="form-control" placeholder="{{ __('label.password') }}">
                                        <span class="has-error">{{$errors->first('password')}}</span>
                                    </div>
                                    @if(!$item)
                                    <div class="form-group">
                                        <label>{{ __('label.confirm_password') }} (*)</label>
                                        <input type="password" required id="confirmed" value="" name="password_confirmation" class="form-control" placeholder="{{ __('label.confirm_password') }}">
                                        <span class="has-error">{{$errors->first('password_confirmation')}}</span>
                                    </div>
                                    @else
                                        <div class="form-group">
                                            <div class="checkbox icheck">
                                                <label>
                                                    <input type="checkbox" name="active" {{ (old('active') || $item->active == \App\Helpers\Business::USER_ACTIVE) ? 'checked' : '' }}>  {{ __('label.active') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox icheck">
                                                <label>
                                                    <input type="checkbox" name="baned" {{ (old('baned') || $item->baned == \App\Helpers\Business::USER_BANED) ? 'checked' : '' }}>  {{ __('label.baned') }}
                                                </label>
                                            </div>
                                        </div>
                                    @endif
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
    <link rel="stylesheet" href="{{ asset('public/admin') }}/plugins/iCheck/square/blue.css">
@endsection

@section('script')
    <script src="{{ asset('public/admin') }}/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
            });
        });
    </script>
@endsection
