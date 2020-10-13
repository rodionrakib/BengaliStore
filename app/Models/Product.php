<?php

namespace App\Models;

use App\Models\ProductCategory;
use App\Models\Size;
use App\Traits\CoverImageTrait;
use App\Traits\ThumbsImageTrait;
use Gloudemans\Shoppingcart\CanBeBought;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia,Buyable
{
    use InteractsWithMedia,CanBeBought,CoverImageTrait,ThumbsImageTrait;


    protected $guarded=[];


    public function  categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    // public function getRouteKeyName()
    // {
    //     return "slug";
    // }
    public function path()
    {
        return '/products/'.$this->slug;
    }


    public function scopeFeatured($query)
    {
        return $query->where('status',1)->where('featured',true);
    }

    public function scopeVisible($query)
    {
        return $query->where('status',1);
    }

    
    // public function addFeatureImage(UploadedFile $file)
    // {
        
    //     $this->addMedia($file)->toMediaCollection('feature_image');
        
    // }

    // public function featureImagePath()
    // {
    //     if($this->hasMedia('feature_image'))
    //     {
    //         return $this->getMedia('feature_image')->first()->getFullUrl();

    //     }

    //     // return public_path('assets/images/products/product-1.jpg');
    // }


    public function getFearuteImage()
    {
        if($this->hasMedia('feature_image'))
        {
            return $this->getMedia('feature_image')->first();

        }
    }

    public function removeFeature()
    {
        $this->clearMediaCollection('feature_image');
    }
    
    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }


    public function getBuyableIdentifier($options = null){
        return $this->id;
    }
    public function getBuyableDescription($options = null){
        return $this->title;
    }
    public function getBuyablePrice($options = null){
        return $this->price;
    }
    public function getBuyableWeight($options = null){
        return 0;
    }    
}