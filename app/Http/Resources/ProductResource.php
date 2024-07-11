<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Psy\CodeCleaner\AssignThisVariablePass;

class ProductResource extends JsonResource
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
            'category' => $this->category,
            'name' => $this->name,
            'image' => $this->image,
            'slug' => $this->slug,
            'brand' => $this->brand,
            'model' => $this->model,
            'short_desc' => $this->short_desc,
            'desc' => $this->desc,
            'keywords' => $this->keywords,
            'technical_specification' => $this->technical_specification,
            'uses' => $this->uses,
            'lead_time' => $this->lead_time,
            'tax' => $this->tax,
            'is_promo' => $this->is_promo,
            'is_featured' => $this->is_featured,
            'is_tranding' => $this->is_tranding,
            'is_discounted' => $this->is_discounted,
            'status' => $this->status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "product_attrs" => [
                "id" => $this->id,
                "products_id" => $this->products_id,
                "sku" => $this->sku,
                "attr_image" => $this->attr_image,
                "mrp" => $this->mrp,
                "price" => $this->price,
                "qty" => $this->qty,
                "size" => $this->size,
                "color" => $this->color,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,

            ],
            "product_images" => [
                "id" => $this->id,
                "products_id" => $this->products_id,
                "images" => $this->images,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ]

        ];
    }
}
