<x-mail::message>
Hola {{ $nombreCompleto  }}.

Tu correo fue registrado en el sistema del club de lectura. Para poder acceder al sistema, entra al siguiente <a href="{{ config('app.url_web') }}" target="_blank">link</a>.

Ingresa tu correo y la contraseña temporal es: <strong>{{ $contrasenia }}</strong>

Atentamente,
{{ config('app.name') }}

<x-mail::subcopy>
Nota: Te recordamos que puedes cambiar tu contraseña en tu perfil dentro de la plataforma.
</x-mail::subcopy>
</x-mail::message>
