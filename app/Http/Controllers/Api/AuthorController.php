<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\IAuthorService;
use App\Core\BaseApiController;
use App\Exceptions\CustomErrorException;
use App\Helpers\Enum\Message;
use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Http\Resources\Author\AuthorCollection;
use App\Http\Resources\Author\AuthorResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends BaseApiController
{
    protected IAuthorService $authorService;

    /**
     * @param IAuthorService $authorService
     */
    public function __construct(IAuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index(Request $request): JsonResponse
    {
        $authors = $this->authorService->findAllPaginated($request);
        return $this->showAll(new AuthorCollection($authors, true));
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function store(StoreAuthorRequest $request): JsonResponse
    {
        $authorDTO = $request->toDTO();
        $author = $this->authorService->create($authorDTO);
        return $this->showOne(new AuthorResource($author), Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $author = $this->authorService->findById($id);
        return $this->showOne(new AuthorResource($author));
    }

    /**
     * @throws CustomErrorException
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function update(UpdateAuthorRequest $request, int $id): JsonResponse
    {
        $authorDTO = $request->toDTO();
        if ($id !== $authorDTO->id) {
            throw new CustomErrorException(Message::INVALID_ID_PARAMETER_WITH_ID_BODY, Response::HTTP_BAD_REQUEST);
        }
        $author = $this->authorService->update($id, $authorDTO);
        return $this->showOne(new AuthorResource($author));
    }

    public function destroy(int $id): Response
    {
        $this->authorService->delete($id);
        return $this->noContentResponse();
    }
}
