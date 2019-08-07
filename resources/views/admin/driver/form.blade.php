@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-body">
                <form role="form" action="{{($item) ? route('driver.update', $item->id) : route('driver.store') }}" method="post">
                    {{csrf_field()}}
                    <div class="box-header">
                        <h3 class="box-title">{{$title}}</h3>
                        <div class="box-tools pull-right">
                            <button type="submit" class="btn btn-primary">{{__('label.submit')}}</button>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-info"></i> {{__('label.driver_detail')}}</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label>{{ __('label.name') }} (*)</label>
                                    <input type="text" required id="name" value="{{(old('name')) ? old('name') : (($item) ? $item->user->name : '') }}" name="name" class="form-control" placeholder="{{ __('label.name') }}">
                                    <span class="has-error">{{$errors->first('name')}}</span>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('label.phone') }} (*)</label>
                                    <input type="text" required id="phone" value="{{(old('phone')) ? old('phone') : (($item) ? $item->user->phone : '') }}" name="phone" class="form-control" placeholder="{{ __('label.phone') }}">
                                    <span class="has-error">{{$errors->first('phone')}}</span>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('label.identification') }} (*)</label>
                                    <input type="text" required id="identification" value="{{(old('identification')) ? old('identification') : (($item) ? $item->identification : '') }}" name="identification" class="form-control" placeholder="{{ __('label.identification') }}">
                                    <span class="has-error">{{$errors->first('identification')}}</span>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('label.experience') }} (*)</label>
                                    <input type="text" required id="experience" value="{{(old('experience')) ? old('experience') : (($item) ? $item->experience : '') }}" name="experience" class="form-control" placeholder="{{ __('label.experience') }}">
                                    <span class="has-error">{{$errors->first('experience')}}</span>
                                </div>
                                <div class="form-group">
                                    <label>{{__('label.driver_date')}}  (*):</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="date" value="{{$item && $item->date ? \Carbon\Carbon::createFromFormat('Y-m-d', $item->date)->format('d/m/Y') : null}}" class="form-control pull-right" id="datepicker" required />
                                    </div>
                                    <span class="has-error">{{ $errors->first('date') }}</span>
                                </div>
                                <!-- /.input group -->
                                <div class="form-group">
                                    <label>{{ __('label.warehouse') }} (*)</label>
                                    <select class="form-control select2" id="warehouse" name="warehouse_id"
                                            title="{{ __('label.warehouse') }}" style="width: 100%">
                                        <option value="0"
                                                selected>{{ __('label.please_choose_field') }}</option>
                                        @foreach($listWarehouse as $warehouse)
                                            <option {{ ((old('warehouse_id') && (old('warehouse_id') == $warehouse->id) || ($item && $item->warehouse_id == $warehouse->id)) ? 'selected' : '') }}
                                                    value="{{ $warehouse->id }}">{{ $warehouse->code }}</option>
                                        @endforeach
                                    </select>
                                    <span class="has-error">{{$errors->first('warehouse_id')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-info"></i> {{__('label.login_info')}}</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label>{{ __('label.email') }} (*)</label>
                                    <input type="email" required id="email" value="{{(old('email')) ? old('email') : (($item) ? $item->user->email : '') }}" name="email" class="form-control" placeholder="{{ __('label.email') }}">
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
                                                <input
                                                        type="checkbox"
                                                        name="active"
                                                        {{ (old('active') || $item->user->activated == \App\Helpers\Business::USER_ACTIVE) ? 'checked' : '' }}
                                                />  {{ __('label.active') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox icheck">
                                            <label>
                                                <input
                                                        type="checkbox"
                                                        name="baned"
                                                        {{ (old('baned') || $item->user->baned == \App\Helpers\Business::USER_BANED) ? 'checked' : '' }}
                                                />  {{ __('label.baned') }}
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
    <link rel="stylesheet" href="{{ asset('public/admin') }}/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="{{asset('public/admin')}}/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="{{ asset('public/admin') }}/plugins/iCheck/square/blue.css">
@endsection

@section('script')
    <script src="{{ asset('public/admin') }}/plugins/select2/select2.full.min.js"></script>
    <script src="{{asset('public/admin')}}/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="{{ asset('public/admin') }}/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();

            $('#datepicker').datepicker({
                autoclose: true,
                format:'dd/mm/yyyy'
            });
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection
