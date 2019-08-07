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
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>{{ __('label.name') }}</th>
                    </tr>
                    </thead>
                    <form action="{{ route('role.postPermission', $id) }}" method="post" role="form" id="form-permission">
                        {{ csrf_field() }}
                        <tbody>
                        @foreach($listPermission as $k => $item)
                        <tr>
                            <th><input type="checkbox" data-id="{{ $k }}" class="checkboxAll" /> <br>
                                {{ $item->group_key }}
                            </th>
                            @if(is_array(json_decode('[' . $item->list . ']', true)))
                            @foreach(json_decode('[' . $item->list . ']', true) as  $i)
                                <td>
                                    <div>
                                        <label>
                                            <input class="checkbox{{$k}}" type="checkbox" name="permission[]" value="{{ $i['id'] }}" {{ (in_array($i['id'], $arrPermission)) ? 'checked' : '' }} /><br>
                                            <code>{{ $i['description'] }}</code>
                                        </label>
                                    </div>
                                </td>
                            @endforeach
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </form>
                </table>
            </div>
            @can('edit-permission')
            <div class="box-footer with-border">
                <div class="box-tools pull-right">
                    <button id="button-permission" type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> {{ __('label.submit') }}</button>
                </div>
            </div>
            @endcan
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection

@section('script')
    <script>
        $(function () {
            $('.checkboxAll').on('click', function(){
                var k = $(this).attr('data-id');
                if($(this).is(':checked')){
                    $('.checkbox' + k).prop('checked', true);
                }else{
                    $('.checkbox' + k).prop('checked', false);
                }
            });

            $('#button-permission').on('click', function(){
                $('#form-permission').submit();
            });
        });
    </script>
@endsection