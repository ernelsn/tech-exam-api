<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Photo;
use App\Models\Todo;
use Illuminate\Http\Request;

class AlbumPhotoController extends Controller
{
    public function index(Album $album)
    {
        $photos = $album->photos()->with('user')->get();

        return ['photos' => $photos];
    }

    public function show(Album $Album, Photo $photo)
    {
        return ['photo' => $photo->load('user')];
    }
}
