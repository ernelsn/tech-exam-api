<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __invoke(Request $request)
    {
        $users = User::with(['address', 'company'])
            ->where('id', $request->user()->id)
            ->get();
 
        return UserResource::collection($users);
    }
}