@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-body">
                    <form role="form" action="{{($item) ? route('role.postUpdateRole', $item->id) : route('role.postCreateRole') }}" method="post">
                        {{csrf_field()}}
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$title}}</h3>
                        @can('edit-permission')
                        <div class="box-tools pull-right">
                            <button type="submit" class="btn btn-primary">{{__('label.submit')}}</button>
                        </div>
                        @endcan
                    </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('label.name') }} (*)</label>
                                <input type="text" required id="title" value="{{(old('name')) ? old('name') : (($item) ? $item->name : '') }}" name="name" class="form-control" placeholder="{{ __('label.name') }}">
                                <span class="has-error">{{$errors->first('name')}}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('label.description') }} (*)</label>
                                <input type="text" required value="{{(old('description')) ? old('description') : (($item) ? $item->description : '') }}" name="description" class="form-control" placeholder="{{ __('label.description') }}">
                                <span class="has-error">{{$errors->first('description')}}</span>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
    </section>
    <!-- /.content -->
@endsection
