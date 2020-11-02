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

    public function popularProducts($limit)
    {
        return $this->products->sortByDesc('view_count')->take($limit);
    }


    public function getBreadcrumb()
    {
        $html = "";
        $this->ancestors->each(function($node) use (&$html){
            $html .= "<li class=\"breadcrumb-item\"><a href=\"{$node->path()}\">{$node->name}</a></li>";
        });
        $html .= "<li class=\"breadcrumb-item\"><a href=\"{$this->path()}\">{$this->name}</a></li>";
        return $html;
    }

    public function path()
    {

        $path = "/categories/";
        $this->ancestors->each(function($node) use (&$path){
            $path .= $node->slug."/";
        });
        return $path.$this->slug;
    }
}
