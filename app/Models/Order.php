<?php

namespace App\Models;

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
    	return $this->belongsToMany(Product::class);
    }
}
