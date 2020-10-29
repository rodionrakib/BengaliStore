<?php

namespace App\Models;

use App\Models\Product;
use App\Traits\CoverImageTrait;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProductCategory extends Model implements HasMedia
{
	use NodeTrait,InteractsWithMedia,CoverImageTrait;
    protected $guarded = [];

    public function products()
    {
    	return $this->belongsToMany(Product::class);
    }

    public function scopeVisible($query)
    {
        return $query->where('status',1);
    }

}
