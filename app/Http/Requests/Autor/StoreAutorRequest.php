<?php

namespace App\Http\Requests\Autor;

use App\Core\Contracts\ReturnDataInterface;
use App\Models\Data\AutorData;
use Illuminate\Foundation\Http\FormRequest;

class StoreAutorRequest extends FormRequest implements ReturnDataInterface
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
            'nombre' => ['required', 'min:5', 'max:150']
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'Nombre'
        ];
    }

    public function toData(): AutorData
    {
        return AutorData::from($this->all());
    }
}
