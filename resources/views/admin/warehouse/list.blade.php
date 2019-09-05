@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $title }}</h3>
                @can('create-warehouse')
                    <div class="box-tools pull-right">
                        <a href="{{route('warehouse.add')}}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> {{ __('label.add_new') }}</a>
                    </div>
                @endcan
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>{{ __('label.code') }}</th>
                        <th>{{ __('label.manager') }}</th>
                        <th>{{ __('label.distribution') }}</th>
                        <th>{{ __('label.acreage') }}</th>
                        <th>{{ __('label.address') }}</th>
                        <th>{{ __('label.created') }}</th>
                        <th class="text-center">{{ __('label.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listResult as $item)
                        <tr>
                            <td>{{ $item->code }}</td>
                            <td>{{ optional($item->manager)->name }}</td>
                            <td>{{ $item->distribution }}</td>
                            <td>{{ $item->acreage }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{date_format($item->created_at,"d/m/Y H:i:s")}}</td>
                            <td class="text-center">
                                @can('edit-warehouse')
                                    <a href="{{route('warehouse.edit', $item->id)}}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan
                                @can('delete-warehouse')
                                    <a onclick="return confirm_delete('{{ __('label.are_you_sure') }}')" href="{{route('warehouse.delete', $item->id)}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-close"></i>
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
                    {"columnDefs": [
                            {
                                "targets": [ 0, 3, 6 ],
                                "orderable": false
                            }
                        ],
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