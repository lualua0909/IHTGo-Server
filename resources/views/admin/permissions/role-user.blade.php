@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-body">
                <form role="form" action="{{ route('role.postAddRoleForUser', $id) }}" method="post">
                    {{csrf_field()}}
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$title}}</h3>
                        @can('create-permission')
                        <div class="box-tools pull-right">
                            <button type="submit" class="btn btn-primary">{{__('label.submit')}}</button>
                        </div>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ __('label.permission') }}</label>
                                <select id="optgroup" name="role_id[]" class="ms" multiple="multiple">
                                    @php $arrCheck = (old('role_id')) ? old('role_id') : $arrItem @endphp
                                    @foreach($listRole as $role)
                                        <option value="{{ $role->id }}" {{ (in_array($role->id, $arrCheck)) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/select2.min.css">
    <link href="{{ asset('admin') }}/plugins/multi-select/css/multi-select.css" rel="stylesheet">
    <style>
        .ms-container {
            width: 100%;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('admin') }}/plugins/select2/select2.full.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/multi-select/js/jquery.multi-select.js"></script>
    <script>
        $(function () {
            $('#optgroup').multiSelect({ selectableOptgroup: true });
            $(".select2").select2();
        });
    </script>
@endsection