<?php

namespace App\Http\Requests\Auth;

use App\Core\Contracts\ReturnDataInterface;
use App\Models\Dto\UsuarioDto;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest implements ReturnDataInterface
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
            'contraseniaActual' => ['required', 'min:6', 'max:100'],
            'contrasenia' => ['required', 'min:6', 'max:100'],
        ];
    }

    public function attributes(): array
    {
        return [
            'contraseniaActual' => 'Contraseña actual',
            'contrasenia' => 'Contraseña',
        ];
    }

    public function toData(): UsuarioDto
    {
        return UsuarioDto::from([
            'contraseniaActual' => $this->contraseniaActual,
            'contrasenia' => bcrypt($this->contrasenia),
        ]);
    }
}
