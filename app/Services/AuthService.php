<?php

namespace App\Services;

use App\Contracts\Repositories\IUserRepository;
use App\Contracts\Services\IAuthService;
use App\Core\BaseService;
use App\Exceptions\CustomErrorException;
use App\Helpers\Enum\Message;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
    public function login(string $email, string $password): string
    {
        $user = $this->checkAccount($email, $password);
        return $user->createToken($email)->plainTextToken;
    }

    /**
     * @throws CustomErrorException
     */
    private function checkAccount(string $email, string $password): User
    {
        $user = $this->userRepository->findByEmail($email);

        if (!Hash::check($password, $user->password)) {
            throw new CustomErrorException(Message::CREDENTIALS_INVALID, Response::HTTP_BAD_REQUEST);
        }

        if (!$user->isVerified()) {
            throw new CustomErrorException(Message::USER_NOT_VERIFIED, Response::HTTP_BAD_REQUEST);
        }

        return $user;
    }
}
