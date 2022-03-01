<?php

namespace App\Helpers\Enum;

/**
 * @author JorgeCoronelG
 * @version 1.0
 */
class Message
{
    // Mensajes de validaciones
    public const MODEL_IS_DIRTY = 'Se debe especificar al menos un valor diferente para actualizar.';
    public const CREDENTIALS_INVALID = 'Credenciales inválidas.';
    public const USER_IS_VERIFIED = 'El usuario ya fue verificado.';
    public const USER_NOT_VERIFIED = 'Usuario no verificado.';
    public const INVALID_QUERY_PARAMETER = 'Parámetro de consulta inválido.';

    // Mensajes de excepciones
    public const AUTHENTICATION_EXCEPTION = 'No autenticado.';
    public const MODEL_NOT_FOUND_EXCEPTION = 'No existe el registro.';
    public const AUTHORIZATION_EXCEPTION = 'No tiene permisos para ejecutar esta acción.';
    public const NOT_FOUND_HTTP_EXCEPTION = 'No se encontró la URL especificada.';
    public const METHOD_NOT_ALLOWED_HTTP_EXCEPTION = 'Método no válido.';
    public const QUERY_EXCEPTION_1451 = 'No se puede eliminar el recurso porque está relacionado con algún otro.';
    public const INTERNAL_SERVER_ERROR = 'Ocurrió algo inesperado. Consulte al administrador.';
    public const THROTTLE_REQUESTS_EXCEPTION = 'Muchos intentos realizados.';

    // Mensajes de asunto de correo electrónico
    public const CONFIRM_EMAIL = 'Confirma tu correo electrónico';
    public const EMAIL_UPDATED = 'Confirma tu nuevo correo electrónico';
    public const RESTORE_PASSWORD = 'Nueva contraseña';

    public static function getMessageHasNotAllowedSorts(string $class): string
    {
        return "Establezca la propiedad pública allowedSorts dentro de $class";
    }
}
