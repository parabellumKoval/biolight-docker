<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
	        'id' => $this->id,
	        'name' => $this->title,
	        'slug' => $this->slug,
	        'image' => url($this->image),
	        'content' => $this->content,
	        'desc' => mb_substr(strip_tags($this->content),0, 110) . '...',
	        'seo' => $this->seo? json_decode($this->seo): null
        ];
    }
}
