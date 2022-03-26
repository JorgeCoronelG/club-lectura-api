@component('mail::message')
    Hola {{$name}}

    Hemos creado con éxito tu cuenta. Por favor, verifícala usando el siguiente enlace:

    @component('mail::button', ['url' => $url])
        Verificar cuenta
    @endcomponent

    Gracias,<br>
    {{ config('app.name') }}
@endcomponent
