<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'type'=>'products',
            'id' => (string) $this->id,
            'attribute'=>[
                'name' => $this->name,
                'price' => $this->price,
                'category' => $this->category,
                'created_at' => $this->created_at->format('M d Y'),
                'updated_at' => $this->updated_at->format('M d Y'),
            ],
           
        ];
    }
}
