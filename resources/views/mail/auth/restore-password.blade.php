@component('mail::message')
    Hola {{ $name }}

    Se ha restaurado tu contraseña de manera exitosa.

    Tu nueva contraseña es: <b>{{ $newPassword }}</b>

    Gracias,<br>
    {{ config('app.name') }}
@endcomponent
