<?php

namespace App\Http\Requests\Author;

use App\Http\Requests\Contracts\IReturnDto;
use App\Models\Dto\AuthorDTO;
use App\Models\FormFields\AuthorFields;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAuthorRequest extends FormRequest implements IReturnDto
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
            'id' => ['required', 'integer'],
            'name' => [
                'required',
                'min:'.AuthorFields::NAME_MIN_LENGTH,
                'max:'.AuthorFields::NAME_MAX_LENGTH,
                Rule::unique('authors', 'name')->ignore($this->route('author'), 'id')
            ]
        ];
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function toDTO(): AuthorDTO
    {
        return new AuthorDTO(id: $this->id, name: trim($this->name));
    }
}
