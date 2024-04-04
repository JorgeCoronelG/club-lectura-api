<?php

namespace App\Http\Requests\Book;

use App\Core\Contracts\ReturnDataInterface;
use App\Models\Dto\LibroDto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateImageBookRequest extends FormRequest implements ReturnDataInterface
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
            'imagenFile' => ['required', 'file', 'image', 'max:5000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'imagenFile' => 'Imagen'
        ];
    }

    public function toData(): LibroDto
    {
        return LibroDto::from($this->all());
    }
}
