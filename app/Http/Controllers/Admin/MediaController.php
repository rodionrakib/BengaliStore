<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function remove($id)
    {
    	Media::find($id)->delete();
    	return redirect()->back()->with('message','Image delete successful');
    }
}
