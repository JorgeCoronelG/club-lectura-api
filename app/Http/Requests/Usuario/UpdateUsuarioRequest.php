<?php

namespace App\Http\Requests\Usuario;

use App\Core\Contracts\ReturnDataInterface;
use App\Models\Dto\UsuarioDto;
use App\Models\Enum\CatalogoEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUsuarioRequest extends FormRequest implements ReturnDataInterface
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
        $rules = [
            'id' => ['required', 'integer', 'bail'],
            'nombreCompleto' => ['required', 'min:5', 'max:150'],
            'correo' => [
                'required',
                'email:dns',
                'max:150',
                Rule::unique('usuarios', 'correo')
                    ->ignore($this->id, 'id')
            ],
            'telefono' => ['required', 'min:10', 'max:10'],
            'fechaNacimiento' => ['required', 'date', 'date_format:Y-m-d', 'before:now'],
            'sexoId' => [
                'required',
                'integer',
                Rule::exists('catalogo_opciones', 'id')
                    ->where('catalogo_id', CatalogoEnum::SEXO->value)
            ],
            'rolId' => [
                'required',
                'integer',
                Rule::exists('roles', 'id')
            ],
            'tipoId' => [
                'required',
                'integer',
                Rule::exists('catalogo_opciones', 'id')
                    ->where('catalogo_id', CatalogoEnum::TIPO_USUARIO->value)
            ],
        ];

        if (isset($this->escolar)) {
            return array_merge($rules, [
                'escolar' => ['required', 'array:matricula,tipoId'],
                'escolar.matricula' => ['required', 'min:5', 'max:20'],
                'escolar.tipoId' => [
                    'required',
                    'integer',
                    Rule::exists('catalogo_opciones', 'id')
                        ->where('catalogo_id', CatalogoEnum::TIPO_ESCOLAR->value)
                ]
            ]);
        }

        if (isset($this->alumno)) {
            return array_merge($rules, [
                'alumno' => ['required', 'array:grupo,turnoId'],
                'alumno.grupo' => ['required', 'min:5', 'max:15'],
                'alumno.turnoId' => [
                    'required',
                    'integer',
                    Rule::exists('catalogo_opciones', 'id')
                        ->where('catalogo_id', CatalogoEnum::TURNO_ALUMNO->value)
                ]
            ]);
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'id' => 'id',
            'nombreCompleto' => 'Nombre completo',
            'correo' => 'Correo',
            'telefono' => 'Teléfono',
            'fechaNacimiento' => 'Fecha de nacimiento',
            'sexoId' => 'Género',
            'rolId' => 'Rol',
            'tipoId' => 'Tipo usuario',
            'escolar' => 'Escolar',
            'escolar.matricula' => 'Matricula',
            'escolar.tipoId' => 'Tipo',
            'alumno' => 'Alumno',
            'alumno.grupo' => 'Grupo',
            'alumno.turnoId' => 'Turno',
        ];
    }

    public function toData(): UsuarioDto
    {
        return UsuarioDto::from($this->all());
    }
}
