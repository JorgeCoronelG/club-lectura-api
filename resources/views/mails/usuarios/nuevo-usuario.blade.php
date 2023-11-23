<x-mail::message>
Hola {{ $nombreCompleto  }}.

Tu correo fue registrado en el sistema del club de lectura. Para poder acceder al sistema, entra al siguiente <a href="{{ config('app.url_web') }}" target="_blank">link</a>.

Ingresa tu correo y la contraseña temporal es: <strong>{{ $contrasenia }}</strong>

<x-mail::subcopy>
Nota: dentro del sistema puedes cambiar la contraseña.
</x-mail::subcopy>

Gracias,
{{ config('app.name') }}
</x-mail::message>
