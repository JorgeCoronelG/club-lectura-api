<?php

namespace App\Http\Requests\LiterarySubgender;

use App\Http\Requests\Contracts\IReturnDto;
use App\Models\Dto\LiterarySubgenderDTO;
use App\Models\FormFields\LiterarySubgenderFields;
use App\Models\LiteraryGender;
use Illuminate\Foundation\Http\FormRequest;

class StoreLiterarySubgenderRequest extends FormRequest implements IReturnDto
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
                'min:'.LiterarySubgenderFields::NAME_MIN_LENGTH,
                'max:'.LiterarySubgenderFields::NAME_MAX_LENGTH,
                'unique:literary_subgenders'
            ],
            'literaryGenderId' => [
                'required',
                'exists:'.LiteraryGender::class.',id'
            ]
        ];
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function toDTO(): LiterarySubgenderDTO
    {
        return new LiterarySubgenderDTO(name: trim($this->name), literary_gender_id: $this->literaryGenderId);
    }
}
