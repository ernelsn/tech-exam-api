<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;

class AlbumPhotoController extends Controller
{
    public function index(Album $album)
    {
        if ($album->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        $albums = $album->photos()->with('user')->get();
        return ['albums' => $albums];
    }

    public function show(Album $album, Photo $photo)
    {
        if ($album->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        return ['photo' => $photo];
    }
}
