<?php

namespace App\Http\Requests\Auth;

use App\Core\Contracts\IReturnDto;
use App\Models\Dto\UserDTO;
use App\Models\FormFields\UserFields;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest implements IReturnDto
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email:dns', 'max:'.UserFields::EMAIL_MAX_LENGTH],
            'password' => ['required', 'min:'.UserFields::PASSWORD_MIN_LENGTH, 'max:'.UserFields::PASSWORD_MAX_LENGTH]
        ];
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function toDTO(): UserDTO
    {
        return new UserDTO(
            email: $this->email,
            password: $this->password
        );
    }
}
