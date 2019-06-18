@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-body">
                <form role="form" action="{{($item) ? route('car.update', $item->id) : route('car.store') }}" method="post">
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
                            <input type="text" required id="name" value="{{(old('name')) ? old('name') : (($item) ? $item->name : '') }}" name="name" class="form-control" placeholder="{{ __('label.name') }}">
                            <span class="has-error">{{$errors->first('name')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.number_car') }} (*)</label>
                            <input {{ ($item) ? 'readonly' : '' }} type="text" required id="number" value="{{(old('number')) ? old('number') : (($item) ? $item->number : '') }}" name="number" class="form-control" placeholder="{{ __('label.number') }}">
                            <span class="has-error">{{$errors->first('number')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.manufacturer') }} (*)</label>
                            <input {{ ($item) ? 'readonly' : '' }} type="text" required id="manufacturer" value="{{(old('manufacturer')) ? old('manufacturer') : (($item) ? $item->manufacturer : '') }}" name="manufacturer" class="form-control" placeholder="{{ __('label.manufacturer') }}">
                            <span class="has-error">{{$errors->first('manufacturer')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.brand') }} (*)</label>
                            <input type="text" required id="brand" value="{{(old('brand')) ? old('brand') : (($item) ? $item->brand : '') }}" name="brand" class="form-control" placeholder="{{ __('label.brand') }}">
                            <span class="has-error">{{$errors->first('brand')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.weight') }} (*)</label>
                            <input type="text" required id="weight" value="{{(old('weight')) ? old('weight') : (($item) ? $item->weight : '') }}" name="weight" class="form-control" placeholder="{{ __('label.weight') }}">
                            <span class="has-error">{{$errors->first('weight')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.license_plate') }} (*)</label>
                            <input {{ ($item) ? 'readonly' : '' }} type="text" required id="license_plate" value="{{(old('license_plate')) ? old('license_plate') : (($item) ? $item->license_plate : '') }}" name="license_plate" class="form-control" placeholder="{{ __('label.license_plate') }}">
                            <span class="has-error">{{$errors->first('license_plate')}}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('label.type') }} (*)</label>
                            <div class="form-group">
                                <select class="form-control" id="type" required name="type"
                                        title="{{ __('label.type') }}">
                                    <option disabled selected value>{{ __('label.please_choose_field') }}</option>
                                    @foreach($carType as $k => $type)
                                        <option {{ ((old('type') && (old('type') == $k) || ($item && $item->type == $k)) ? 'selected' : '') }}
                                                value="{{ $k }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="has-error">{{$errors->first('type')}}</span>
                        </div>
                        <div class="form-group" id="owner_id" style="display: none">
                            <label>{{ __('label.owner') }} (*)</label>
                            <select class="form-control select2" name="owner_id"
                                    title="{{ __('label.owner') }}" style="width: 100%">
                                <option value="0"
                                        selected>{{ __('label.please_choose_field') }}</option>
                                @foreach($listDriver as $user)
                                    <option {{ ((old('owner_id') && (old('owner_id') == $user->id) || ($item && $item->owner_id == $user->id)) ? 'selected' : '') }}
                                            value="{{ $user->id }}">{{ $user->user->name }}</option>
                                @endforeach
                            </select>
                            <span class="has-error">{{$errors->first('owner_id')}}</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/select2/select2.css">
@endsection

@section('script')
    <script src="{{asset('admin')}}/plugins/select2/select2.js"></script>
    <script>
        $(function () {
            $('.select2').select2();

            $('#type').on('change', function () {
                if ($(this).val() == 1){
                    $('#owner_id').show();
                }else{
                    $('#owner_id').hide();
                }
            })

            var checkOwner = '{{($item && $item->type == 1) ? true : false}}';
            if (checkOwner) {
                $('#owner_id').show();
            }
        });
    </script>
@endsection
