<?php

namespace App\Http\Resources\Product;

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
        return [

            'name' => $this->name,
            'description' => $this->detail,
            'stock' => $this->stock>0 ? $this->stock : 'Out of stock',
            'price' =>  $this ->price,
            'discount' => $this->discount,
            'totalPrice' => round($this->price - (($this->price)*($this->discount)/100),2),
            'ratings' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2) : 'No reviews Yet!!',
            'href' => [
            'reviews' => route('review.index',$this->id)
            ]
        ];
    }
}
