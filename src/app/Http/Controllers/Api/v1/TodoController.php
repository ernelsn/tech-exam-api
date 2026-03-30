<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __invoke(Request $request)
    {
        $todos = Todo::with('user')
            ->where('user_id', $request->user()->id)
            ->get();
 
        return ['todos' => $todos];
    }
}
