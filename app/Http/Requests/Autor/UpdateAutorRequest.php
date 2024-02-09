<?php

namespace App\Http\Requests\Autor;

use App\Core\Contracts\ReturnDataInterface;
use App\Models\Dto\AutorDto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAutorRequest extends FormRequest implements ReturnDataInterface
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
            'id' => ['required', 'integer'],
            'nombre' => ['required', 'min:5', 'max:150']
        ];
    }

    public function attributes(): array
    {
        return [
            'id' => 'Identificador',
            'nombre' => 'Nombre'
        ];
    }

    public function toData(): AutorDto
    {
        return AutorDto::from($this->all());
    }
}
