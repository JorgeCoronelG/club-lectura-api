<?php

namespace App\Http\Requests\User;

use App\Helpers\Enum\Gender;
use App\Helpers\Validation;
use App\Http\Requests\Contracts\IReturnDto;
use App\Models\Dto\AcademicDTO;
use App\Models\Dto\ExternalDTO;
use App\Models\Dto\RoleDTO;
use App\Models\Dto\StudentDTO;
use App\Models\Dto\UserDTO;
use App\Models\Enums\TurnStudent;
use App\Models\Enums\TypeAcademic;
use App\Models\Enums\TypeUser;
use App\Models\FormFields\AcademicFields;
use App\Models\FormFields\StudentFields;
use App\Models\FormFields\UserFields;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest implements IReturnDto
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
        $validationArray = [
            'completeName' => ['required', 'min:'.UserFields::COMPLETE_NAME_MIN_LENGTH, 'max:'.UserFields::COMPLETE_NAME_MAX_LENGTH],
            'email' => ['required', 'email:dns', 'max:'.UserFields::EMAIL_MAX_LENGTH, 'unique:users'],
            'phone' => ['required', 'min:'.UserFields::PHONE_LENGTH, 'max:'.UserFields::PHONE_LENGTH, 'regex:'.Validation::PHONE_REGEX],
            'birthday' => ['required', 'before:now'],
            'gender' => ['required', Rule::in(Gender::getAllGenders())],
            'roles' => ['required', 'array'],
            'roles.*.id' => ['required', 'integer', 'distinct'],
            'type' => ['bail', 'required', Rule::in(TypeUser::getAllTypes())]
        ];

        if ($this->type === TypeUser::Student->value) {
            return array_merge($validationArray, [
                'student.group' => ['required', 'min:'.StudentFields::GROUP_MIN_LENGTH, 'max:'.StudentFields::GROUP_MAX_LENGTH],
                'student.turn' => ['required', Rule::in(TurnStudent::getAllTurns())]
            ]);
        }

        if ($this->type === TypeUser::Academic->value) {
            return array_merge($validationArray, [
                'academic.registration' => ['required', 'min:'.AcademicFields::REGISTRATION_MIN_LENGTH,
                    'max:'.AcademicFields::REGISTRATION_MAX_LENGTH],
                'academic.type' => ['required', Rule::in(TypeAcademic::getAllTypes())]
            ]);
        }

        return $validationArray;
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function toDTO(): UserDTO
    {
        $roles = array();
        foreach ($this->roles as $role) {
            $roles[] = new RoleDTO(id: $role['id']);
        }

        $student = null;
        if ($this->type === TypeUser::Student->value) {
            $student = new StudentDTO(group: $this->student['group'], turn: $this->student['turn']);
        }

        $academic = null;
        if ($this->type === TypeUser::Academic->value) {
            $academic = new AcademicDTO(registration: $this->academic['registration'], type: $this->academic['type']);
        }

        $external = null;
        if ($this->type === TypeUser::External->value) {
            $external = new ExternalDTO();
        }

        return new UserDTO(
            completeName: $this->completeName,
            email: $this->email,
            phone: $this->phone,
            birthday: Carbon::make($this->birthday),
            gender: $this->gender,
            roles: $roles,
            type: $this->type,
            studentDTO: $student,
            academicDTO: $academic,
            externalDTO: $external
        );
    }
}
