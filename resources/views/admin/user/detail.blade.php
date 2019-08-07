@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <button class="btn btn-sm pull-right btn-update-avatar" data-toggle="tooltip" data-placement="bottom" title="Update Avatar"><i class="fa fa-pencil-square-o"></i></button>
                        <img id="profile-user-img" class="profile-user-img img-responsive img-circle"
                             src="{{ $user->image ? route('api.image.show', ['id' => $user->image->id, 'type' => $user->image->type]) : '' }}" alt="User profile picture">
                        <hr>
                        <h3 class="profile-username text-center">{{ ($user) ? $user->name : 'Admin Manager' }}</h3>
                        <p class="text-muted text-center">
                            @if($user && $user->level == \App\Helpers\Business::USER_LEVEL_ADMIN)
                                {{ __('label.super_admin') }}
                            @elseif ($user && $user->level == \App\Helpers\Business::USER_LEVEL_EMPLOYEE)
                                {{ __('label.employer') }}
                            @endif
                        </p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{ __('label.code') }}</b> <a class="pull-right">
                                    {{ ($user) ? $user->code : 'Code' }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ __('label.status') }}</b> <a class="pull-right">
                                    {{ ($user) ? (($user->baned == \App\Helpers\Business::USER_UN_BANED) ? __('label.active') : __('label.un_active')) : 'Admin Status' }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ __('label.email') }}</b> <a class="pull-right">
                                    {{ ($user) ? $user->email : 'Email' }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ __('label.phone') }}</b> <a class="pull-right">
                                    {{ ($user) ? $user->phone : 'Phone' }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ __('label.gender') }}</b> <a class="pull-right">
                                    {{ ($user && $user->gender) ? $genderType[$user->gender] : 'Gender' }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ __('label.birthday') }}</b> <a class="pull-right">
                                    {{ ($user && $user->birthday) ? $user->birthday : 'Birthday' }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ __('label.created') }}</b> <a class="pull-right">{{ ($user) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('H:i:s d-m-Y') : 'Admin Created' }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li id="li-profile"><a href="#settings" data-toggle="tab">{{ __('label.profile') }}</a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="active tab-pane" id="settings">
                            <form class="form-horizontal" method="post" action="">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{{ __('label.name') }}</label>
                                    <div class="col-sm-9">
                                        <input required type="text" disabled class="form-control" name="name" placeholder="{{ __('label.name') }}" value="{{ (old('name') ? old('name') : $user->name) }}">
                                        <span class="has-error">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{{ __('label.email') }}</label>
                                    <div class="col-sm-9">
                                        <input required type="email" disabled class="form-control" name="email" placeholder="{{ __('label.email') }}" value="{{ (old('email') ? old('email') : $user->email) }}">
                                        <span class="has-error">{{ $errors->first('email') }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{{ __('label.phone') }}</label>
                                    <div class="col-sm-9">
                                        <input required type="text" disabled class="form-control" name="phone" placeholder="{{ __('label.phone') }}" value="{{ (old('phone') ? old('phone') : $user->phone) }}">
                                        <span class="has-error">{{ $errors->first('phone') }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{{__('label.birthday')}}:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" disabled name="birthday" value="{{(old('birthday')) ? old('birthday') : ($user->birthday) ? $user->birthday : null}}" class="form-control pull-right" id="datepicker" required />
                                        </div>
                                        <span class="has-error">{{ $errors->first('birthday') }}</span>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{{ __('label.gender') }} (*)</label>
                                    <div class="col-sm-9">
                                        <select disabled class="form-control" name="gender"
                                                title="{{ __('label.gender') }}">
                                            <option disabled selected value>{{ __('label.please_choose_field') }}</option>
                                            @foreach($genderType as $k => $type)
                                                <option {{ ((old('gender') && (old('gender') == $k) || ($user && $user->gender == $k)) ? 'selected' : '') }}
                                                        value="{{ $k }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        <span class="has-error">{{$errors->first('gender')}}</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
    <form action="{{route('image.web.store')}}" id="frChangeAvatar" method="post" enctype="multipart/form-data" style="display: none">
        {{ csrf_field() }}
        <input type="file" name="file" accept="image/jpeg, image/png" />
        <input type="text" name="service_id" value="{{$user->id}}" />
    </form>
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/admin')}}/plugins/datepicker/datepicker3.css">
@endsection

@section('script')
    <script src="{{asset('public/admin')}}/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $('#datepicker').datepicker({
            autoclose: true
        });

        @if ($errors->has('name') || $errors->has('phone') || $errors->has('email'))
        $("#settings").addClass("active");
        $('#li-profile').addClass('active');
        @else
        $("#timeline").addClass("active");
        $('#li-password').addClass('active');
        @endif

        $('.btn-update-avatar').click(function (e) {
            e.preventDefault();
            $('input[name=file]').click();
            $('input[name=file]').change(function(e){
                $('#frChangeAvatar').submit();
            });
        });

        var loadFile = function(event) {
            var output = document.getElementById('profile-user-img');
            output.src = URL.createObjectURL(event.target.files[0]);
        };

        $('button#submit-avatar').on('click', function(){
            changeAvatar();
        });

        $('button#cancel-avatar').on('click', function(){
            $('img#profile-user-img').attr('src','11');
            $('button#submit-avatar').hide();
            $('button#cancel-avatar').hide();
        });
        function changeAvatar(){
            $("#formContent").submit(function(e){
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: BASE_URL + '/api/upload',
                    type: 'POST',
                    cache: false,
                    async: false,
                    mimeTypes:"multipart/form-data",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(respone){
                        if(respone){
                            $('button#submit-avatar').hide();
                            $('button#cancel-avatar').hide();
                        }
                    }
                });
            });
        }
    </script>
@endsection