<?php

namespace App\Http\Resources\Book;

use App\Helpers\Enum\Path;
use App\Helpers\File;
use App\Http\Resources\Author\AuthorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookPortalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => File::getFilePublicPath(Path::BOOK_IMAGES->value, $this->image),
            'status' => $this->status,
            'authors' => AuthorResource::collection($this->authors)
        ];
    }
}
