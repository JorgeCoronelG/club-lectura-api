<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\IUserService;
use App\Core\BaseApiController;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends BaseApiController
{
    protected IUserService $userService;

    /**
     * @param IUserService $userService
     */
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request): JsonResponse
    {
        $users = $this->userService->findAllPaginated($request);
        return $this->showAll(new UserCollection($users, true));
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $userDTO = $request->toDTO();
        $user = $this->userService->create($userDTO);
        return $this->showOne(new UserResource($user));
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->userService->findById($id);
        return $this->showOne(new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(int $id): Response
    {
        $this->userService->delete($id);
        return $this->noContentResponse();
    }
}
