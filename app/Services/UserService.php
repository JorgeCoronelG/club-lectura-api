<?php

namespace App\Services;

use App\Contracts\Repositories\IAcademicRepository;
use App\Contracts\Repositories\IExternalRepository;
use App\Contracts\Repositories\IStudentRepository;
use App\Contracts\Repositories\IUserRepository;
use App\Contracts\Services\IUserService;
use App\Core\BaseService;
use App\Core\Contracts\IBaseRepository;
use App\Models\Dto\UserDTO;
use App\Models\Enums\StatusUser;
use App\Models\Enums\TypeUser;
use App\Models\FormFields\UserFields;
use App\Models\User;
use App\Notifications\User\UserCreatedNotification;
use Spatie\DataTransferObject\DataTransferObject;

class UserService extends BaseService implements IUserService
{
    protected IBaseRepository $entityRepository;
    protected IStudentRepository $studentRepository;
    protected IAcademicRepository $academicRepository;
    protected IExternalRepository $externalRepository;

    public function __construct(IUserRepository $userRepository, IStudentRepository $studentRepository,
        IAcademicRepository $academicRepository, IExternalRepository $externalRepository)
    {
        $this->entityRepository = $userRepository;
        $this->studentRepository = $studentRepository;
        $this->academicRepository = $academicRepository;
        $this->externalRepository = $externalRepository;
    }

    public function create(UserDTO|DataTransferObject $dto): User
    {
        $dto->password = bcrypt('password');
        $dto->photo = UserFields::PHOTO_DEFAULT;
        $dto->verificationToken = User::generateVerificationToken();
        $dto->status = StatusUser::Active->value;

        $roles = array();
        foreach ($dto->roles as $role) {
            $roles[] = $role->id;
        }

        $user = $this->entityRepository->create(
            $dto
                ->only('email', 'complete_name', 'photo', 'phone', 'birthday', 'gender', 'password', 'status', 'verification_token')
                ->toArray()
        );

        $dto->code = UserFields::CODE_INITIAL.$user->id;
        $user = $this->entityRepository->update($user->id, $dto->only('code')->toArray());

        $this->entityRepository->sync($user->id, 'roles', $roles);

        // Registrar en caso de que aplique en students, academics o externals
        if ($dto->type === TypeUser::Student->value) {
            $dto->studentDTO->userId = $user->id;
            $student = $this->studentRepository->create($dto->studentDTO->toArray());
            $user->student = $student;
        } else if ($dto->type === TypeUser::Academic->value) {
            $dto->academicDTO->userId = $user->id;
            $academic = $this->academicRepository->create($dto->academicDTO->toArray());
            $user->academic = $academic;
        } else if ($dto->type === TypeUser::External->value) {
            $dto->externalDTO->userId = $user->id;
            $external = $this->externalRepository->create($dto->externalDTO->toArray());
            $user->external = $external;
        }

        $user->notify(new UserCreatedNotification($user));

        return $user;
    }
}
