<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\AutorServiceInterface;
use App\Core\BaseApiController;
use App\Exceptions\CustomErrorException;
use App\Helpers\Enum\Message;
use App\Http\Requests\Autor\UpdateAutorRequest;
use App\Http\Requests\Autor\StoreAutorRequest;
use App\Http\Resources\Autor\AutorCollection;
use App\Http\Resources\Autor\AutorResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpCodes;

class AutorController extends BaseApiController
{
    private AutorServiceInterface $autorService;

    public function __construct(AutorServiceInterface $autorService)
    {
        $this->autorService = $autorService;
    }

    public function index(Request $request): JsonResponse
    {

        $autores = $this->autorService->findAllPaginated($request);
        return $this->showAll(new AutorCollection($autores, true));
    }

    public function store(StoreAutorRequest $request): JsonResponse
    {
        $autor = $this->autorService->create($request->toData());
        return $this->showOne(AutorResource::make($autor));
    }

    public function show(int $id): JsonResponse
    {
        $autor = $this->autorService->findById($id);
        return $this->showOne(AutorResource::make($autor));
    }

    /**
     * @throws CustomErrorException
     */
    public function update(UpdateAutorRequest $request, int $id): JsonResponse
    {
        $autorData = $request->toData();
        if ($id !== $autorData->id) {
            throw new CustomErrorException(Message::INVALID_ID_PARAMETER_WITH_ID_BODY, HttpCodes::HTTP_BAD_REQUEST);
        }

        $autor = $this->autorService->update($id, $autorData);
        return $this->showOne(AutorResource::make($autor));
    }

    public function destroy(int $id): Response
    {
        $this->autorService->delete($id);
        return $this->noContentResponse();
    }
}
