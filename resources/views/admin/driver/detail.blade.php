@extends('layouts.admin')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-body box-profile">
                        <button class="btn btn-sm pull-right btn-update-avatar" data-toggle="tooltip" data-placement="bottom" title="Update Avatar"><i class="fa fa-pencil-square-o"></i></button>
                        <img class="profile-user-img img-responsive img-circle" src="{{ $item->user->image ? route('api.image.show', ['id' => $item->user->image->id, 'type' => $item->user->image->type]) : '' }}">

                        <h3 class="profile-username text-center">{{$item->user->name}} ( {{$item->warehouse->code}} )</h3>

                        <p class="text-muted text-center" data-toggle="tooltip" data-placement="top">
                            <span class="label label-info">{{$userStatus[$item->user->activated]}}</span>
                            <span class="label label-warning">{{$userBaned[$item->user->baned]}}</span>
                        </p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{__('label.phone')}}</b> <a class="pull-right">{{$item->user->phone}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{__('label.email')}}</b> <a class="pull-right">{{$item->user->email}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{__('label.gender')}}</b> <a class="pull-right">{{$genderType[$item->user->gender]}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{__('label.birthday')}}</b> <a class="pull-right">{!! \App\Helpers\Util::showCreatedAt($item->user->birthday, 'd-m-Y', 'Y-m-d') !!}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{__('label.address')}}</b> <a class="pull-right">{{$item->user->address}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{__('label.rate')}}</b>
                                <span style="color: yellow" class="pull-right">
                                    @php $totalRate = $item->rateDriver($item->id); $subRate = 0; @endphp
                                    @for($i=0; $i<(int)$totalRate; $i++)
                                        @php $subRate++ @endphp
                                        <i class="fa fa-fw fa-star"></i>
                                    @endfor
                                    @php $sub = $totalRate - $subRate @endphp
                                    @if(0.25 <= $sub && $sub <= 0.75)
                                        <i class="fa fa-fw fa-star-half-o"></i>
                                    @elseif(0.75 <= $sub)
                                        <i class="fa fa-fw fa-star"></i>
                                    @endif
                                </span>
                            </li>
                        </ul>

                        @if(!$item->user->activated)
                            <button class="btn btn-success btn-block btn-activated"><b>{{__('label.delete')}}</b></button>
                        @endif
                        <a class="btn btn-danger btn-block btn-baned"><b>{{ ($item->user->baned) ? __('label.un_baned') : __('label.baned') }}</b></a>
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
                                <th>{{ __('label.car') }}</th>
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
                                    <td><a target="_blank" href="{{route('car.detail', $i->cId)}}">{{ $i->cName . ' (' . $i->number . ')' }}</a></td>
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
        <div class="box box-success">
            <div class="box-body">
                {!! $map['html'] !!}
            </div>
        </div>
    </section>
    <form action="{{route('image.web.store')}}" id="frChangeAvatar" method="post" enctype="multipart/form-data" style="display: none">
        {{ csrf_field() }}
        <input type="file" name="photo" accept="image/jpeg, image/png" />
        <input type="text" name="service_id" value="{{$item->user_id}}" />
    </form>

@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('script')
    {!! $map['js'] !!}
    <script src="{{asset('admin')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('admin')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{!! asset('/admin/dist/js/jquery.number.min.js') !!}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>

    <script>
        $(function () {
            var centreGot = false;

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
                $('input[name=photo]').click();
                $('input[name=photo]').change(function(e){
                    $('#frChangeAvatar').submit();
                });
            });

            $('.btn-baned').click(function(e){
                e.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "{{__('label.change_baned_customer')}}",
                    icon: "warning",
                    dangerMode: true,
                    buttons: ["Cancel", "Delete"],
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "post",
                            url: "{{route('user.ajaxBaned', $item->user_id)}}",
                        }).done(function (data) {
                            if (data.code == 200) {
                                window.location.reload(true);
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