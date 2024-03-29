<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmotionResource extends JsonResource
{
   /**
 * Transform the resource into an array.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return array<string, mixed>
 */
public function toArray($request): array
{
    return [
        'id' => $this->id,
        'type' => $this->type,
        'name' => $this->name,
        'user_id' => $this->user_id,
        'description' => $this->description,
        'image' => $this->image,
        'date' => $this->date,  
        'created_at' => $this->created_at ? $this->created_at->format('d/m/Y') : null,
        'updated_at' => $this->updated_at ? $this->updated_at->format('d/m/Y') : null,
    ];
}


}
