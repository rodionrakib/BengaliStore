<?php 

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait AttachmentPdfTrait
{
        
    
    public function addAttachment(UploadedFile $file)
    {
        
        $this->addMedia($file)->toMediaCollection('attachment');
        
    }

    public function attachmentPath()
    {
        if($this->hasMedia('attachment'))
        {
            return $this->getMedia('attachment')->first()->getFullUrl();

        }
    }


    public function getAttachmentFile()
    {
        if($this->hasMedia('attachment'))
        {
            return $this->getMedia('attachment')->first();

        }
    }

    public function removeAttachment()
    {
        $this->clearMediaCollection('attachment');
    }
    
}
