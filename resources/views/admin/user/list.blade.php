@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $title }}</h3>
                @can('create-user')
                    <div class="box-tools pull-right">
                        <a href="{{route('user.add')}}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> {{ __('label.add_new') }}</a>
                    </div>
                @endcan
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>{{ __('label.name') }}</th>
                        <th>{{ __('label.phone') }}</th>
                        <th>{{ __('label.email') }}</th>
                        <th>{{ __('label.active') }}</th>
                        <th>{{ __('label.baned') }}</th>
                        <th>{{ __('label.created') }}</th>
                        <th class="text-center">{{ __('label.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listResult as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @if($item->activated == \App\Helpers\Business::USER_ACTIVE)
                                    <span class="label label-success">{{ __('label.active') }}</span>
                                @else
                                    <span class="label label-warning">{{ __('label.un_active') }}</span>
                                @endif
                            </td>
                            <td>
                                @if($item->baned == \App\Helpers\Business::USER_BANED)
                                    <span class="label label-warning">{{ __('label.baned') }}</span>
                                @else
                                    <span class="label label-success">{{ __('label.un_baned') }}</span>
                                @endif
                            </td>
                            <td>{!! \App\Helpers\Util::showCreatedAt($item->created_at) !!}</td>
                            <td >
                                @can('edit-user')
                                    <a href="{{route('user.edit', $item->id)}}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan
                                @if($item->baned == !\App\Helpers\Business::USER_BANED)
                                    @can('delete-user')
                                        <a onclick="return confirm_delete('{{ __('label.are_you_sure') }}')" href="{{route('user.delete', $item->id)}}" class="btn btn-danger btn-sm">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    @endcan
                                @endif
                                @can('create-permission')
                                    <a href="{{ route('role.addRoleForUser', $item->id) }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-fw fa-key"></i>
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

    <script>
        $(function () {
            if($("#example1").length > 0) {
                $("#example1").DataTable(
                    {
                        "order": [[ 5, "desc" ]],

                        "language": {
                            "lengthMenu": "{{ __('label.lengthMenu') }}",
                            "zeroRecords": "{{ __('label.zeroRecords') }}",
                            "info": "{{ __('label.info') }}",
                            "infoEmpty": "{{ __('label.infoEmpty') }}",
                            "search": "{{ __('label.search') }}",
                            "paginate": {
                                "first":      "{{ __('label.first') }}",
                                "last":       "{{ __('label.last') }}",
                                "next":       "{{ __('label.next') }}",
                                "previous":   "{{ __('label.previous') }}"
                            },
                            "infoFiltered": "({{ __('label.infoFiltered') }})"
                        }
                    }
                );
            }
        });
    </script>

@endsection