<?php

namespace App\Http\Requests\Donation;

use App\Core\Contracts\ReturnDataInterface;
use App\Exceptions\CustomErrorException;
use App\Models\Dto\AlumnoDto;
use App\Models\Dto\AutorDto;
use App\Models\Dto\DonacionUsuarioDto;
use App\Models\Dto\EscolarDto;
use App\Models\Dto\LibroDto;
use App\Models\Dto\UsuarioDto;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\TipoUsuarioEnum;
use App\Models\Libro;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class StoreDonationRequest extends FormRequest implements ReturnDataInterface
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
        $rulesUsuariosExistentes = [
            'usuariosExistentes' => ['nullable', 'array'],
            'usuariosExistentes.*.id' => ['required', 'integer', 'exists:usuarios,id'],
            'usuariosExistentes.*.donacion.referencia' => ['required', 'string', 'max:500']
        ];
        $rulesUsuariosNuevos = [
            'usuariosNuevos' => ['nullable', 'array'],
            'usuariosNuevos.*.nombreCompleto' => ['required', 'min:5', 'max:150'],
            'usuariosNuevos.*.correo' => [
                'required',
                'email:dns',
                'max:150',
                Rule::unique('usuarios', 'correo')
            ],
            'usuariosNuevos.*.telefono' => ['required', 'min:10', 'max:10'],
            'usuariosNuevos.*.fechaNacimiento' => ['required', 'date', 'date_format:Y-m-d', 'before:now'],
            'usuariosNuevos.*.sexoId' => [
                'required',
                'integer',
                Rule::exists('catalogo_opciones', 'id')
                    ->where('catalogo_id', CatalogoEnum::SEXO->value)
            ],
            'usuariosNuevos.*.rolId' => [
                'required',
                'integer',
                Rule::exists('roles', 'id')
            ],
            'usuariosNuevos.*.tipoId' => [
                'required',
                'integer',
                Rule::exists('catalogo_opciones', 'opcion_id')
                    ->where('catalogo_id', CatalogoEnum::TIPO_USUARIO->value)
            ],
            'usuariosNuevos.*.donacion.referencia' => ['required', 'string', 'max:500'],

            // Validaciones cuando es de tipo escolar
            'usuariosNuevos.*.escolar' => [
                'required_if:usuariosNuevos.*.tipoId,'.TipoUsuarioEnum::ESCOLAR->value,
                'array:matricula,tipoId'
            ],
            'usuariosNuevos.*.escolar.matricula' => [
                'required_if:usuariosNuevos.*.tipoId,'.TipoUsuarioEnum::ESCOLAR->value,
                'min:5',
                'max:20'
            ],
            'usuariosNuevos.*.escolar.tipoId' => [
                'required_if:usuariosNuevos.*.tipoId,'.TipoUsuarioEnum::ESCOLAR->value,
                'integer',
                Rule::exists('catalogo_opciones', 'id')
                    ->where('catalogo_id', CatalogoEnum::TIPO_ESCOLAR->value)
            ],
            // Validaciones cuando es de tipo alumno
            'usuariosNuevos.*.alumno' => [
                'required_if:usuariosNuevos.*.tipoId,'.TipoUsuarioEnum::ALUMNO->value,
                'array:semestre,carreraId,turnoId'
            ],
            'usuariosNuevos.*.alumno.semestre' => [
                'required_if:usuariosNuevos.*.tipoId,'.TipoUsuarioEnum::ALUMNO->value,
                'min:1',
                'max:6'
            ],
            'usuariosNuevos.*.alumno.carreraId' => [
                'required_if:usuariosNuevos.*.tipoId,'.TipoUsuarioEnum::ALUMNO->value,
                'integer',
                Rule::exists('catalogo_opciones', 'id')
                    ->where('catalogo_id', CatalogoEnum::CARRERAS_EDUCATIVAS->value)
            ],
            'usuariosNuevos.*.alumno.turnoId' => [
                'required_if:usuariosNuevos.*.tipoId,'.TipoUsuarioEnum::ALUMNO->value,
                'integer',
                Rule::exists('catalogo_opciones', 'id')
                    ->where('catalogo_id', CatalogoEnum::TURNO_ALUMNO->value)
            ]
        ];
        $rulesLibros = [
            'libros' => ['required', 'array'],
            'libros.*.isbn' => ['required', 'min:10', 'max:15'],
            'libros.*.titulo' => ['required', 'min:2', 'max:150'],
            'libros.*.resenia' => ['nullable', 'max:65000'],
            'libros.*.numPaginas' => ['required', 'integer', 'min:1', 'max:5000'],
            'libros.*.precio' => ['required', 'numeric', 'min:1', 'max:5000', 'decimal:0,2'],
            'libros.*.edicion' => ['required', 'integer', 'min:1', 'max:127'],
            'libros.*.numCopia' => ['required', 'integer', 'min:1', 'max:127'],
            'libros.*.estadoFisicoId' => [
                'required',
                'integer',
                Rule::exists('catalogo_opciones', 'id')
                    ->where('catalogo_id', CatalogoEnum::ESTADO_FISICO_LIBRO->value)
            ],
            'libros.*.idiomaId' => [
                'required',
                'integer',
                Rule::exists('catalogo_opciones', 'id')
                    ->where('catalogo_id', CatalogoEnum::IDIOMA->value)
            ],
            'libros.*.estatusId' => [
                'required',
                'integer',
                Rule::exists('catalogo_opciones', 'id')
                    ->where('catalogo_id', CatalogoEnum::ESTATUS_LIBRO->value)
            ],
            'libros.*.generoId' => [
                'required',
                'integer',
                Rule::exists('generos', 'id')
            ],
            'libros.*.autores' => ['required', 'array'],
            'libros.*.autores.*.id' => [
                'required',
                'integer',
                Rule::exists('autores', 'id')
            ]
        ];

        return array_merge(
            $rulesUsuariosNuevos, $rulesUsuariosExistentes, $rulesLibros
        );
    }

    public function attributes(): array
    {
        return [
            'usuariosExistentes' => 'Listado de usuarios existentes',
            'usuariosExistentes.*.id' => 'Identificador del usuario #:position',
            'usuariosExistentes.*.donacion.referencia' => 'Referencia de donación del usuario existente #:position',

            'usuariosNuevos' => 'Listado de nuevos usuarios',
            'usuariosNuevos.*.nombreCompleto' => 'Nombre completo del nuevo usuario #:position',
            'usuariosNuevos.*.correo' => 'Correo electrónico del nuevo usuario #:position',
            'usuariosNuevos.*.telefono' => 'Teléfono del nuevo usuario #:position',
            'usuariosNuevos.*.fechaNacimiento' => 'Fecha de nacimiento del nuevo usuario #:position',
            'usuariosNuevos.*.sexoId' => 'Sexo del nuevo usuario #:position',
            'usuariosNuevos.*.rolId' => 'Rol del nuevo usuario #:position',
            'usuariosNuevos.*.tipoId' => 'Tipo del nuevo usuario #:position',
            'usuariosNuevos.*.donacion.referencia' => 'Referencia de donación del nuevo usuario #:position',

            'usuariosNuevos.*.escolar' => 'Información escolar del nuevo usuario #:position',
            'usuariosNuevos.*.escolar.matricula' => 'Matrícula del nuevo usuario #:position',
            'usuariosNuevos.*.escolar.tipoId' => 'Tipo escolar del nuevo usuario #:position',

            'usuariosNuevos.*.alumno' => 'Información alumno del nuevo usuario #:position',
            'usuariosNuevos.*.alumno.semestre' => 'Semestre del nuevo usuario #:position',
            'usuariosNuevos.*.alumno.carreraId' => 'Carrera del nuevo usuario #:position',
            'usuariosNuevos.*.alumno.turnoId' => 'Turno del nuevo usuario #:position',

            'libros' => 'Listado de libros',
            'libros.*.isbn' => 'ISBN del libro #:position',
            'libros.*.titulo' => 'Título del libro #:position',
            'libros.*.resenia' => 'Reseña del libro #:position',
            'libros.*.numPaginas' => 'Número de páginas del libro #:position',
            'libros.*.precio' => 'Precio del libro #:position',
            'libros.*.edicion' => 'Edición del libro #:position',
            'libros.*.numCopia' => 'Número de copia del libro #:position',
            'libros.*.estadoFisicoId' => 'Estado físico del libro #:position',
            'libros.*.idiomaId' => 'Idioma del libro #:position',
            'libros.*.estatusId' => 'Estatus del libro #:position',
            'libros.*.generoId' => 'Genero del libro #:position',
            'libros.*.autores' => 'Autores del libro #:position',
            'libros.*.autores.*.id' => 'Identificador del autor del libro #:position',
        ];
    }

    /**
     * @throws CustomErrorException
     */
    public function toData(): StoreDonationDto
    {
        if (!$this->existSomeUsers()) {
            throw new CustomErrorException(
                'Debe de existir al menos un registro de un usuario existente o nuevo',
                Response::HTTP_BAD_REQUEST
            );
        }

        // Usuarios existentes
        $usersExistentes = [];
        foreach ($this->usuariosExistentes as $usuarioExistente) {
            $donation = DonacionUsuarioDto::from([
                'referencia' => $usuarioExistente['donacion']['referencia']
            ]);
            $usersExistentes[] = UsuarioDto::from([
                'id' => $usuarioExistente['id'],
                'donacionUsuario' => $donation,
            ]);
        }

        // Usuarios nuevos
        $usersNuevos = [];
        foreach ($this->usuariosNuevos as $usuarioNuevo) {
            $donation = DonacionUsuarioDto::from([
                'referencia' => $usuarioExistente['donacion']['referencia']
            ]);
            $user = UsuarioDto::from(array_merge($usuarioNuevo, ['donacionUsuario' => $donation]));

            if ($usuarioNuevo['tipoId'] === TipoUsuarioEnum::ESCOLAR->value) {
                $user->escolar = EscolarDto::from($usuarioNuevo['escolar']);
            } else if ($usuarioNuevo['tipoId'] === TipoUsuarioEnum::ALUMNO->value) {
                $user->alumno = AlumnoDto::from($usuarioNuevo['alumno']);
            }

            $usersNuevos[] = $user;
        }

        // Libro
        $books = [];
        foreach ($this->libros as $book) {
            $autores = [];
            foreach ($book['autores'] as $autor) $autores[] = AutorDto::from($autor);

            $books[] = LibroDto::from(array_merge($book, [
                'autores' => $autores,
                'imagen' => Libro::IMAGE_DEFAULT,
            ]));
        }

        return StoreDonationDto::from([
            'usersDB' => $usersExistentes,
            'newUsers' => $usersNuevos,
            'books' => $books
        ]);
    }

    private function existSomeUsers(): bool
    {
        return (isset($this->usuariosExistentes) && count($this->usuariosExistentes) > 0) ||
            (isset($this->usuariosNuevos) && count($this->usuariosNuevos) > 0);
    }
}
