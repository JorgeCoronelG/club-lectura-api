<?php

namespace App\Http\Requests\Author;

use App\Http\Requests\Contracts\IReturnDto;
use App\Models\Dto\AuthorDTO;
use App\Models\FormFields\AuthorFields;
use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest implements IReturnDto
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
                'min:'.AuthorFields::NAME_MIN_LENGTH,
                'max:'.AuthorFields::NAME_MAX_LENGTH,
                'unique:authors'
            ]
        ];
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function toDTO(): AuthorDTO
    {
        return new AuthorDTO(name: trim($this->name));
    }
}
