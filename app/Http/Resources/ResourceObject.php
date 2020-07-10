<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResourceObject extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => $this->resource->type,
            'id'    => (string) $this->resource->getRouteKey(),
            'attributes' => $this->resource->fields(),
            'links' => [
                'self' => url("/api/v1/{$this->resource->type}/{$this->resource->getRouteKey()}")
            ]
        ];
    }
}
