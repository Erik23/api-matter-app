@component('mail::message')
# Invitación Matter APP

Has recibido una invitación para dar feedback a {{ $username }}.

@component('mail::button', ['url' => env('APP_URL')])
Registrarte
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
