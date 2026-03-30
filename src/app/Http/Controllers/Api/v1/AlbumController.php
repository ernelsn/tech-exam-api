<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Todo;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        $albums = Album::with('user')
            ->where('user_id', $request->user()->id)
            ->get();
 
        return ['albums' => $albums];
    }

    public function show(Request $request, Album $album)
    {
        if ($album->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        return response()->json(['post' => $album->load('user')]);
    }
}
