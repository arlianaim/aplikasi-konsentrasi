<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Event\Telemetry\StopWatch;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $id = $this->id;
        // $exists = file_exists(Storage::url($this->url));
        // foreach (['jpg', 'jpeg', 'png'] as $extension) {
        //     if (file_exists(public_path("storage/images/house/$id.$extension"))) {
        //         $exists = true;
        //         break;
        //     }
        // }
        // if (!$exists) {
        //     return [
        //         'id' => $this->id,
        //         'name' => $this->name,
        //         'url' => null,
        //         'test' => Storage::url($this->url),
        //     ];
        // }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'url' => "https://055e-140-213-1-49.ngrok-free.app". Storage::url($this->url),
            // 'url' => asset('storage/images/house/' . $this->id . '.jpg'),
        ];
    }
}
