<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
             'price' =>  $this ->price,
            'discount' => $this->discount,
            'totalPrice' => round($this->price - (($this->price)*($this->discount)/100),2),
            'ratings' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2) : 'No reviews Yet!!',
             'href' => [
                'link' => route('products.show',$this->id)
            ]
        ];
    }
}
