<?php

namespace App\Http\Requests\Auth;

use App\Core\Contracts\ReturnDataInterface;
use App\Models\Data\UsuarioData;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest implements ReturnDataInterface
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'correo' => ['required', 'email:dns', 'max:150'],
            'contrasenia' => ['required', 'min:6', 'max:100'],
        ];
    }

    public function attributes(): array
    {
        return [
            'correo' => 'Correo electrónico',
            'contrasenia' => 'Contraseña'
        ];
    }

    public function toData(): UsuarioData
    {
        return UsuarioData::from($this->all());
    }
}
