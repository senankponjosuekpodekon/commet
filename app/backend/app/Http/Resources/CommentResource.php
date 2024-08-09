<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'parent_id' => $this->parent_id,
            'post_id' =>$this ->post_id,
            'post' => $this->post,
            'content' =>$this ->content,
            'createdAt' =>$this ->created_at,
            'children' => $this->children
        ];
    }
}
