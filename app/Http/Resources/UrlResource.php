<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UrlResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return  [
            "destination"=> $this->destination,
            "slug" =>  $this->slug,
            "updated_at" =>  $this->updated_at,
            "created_at"=>  $this->created_at,
            "id" =>  $this->id,
            "shortened_url" =>  $this->shortened_url
       ];
    }
}
