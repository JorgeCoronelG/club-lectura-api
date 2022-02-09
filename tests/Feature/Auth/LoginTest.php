<?php

namespace Auth;

use App\Helpers\Enum\Message;
use App\Models\Enums\StatusUser;
use App\Models\FormFields\UserFields;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
    const URL = '/api/v1/auth';

    public function test_login_success(): void
    {
        $response = $this->post(self::URL.'/login', [
            'email' => 'tprog.jorge.coronel@outlook.com',
            'password' => 'Jorge32079.'
        ]);

        $response->assertOk();
        $response->assertJsonStructure(['data' => ['token']]);
    }

    public function test_login_empty_request(): void
    {
        $response = $this->post(self::URL.'/login', [
            'email' => '',
            'password' => ''
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson([
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'error' => [
                'email' => ['El campo Correo electrónico es obligatorio.'],
                'password' => ['El campo Contraseña es obligatorio.']
            ]
        ]);
    }

    public function test_login_validation_email_not_valid(): void
    {
        $response = $this->post(self::URL.'/login', [
            'email' => 'somebody',
            'password' => '12345678'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson([
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'error' => [
                'email' => ['Correo electrónico no es un correo válido.']
            ]
       ]);
    }

    public function test_login_validation_password_min_invalid(): void
    {
        $response = $this->post(self::URL.'/login', [
            'email' => 'somebody@gmail.com',
            'password' => '1'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson([
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'error' => [
                'password' => ['Contraseña debe contener al menos '.UserFields::PASSWORD_MIN_LENGTH.' caracteres.']
            ]
        ]);
    }

    public function test_login_validation_email_password_max_invalid(): void
    {
        $response = $this->post(self::URL.'/login', [
            'email' => 'tprog.jorge.coronel.1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890@outlook.com',
            'password' => '123456789012345678901234567890123456789012345678901234567890'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson([
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'error' => [
                'email' => ['Correo electrónico no debe ser mayor que '.UserFields::EMAIL_MAX_LENGTH.' caracteres.'],
                'password' => ['Contraseña no debe ser mayor que '.UserFields::PASSWORD_MAX_LENGTH.' caracteres.']
            ]
        ]);
    }

    public function test_login_email_not_exist(): void
    {
        $response = $this->post(self::URL.'/login', [
            'email' => 'jorgecg@gmail.com',
            'password' => '12345678'
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJson([
            'code' => Response::HTTP_BAD_REQUEST,
            'error' => Message::CREDENTIALS_INVALID
        ]);
    }

    public function test_login_password_invalid(): void
    {
        $response = $this->post(self::URL.'/login', [
            'email' => 'tprog.jorge.coronel@outlook.com',
            'password' => '12345678'
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJson([
            'code' => Response::HTTP_BAD_REQUEST,
            'error' => Message::CREDENTIALS_INVALID
        ]);
    }

    public function test_login_user_not_verified(): void
    {
        $user = User::where('verified', false)
            ->where('status', StatusUser::Active->value)
            ->firstOrFail();

        $response = $this->post(self::URL.'/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJson([
            'code' => Response::HTTP_BAD_REQUEST,
            'error' => Message::USER_NOT_VERIFIED
        ]);
    }

    public function test_login_user_inactive(): void {
        $user = User::where('verified', true)
            ->where('status', StatusUser::Active->value)
            ->inRandomOrder()
            ->first();

        $user->status = StatusUser::Inactive->value;
        $user->save();

        $response = $this->post(self::URL.'/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $user->status = StatusUser::Active->value;
        $user->save();

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJson([
            'code' => Response::HTTP_BAD_REQUEST,
            'error' => Message::USER_INACTIVE
        ]);
    }
}
