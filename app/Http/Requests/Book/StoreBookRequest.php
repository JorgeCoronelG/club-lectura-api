<?php

namespace App\Http\Requests\Book;

use App\Core\Contracts\ReturnDataInterface;
use App\Models\Dto\AutorDto;
use App\Models\Dto\LibroDto;
use App\Models\Enum\CatalogoEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest implements ReturnDataInterface
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
            'isbn' => ['required', 'min:10', 'max:15'],
            'titulo' => ['required', 'min:2', 'max:150'],
            'resenia' => ['nullable', 'max:65000'],
            'numPaginas' => ['required', 'integer', 'min:1', 'max:5000'],
            'precio' => ['required', 'numeric', 'min:1', 'max:5000', 'decimal:0,2'],
            'edicion' => ['required', 'integer', 'min:1', 'max:127'],
            'imagenFile' => ['required', 'file', 'image', 'max:5000'],
            'numCopia' => ['required', 'integer', 'min:1', 'max:127'],
            'estadoFisicoId' => [
                'required',
                'integer',
                Rule::exists('catalogo_opciones', 'id')
                    ->where('catalogo_id', CatalogoEnum::ESTADO_FISICO_LIBRO->value)
            ],
            'idiomaId' => [
                'required',
                'integer',
                Rule::exists('catalogo_opciones', 'id')
                    ->where('catalogo_id', CatalogoEnum::IDIOMA->value)
            ],
            'estatusId' => [
                'required',
                'integer',
                Rule::exists('catalogo_opciones', 'id')
                    ->where('catalogo_id', CatalogoEnum::ESTATUS_LIBRO->value)
            ],
            'generoId' => [
                'required',
                'integer',
                Rule::exists('generos', 'id')
            ],
            'autores' => ['required', 'array'],
            'autores.*.id' => [
                'required',
                'integer',
                Rule::exists('autores', 'id')
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'isbn' => 'ISBN',
            'titulo' => 'Título',
            'resenia' => 'Reseña',
            'numPaginas' => 'N° páginas',
            'precio' => 'Precio',
            'edicion' => 'Edición',
            'imagenFile' => 'Imagen',
            'numCopia' => 'N° copia',
            'estadoFisicoId' => 'Estado físico',
            'idiomaId' => 'Idioma',
            'estatusId' => 'Estatus',
            'generoId' => 'Género literario',
            'autores' => 'Autores',
            'autores.*.id' => 'Identificador de autor'
        ];
    }

    public function toData(): LibroDto
    {
        $autores = [];
        foreach ($this->autores as $autor) $autores[] = AutorDto::from($autor);
        return LibroDto::from(array_merge($this->all(), ['autores' => $autores]));
    }
}
