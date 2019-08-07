@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $title }}</h3>
            </div>
            <div class="box-body">
                <table id="itemTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>{{ __('label.name') }}</th>
                        <th>{{ __('label.status') }}</th>
                        <th class="text-center">{{ __('label.action') }}</th>
                        <th class="text-center">Văn phòng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listResult as $item)
                        <tr>
                            <td>{{ $item->name }} </td>
                            <td> <span class="label {{$listPublishColor[$item->publish]}}">{{ $listPublish[$item->publish] }}</span></td>
                            <td class="text-center">
                                    <form action="{{route('district.action', $item->id)}}" method="post">
                                        @csrf
                                        <input name="publish" type="checkbox" value="1" @if($item->publish == 1) checked @endif />
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </form>

                            </td>
                            <td class="text-center">
                                    <form action="{{route('district.action2', $item->id)}}" method="post">
                                        @csrf
                                        <input name="publish_2" type="checkbox" value="1" @if($item->publish_2 == 1) checked @endif />
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </form>

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
                    {
                        "order": [[ 1, "desc" ]],

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