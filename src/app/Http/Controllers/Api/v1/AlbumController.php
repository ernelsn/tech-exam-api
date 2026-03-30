<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Todo;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function __invoke(Request $request)
    {
        $albums = Album::with('user')->get();
 
        return ['albums' => $albums];
    }
}
