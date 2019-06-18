@if(\Illuminate\Support\Facades\Session::has('flash_message'))
	<div class="row clearfix">
		<div class="alert alert-{!! \Illuminate\Support\Facades\Session::get('level') !!}" style="margin: 1em 2em 0 2em">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Thông báo!</strong> {!! \Illuminate\Support\Facades\Session::get('flash_message') !!}
		</div>
	</div>
@endif