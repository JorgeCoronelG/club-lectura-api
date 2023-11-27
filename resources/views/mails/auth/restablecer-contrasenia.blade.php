<x-mail::message>
Hola {{ $nombreCompleto }}.

Tu nueva contraseña es: <strong>{{ $contrasenia }}</strong>

Atentamente,
{{ config('app.name') }}

<x-mail::subcopy>
Nota: Te recordamos que puedes cambiar tu contraseña en tu perfil dentro de la plataforma.
</x-mail::subcopy>
</x-mail::message>
