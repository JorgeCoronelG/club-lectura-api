<?php

namespace App\Http\Resources\Book;

use App\Helpers\Enum\Path;
use App\Helpers\File;
use App\Http\Resources\Author\AuthorResource;
use App\Http\Resources\LiterarySubgender\LiterarySubgenderResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookPortalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'isbn' => $this->when(!is_null($this->isbn), $this->isbn),
            'title' => $this->title,
            'noPages' => $this->when(!is_null($this->no_pages), $this->no_pages),
            'language' => $this->when(!is_null($this->language), $this->language),
            'review' => $this->when(!is_null($this->review), $this->review),
            'image' => File::getExposedPath(Path::BOOK_IMAGES->value, $this->image),
            'status' => $this->status,
            'authors' => AuthorResource::collection($this->whenLoaded('authors')),
            'allAuthors' => $this->authors->implode('name', ', '),
            'literarySubgender' => LiterarySubgenderResource::make($this->whenLoaded('literarySubgender'))
        ];
    }
}
