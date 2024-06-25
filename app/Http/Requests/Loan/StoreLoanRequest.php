<?php

namespace App\Http\Requests\Loan;

use App\Core\Contracts\ReturnDataInterface;
use App\Models\Dto\LibroDto;
use App\Models\Dto\PrestamoDto;
use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest implements ReturnDataInterface
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
            'fechaPrestamo' => ['required', 'date', 'date_format:Y-m-d'],
            'fechaEntrega' => ['required', 'date', 'date_format:Y-m-d', 'after:fechaPrestamo'],
            'usuarioId' => ['required', 'integer', 'exists:usuarios,id'],
            'libros' => ['required', 'array'],
            'libros.*.id' => ['required', 'integer', 'exists:libros,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'fechaPrestamo' => 'Fecha de Prestamo',
            'fechaEntrega' => 'Fecha de Entrega',
            'usuarioId' => 'Usuario',
            'libros' => 'Libros',
            'libros.*.id' => 'Identificador del libro #:position',
        ];
    }

    public function toData(): PrestamoDto
    {
        $libros = [];
        foreach ($this->libros as $book) $libros[] = LibroDto::from($book);

        return PrestamoDto::from(array_merge($this->all(), ['libros' => $libros]));
    }
}
