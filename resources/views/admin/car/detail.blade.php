@extends('layouts.admin')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-body box-profile">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{__('label.manufacturer')}}</b> <a class="pull-right">{{$item->manufacturer}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{__('label.name')}}</b> <a class="pull-right">{{$item->name}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{__('label.number_car')}}</b> <a class="pull-right">{{$item->number}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{__('label.license_plate')}}</b> <a class="pull-right">{{$item->license_plate}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{__('label.weight')}}</b> <a class="pull-right">{{$item->weight}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{__('label.owner')}}</b> <a class="pull-right">{{$item->owner}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{__('label.type')}}</b> <a class="pull-right">{{$item->type}}</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-danger btn-block btn-remove"><b>{{__('label.delete')}}</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('label.code') }}</th>
                                <th>{{ __('label.type') }}</th>
                                <th>{{ __('label.driver') }}</th>
                                <th>{{ __('label.status') }}</th>
                                <th>{{ __('label.total_price') }}</th>
                                <th>{{ __('label.created') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listHistory as $i)
                                <tr>
                                    <td><a target="_blank" href="{{route('order.detail', $i->id)}}">{{ $i->code }}</a></td>
                                    <td><span style="display: block; padding: 5px;" class="label {{$orderTypeColor[$i->type]}}">{{ $orderType[$i->type] }}</span></td>
                                    <td><a target="_blank" href="{{route('driver.detail', $i->dId)}}">{{ $i->name . ' (' . $i->phone . ')' }}</a></td>
                                    <td><span style="display: block; padding: 5px;" class="label {{$orderStatusColor[$i->status]}}">{{ $orderStatus[$i->status] }}</span></td>
                                    <td class="price">{{ $i->total_price }}</td>
                                    <td>{!! \App\Helpers\Util::showCreatedAt($i->created_at) !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <form action="" id="frChangeAvatar" method="post" enctype="multipart/form-data" style="display: none">
        {{ csrf_field() }}
        <input type="file" name="avatar" accept="image/jpeg, image/png" />
    </form>

@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('script')
    <script src="{{asset('admin')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('admin')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{!! asset('/admin/dist/js/jquery.number.min.js') !!}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>

    <script>
        $(function () {
            $('.price').number( true, 0 );

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

            $('.btn-update-avatar').click(function (e) {
                e.preventDefault();
                $('input[name=avatar]').click();
                $('input[name=avatar]').change(function(e){
                    $('#frChangeAvatar').submit();
                });
            });

            $('.btn-remove').click(function(e){
                e.preventDefault();
                var customerId = 1;
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover!",
                    icon: "warning",
                    dangerMode: true,
                    buttons: ["Cancel", "Delete"],
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "post",
                            url: "",
                            data: {customerId: customerId}
                        }).done(function (data) {
                            if (data.code == 200) {
                                location.href = '';
                            } else {
                                swal({
                                    title: "Error!",
                                    text: data.message,
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

@endsection