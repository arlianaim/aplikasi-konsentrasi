<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoardingHouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'gender_restriction' => $this->type,
            'curfew' => $this->curfew,
            'rules' => $this->rules,
            'address' => $this->address,
            'location' => [$this->latitude, $this->longitude], // Geopoint location
            'rooms' => RoomResource::collection($this->whenLoaded('rooms')), // Load all rooms
            'facilities' => FacilityHouseResource::collection($this->whenLoaded('facilities')), // Load all facilities
            'description' => $this->description,
            'image' => ImageResource::collection($this->whenLoaded('image')),
        ];
    }
}
