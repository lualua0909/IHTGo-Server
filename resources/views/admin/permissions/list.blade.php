@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $title }}</h3>
                @can('create-permission')
                <div class="box-tools pull-right">
                    <a href="{{ route('role.getCreateRole') }}" class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i> {{ __('label.add_new') }}</a>
                </div>
                    @endcan
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>{{ __('label.name') }}</th>
                        <th>{{ __('label.description') }}</th>
                        <th class="text-center">{{ __('label.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listResult as $item)
                    <tr>
                        <td><a href="{{ route('role.getPermission', $item->id) }}">{{$item->name}}</a></td>
                        <td>{{ $item->description }}</td>
                        <td class="text-center">
                            @can('edit-permission')
                            <a href="{{ route('role.getUpdateRole', $item->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> {{ __('label.edit') }}
                            </a>
                            @endcan
                                @can('delete-permission')
                            <a onclick="return confirm_delete('{{ __('label.confirm_delete') }}')" href="{{ route('role.deleteRole', $item->id) }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-edit"></i> {{ __('label.delete') }}
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
    <link rel="stylesheet" href="{{asset('public/admin')}}/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('script')
    <script src="{{asset('public/admin')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/admin')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
@endsection