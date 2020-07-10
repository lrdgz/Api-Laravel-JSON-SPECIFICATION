<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection as BaseResourceCollection;

class ResourceCollection extends BaseResourceCollection
{

    public $collects = ResourceObject::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
//            'data' => ArticleResource::collection( $this->collection ),
            'data' =>  $this->collection
        ];
    }
}
