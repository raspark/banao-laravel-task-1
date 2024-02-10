@component('mail::message')
    <p>Hello {{ $user->name }}</p>
    <p>Click the button below to reset your password</p>
    @component('mail::button', ['url' => $url])
        Reset Password
    @endcomponent
    <p>Or click on this link</p>
    <p><a href="{{ $url }}">{{ $url }}</a></p>
    <p>Link is valid for 10 minutes</p>
    <p>If you did not request a password reset, no further action is required.</p>
    <p>In case you have any issues recoving your password, please contact us.</p>
    <p>Thanks</p>
    <p>{{ config('app.name') }}</p>
@endcomponent