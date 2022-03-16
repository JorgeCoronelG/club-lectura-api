<?php

namespace App\Http\Requests\LiteraryGender;

use App\Http\Requests\Contracts\IReturnDto;
use App\Models\Dto\LiteraryGenderDTO;
use App\Models\FormFields\LiteraryGenderFields;
use Illuminate\Foundation\Http\FormRequest;

class StoreLiteraryGenderRequest extends FormRequest implements IReturnDto
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:'.LiteraryGenderFields::NAME_MIN_LENGTH,
                'max:'.LiteraryGenderFields::NAME_MAX_LENGTH,
                'unique:literary_genders'
            ]
        ];
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function toDTO(): LiteraryGenderDTO
    {
        return new LiteraryGenderDTO(name: trim($this->name));
    }
}
