@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-body">
                <form role="form" action="{{ route('permission.postEditRoleUser', $id) }}" method="post">
                    {{csrf_field()}}
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$title}}</h3>
                        @can('create-permission')
                        <div class="box-tools pull-right">
                            <button type="submit" class="btn btn-primary">{{__('label.submit')}}</button>
                        </div>
                        @endcan
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('choose_permission') }}</label>
                            <select class="form-control select2" style="width: 100%;" name="role_id" required>
                                <option selected="selected">{{ __('choose_permission') }}</option>
                                @foreach($listRole as $role)
                                    <option value="{{ $role->id }}" {{ (old('role_id') == $role->id) ? 'selected' : '' }}>{{ $role->title }}</option>
                                @endforeach
                            </select>
                            <span class="has-error">{{$errors->first('role_id')}}</span>
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
@endsection

@section('script')
    <script src="{{ asset('public/admin') }}/plugins/select2/select2.full.min.js"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
        });
    </script>
@endsection