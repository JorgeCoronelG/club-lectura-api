<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\ILiterarySubgenderService;
use App\Core\BaseApiController;
use App\Exceptions\CustomErrorException;
use App\Helpers\Enum\Message;
use App\Http\Requests\LiterarySubgender\StoreLiterarySubgenderRequest;
use App\Http\Requests\LiterarySubgender\UpdateLiterarySubgenderRequest;
use App\Http\Resources\LiterarySubgender\LiterarySubgenderCollection;
use App\Http\Resources\LiterarySubgender\LiterarySubgenderResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LiterarySubgenderController extends BaseApiController
{
    protected ILiterarySubgenderService $literarySubgenderService;

    /**
     * @param ILiterarySubgenderService $literarySubgenderService
     */
    public function __construct(ILiterarySubgenderService $literarySubgenderService)
    {
        $this->literarySubgenderService = $literarySubgenderService;
    }

    public function index(Request $request): JsonResponse
    {
        $literarySubgenders = $this->literarySubgenderService->findAllPaginated($request);
        return $this->showAll(new LiterarySubgenderCollection($literarySubgenders, true));
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function store(StoreLiterarySubgenderRequest $request): JsonResponse
    {
        $literarySubgenderDTO = $request->toDTO();
        $literarySubgender = $this->literarySubgenderService->create($literarySubgenderDTO);
        return $this->showOne(new LiterarySubgenderResource($literarySubgender), Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $literarySubgender = $this->literarySubgenderService->findById($id);
        return $this->showOne(new LiterarySubgenderResource($literarySubgender));
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     * @throws CustomErrorException
     */
    public function update(UpdateLiterarySubgenderRequest $request, int $id): JsonResponse
    {
        $literarySubgenderDTO = $request->toDTO();
        if ($id !== $literarySubgenderDTO->id) {
            throw new CustomErrorException(Message::INVALID_ID_PARAMETER_WITH_ID_BODY, Response::HTTP_BAD_REQUEST);
        }
        $literarySubgender = $this->literarySubgenderService->update($id, $literarySubgenderDTO);
        return $this->showOne(new LiterarySubgenderResource($literarySubgender));
    }

    public function destroy(int $id): Response
    {
        $this->literarySubgenderService->delete($id);
        return $this->noContentResponse();
    }
}
