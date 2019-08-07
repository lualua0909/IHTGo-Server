@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-body">
                <form role="form" action="{{($item) ? route('company.update', $item->id) : route('company.store') }}" method="post">
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
                            <div class="form-group">
                                <label>{{ __('label.tax') }} (*)</label>
                                <input type="text" required id="tax" value="{{(old('tax')) ? old('tax') : (($item) ? $item->tax : '') }}" name="tax" class="form-control" placeholder="{{ __('label.tax') }}">
                                <span class="has-error">{{$errors->first('tax')}}</span>
                            </div>
                            <div class="form-group">
                                <label>{{ __('label.address') }}</label>
                                <input type="text" id="address" value="{{(old('address')) ? old('address') : (($item) ? $item->address : '') }}" name="address" class="form-control" placeholder="{{ __('label.address') }}">
                                <span class="has-error">{{$errors->first('address')}}</span>
                            </div>
                            <div class="form-group">
                                <label>{{ __('label.province') }} (*)</label>
                                <select class="form-control select2" id="province_id" name="province_id"
                                        title="{{ __('label.province') }}" style="width: 100%">
                                    <option value="0"
                                            selected>{{ __('label.please_choose_field') }}</option>
                                    @foreach($listProvince as $province)
                                        <option {{ ((old('province_id') && (old('province_id') == $province->province_id) || ($item && $item->province_id == $province->province_id)) ? 'selected' : '') }}
                                                value="{{ $province->province_id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                <span class="has-error">{{$errors->first('province_id')}}</span>
                            </div>
                            @if(isset($listDistrict))
                                <div class="form-group">
                                    <label>{{ __('label.district') }} (*)</label>
                                    <select class="form-control" id="district_id" name="district_id"
                                            title="{{ __('label.district') }}" style="width: 100%">
                                        <option value="0"
                                                selected>{{ __('label.please_choose_field') }}</option>
                                        @foreach($listDistrict as $district)
                                            <option {{ ((old('district_id') && (old('district_id') == $district->id) || ($item && $item->district_id == $district->id)) ? 'selected' : '') }}
                                                    value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="has-error">{{$errors->first('district_id')}}</span>
                                </div>
                            @else
                                <div class="form-group">
                                    <label>{{ __('label.district') }} (*)</label>
                                    <select class="form-control" id="district_id" name="district_id"
                                            title="{{ __('label.district') }}" style="width: 100%">
                                        <option value="0"
                                                selected>{{ __('label.please_choose_field') }}</option>
                                    </select>
                                    <span class="has-error">{{$errors->first('district_id')}}</span>
                                </div>
                            @endif

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
            $('.select2').select2();
            $("#district_id").select2();

            $('#province_id').on('change', function () {
                $("#district_id").empty();
                var cId = $('#province_id').val();
                $.get("{{route('order.district')}}" + '/' + cId , function(data, status){
                    if (status == 'success'){
                        $("#district_id").select2({
                            data: data.district
                        })
                    }
                });
            })
        });
    </script>
@endsection


