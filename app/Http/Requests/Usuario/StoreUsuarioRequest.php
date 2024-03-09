<?php

namespace App\Http\Requests\Usuario;

use App\Core\Contracts\ReturnDataInterface;
use App\Models\Dto\UsuarioDto;
use App\Models\Enum\CatalogoEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUsuarioRequest extends FormRequest implements ReturnDataInterface
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
            'nombreCompleto' => ['required', 'min:5', 'max:150'],
            'correo' => [
                'required',
                'email:dns',
                'max:150',
                Rule::unique('usuarios', 'correo')
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
                Rule::exists('catalogo_opciones', 'opcion_id')
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
                'alumno' => ['required', 'array:semestre,carreraId,turnoId'],
                'alumno.semestre' => ['required', 'min:1', 'max:6'],
                'alumno.carreraId' => [
                    'required',
                    'integer',
                    Rule::exists('catalogo_opciones', 'id')
                        ->where('catalogo_id', CatalogoEnum::CARRERAS_EDUCATIVAS->value)
                ],
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
            'alumno.semestre' => 'Semestre',
            'alumno.carreraId' => 'Carrera',
            'alumno.turnoId' => 'Turno',
        ];
    }

    public function toData(): UsuarioDto
    {
        return UsuarioDto::from($this->all());
    }
}
