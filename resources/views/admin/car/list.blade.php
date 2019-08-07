@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $title }}</h3>
                @can('create-car')
                    <div class="box-tools pull-right">
                        <a href="{{route('car.add')}}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i> {{ __('label.add_new') }}</a>
                    </div>
                @endcan
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>{{ __('label.number_car') }}</th>
                        <th>{{ __('label.type') }}</th>
                        <th>{{ __('label.weight') }}</th>
                        <th>{{ __('label.type_car') }}</th>
                        <th>{{ __('label.owner') }}</th>
                        <th>{{ __('label.created') }}</th>
                        <th class="text-center">{{ __('label.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listResult as $item)
                        <tr>
                            <td><a href="{{route('car.detail', $item->id)}}">{{ $item->number }}</a></td>
                            <td>{{ $carType[$item->type] }}</td>
                            <td>{{ $item->weight }}</td>
                            <td>{{ $carTypeOther[$item->type_car] }}</td>
                            <td>{{ ($item->owner) ? optional($item->owner->user)->name : __('label.company') }}</td>
                            <td>{!! \App\Helpers\Util::showCreatedAt($item->created_at) !!}</td>
                            <td class="text-center">
                                @can('edit-car')
                                    <a href="{{route('car.edit', $item->id)}}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan
                                @can('delete-car')
                                     <a onclick="return confirm_delete('{{ __('label.are_you_sure') }}')" href="{{route('car.delete', $item->id)}}" class="btn btn-danger btn-sm">
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