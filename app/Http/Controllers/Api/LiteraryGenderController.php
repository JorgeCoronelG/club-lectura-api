<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\ILiteraryGenderService;
use App\Core\BaseApiController;
use App\Exceptions\CustomErrorException;
use App\Helpers\Enum\Message;
use App\Http\Requests\LiteraryGender\StoreLiteraryGenderRequest;
use App\Http\Requests\LiteraryGender\UpdateLiteraryGenderRequest;
use App\Http\Resources\LiteraryGender\LiteraryGenderCollection;
use App\Http\Resources\LiteraryGender\LiteraryGenderResource;
use App\Models\FormFields\RoleFields;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LiteraryGenderController extends BaseApiController
{
    protected ILiteraryGenderService $literaryGenderService;

    /**
     * @param ILiteraryGenderService $literaryGenderService
     */
    public function __construct(ILiteraryGenderService $literaryGenderService)
    {
        $this->middleware('permission:'.implode(',', [RoleFields::Admin->value, RoleFields::Capturist->value]))
            ->only('store', 'update', 'destroy');
        $this->literaryGenderService = $literaryGenderService;
    }

    public function findAll(): JsonResponse
    {
        $literaryGenders = $this->literaryGenderService->findAll();
        return $this->showAll(new LiteraryGenderCollection($literaryGenders));
    }

    public function index(Request $request): JsonResponse
    {
        $literaryGenders = $this->literaryGenderService->findAllPaginated($request);
        return $this->showAll(new LiteraryGenderCollection($literaryGenders, true));
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function store(StoreLiteraryGenderRequest $request): JsonResponse
    {
        $literaryGenderDTO = $request->toDTO();
        $literaryGender = $this->literaryGenderService->create($literaryGenderDTO);
        return $this->showOne(new LiteraryGenderResource($literaryGender), Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $literaryGender = $this->literaryGenderService->findById($id);
        return $this->showOne(new LiteraryGenderResource($literaryGender));
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws CustomErrorException
     */
    public function update(UpdateLiteraryGenderRequest $request, int $id): JsonResponse
    {
        $literaryGenderDTO = $request->toDTO();
        if ($id !== $literaryGenderDTO->id) {
            throw new CustomErrorException(Message::INVALID_ID_PARAMETER_WITH_ID_BODY, Response::HTTP_BAD_REQUEST);
        }
        $literaryGender = $this->literaryGenderService->update($id, $literaryGenderDTO);
        return $this->showOne(new LiteraryGenderResource($literaryGender));
    }

    public function destroy(int $id): Response
    {
        $this->literaryGenderService->delete($id);
        return $this->noContentResponse();
    }
}
