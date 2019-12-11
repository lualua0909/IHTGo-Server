@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $title }}</h3>
                @can('create-driver')
                    <div class="box-tools pull-right">
                        <a href="{{route('driver.add')}}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> {{ __('label.add_new') }}</a>
                    </div>
                @endcan
            </div>
            <div class="box-body">
                <table id="itemTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>{{ __('label.name') }}</th>
                        <th>{{ __('label.identification') }}</th>
                        <th>{{ __('label.experience') }}</th>
                        <th>{{ __('label.driver_date') }}</th>
                        <th>{{ __('label.current_address') }}</th>
                        <th>{{__('label.status')}}</th>
                        <th class="text-center">{{ __('label.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listResult as $item)
                        <tr>
                            <td><a href="{{route('driver.detail', $item->id)}}">{{ optional($item->user)->name }}</a></td>
                            <td>{{ $item->identification }}</td>
                            <td>{{ $item->experience }}</td>
                            <td>{{ ($item->date) ? \Carbon\Carbon::createFromFormat('Y-m-d', $item->date)->format('d/m/Y') : null }}</td>
                            <td>{{ $item->address }}</td>
                            <td>
                                {{$item->deleted_at ? $driverBaned[\App\Helpers\Business::USER_BANED] : $driverBaned[\App\Helpers\Business::USER_UN_BANED]}}
                            </td>
                            <td class="text-center">
                                @can('edit-driver')
                                    <a href="{{route('driver.edit', $item->id)}}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan
                                @can('delete-driver')
                                    <a onclick="return confirm_delete('{{ __('label.are_you_sure') }}')" href="{{route('driver.delete', $item->id)}}" class="btn btn-danger btn-sm">
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
            if($("#itemTable").length > 0) {
                $("#itemTable").DataTable(
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