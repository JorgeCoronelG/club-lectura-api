<?php

namespace App\Services;

use App\Contracts\Repositories\IUserRepository;
use App\Contracts\Services\IAuthService;
use App\Core\BaseService;
use App\Exceptions\CustomErrorException;
use App\Helpers\Enum\Message;
use App\Models\Dto\UserDTO;
use App\Models\Enums\StatusUser;
use App\Models\FormFields\UserFields;
use App\Models\User;
use App\Notifications\Auth\RestorePasswordNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 14/01/2022
 */
class AuthService extends BaseService implements IAuthService
{
    protected IUserRepository $userRepository;

    /**
     * @param IUserRepository $userRepository
     */
    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws CustomErrorException
     */
    public function login(string $email, string $password): User
    {
        $user = $this->checkAccount($email, $password);
        $token = $user->createToken($email)->plainTextToken;
        return $user->setAttribute('token', $token);
    }

    /**
     * @throws CustomErrorException
     * @throws UnknownProperties
     */
    public function restorePassword(string $email): void
    {
        $user = $this->userRepository->findByEmail($email);
        if ($user->status === StatusUser::Inactive->value) {
            throw new CustomErrorException(Message::USER_INACTIVE, Response::HTTP_BAD_REQUEST);
        }
        if (!$user->isVerified()) {
            throw new CustomErrorException(Message::USER_NOT_VERIFIED, Response::HTTP_BAD_REQUEST);
        }

        $newPassword = Str::random(UserFields::RESTORE_PASSWORD_LENGTH);
        $userDTO = new UserDTO(password: bcrypt($newPassword));

        $user = $this->userRepository->update($user->id, $userDTO->only('password')->toArray());
        $user->notify(new RestorePasswordNotification($user, $newPassword));
    }

    /**
     * @throws CustomErrorException
     */
    private function checkAccount(string $email, string $password): User
    {
        try {
            $user = $this->userRepository->findByEmail($email);
        } catch (ModelNotFoundException) {
            throw new CustomErrorException(Message::CREDENTIALS_INVALID, Response::HTTP_BAD_REQUEST);
        }

        if ($user->status === StatusUser::Inactive->value) {
            throw new CustomErrorException(Message::USER_INACTIVE, Response::HTTP_BAD_REQUEST);
        }

        if (!$user->isVerified()) {
            throw new CustomErrorException(Message::USER_NOT_VERIFIED, Response::HTTP_BAD_REQUEST);
        }

        if (!Hash::check($password, $user->password)) {
            throw new CustomErrorException(Message::CREDENTIALS_INVALID, Response::HTTP_BAD_REQUEST);
        }

        return $user;
    }
}
