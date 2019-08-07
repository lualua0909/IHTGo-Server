@component('mail::message')
# Reset Password

Mật khẩu của bạn được thay đổi thành công, vui lòng login với mật khẩu bên duoi.

@component('mail::button', ['url' => ''])
{{ $password }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
