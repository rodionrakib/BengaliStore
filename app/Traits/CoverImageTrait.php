<?php 

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait CoverImageTrait
{
        
    
    public function addCover(UploadedFile $file)
    {
        
        $this->addMedia($file)->toMediaCollection('cover');
        
    }

    public function coverImagePath()
    {
        if($this->hasMedia('cover'))
        {
            return $this->getMedia('cover')->first()->getFullUrl();

        }
    }


    public function getCoverImage()
    {
        if($this->hasMedia('cover'))
        {
            return $this->getMedia('cover')->first();

        }
    }

    public function removeCover()
    {
        $this->clearMediaCollection('cover');
    }
    
}
