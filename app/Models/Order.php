<?php

namespace App\Models;

use App\Models\CustomerAddress;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Order extends Model
{
    protected $guarded = [];

    public function addProducts(Collection $products)
    {
    	$ids = $products->pluck('id')->toArray();
    	$this->products()->attach($ids);
    }
    public function products()
    {
    	return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function addProduct(Product $product)
    {
        $this->products()->attach([$product->id]);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(CustomerAddress::class);
    }

    // public function slippingAddress()
    // {
    //     return $this->hasOne(CustomerAddress::class);
    // }
}
