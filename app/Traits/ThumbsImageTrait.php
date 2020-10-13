<?php 
namespace App\Traits;

use Illuminate\Http\UploadedFile;

/**
 * 
 */
trait ThumbsImageTrait
{
    public function addThumb(UploadedFile $file)
    {
        $this->addMedia($file)->toMediaCollection('thumb');
    }

    
    

    public function getThumbImages()
    {
        if($this->hasMedia('thumb'))
        {
            return $this->getMedia('thumb');

        }
        return [];
    }

    // public function removeThumb()
    // {
    //     $this->clearMediaCollection('thumb');
    // }
    

    
}


