<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'user' => $this->user,
            'comments' => $this->comments,
            'title' => $this->title,
            'link' => $this->link,
            'tags' => $this->tags,
            'content' => $this->content,
            'createdAt' => $this->created_at
        ];
    }
}
