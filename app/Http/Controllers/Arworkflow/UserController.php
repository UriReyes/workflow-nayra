<?php

namespace App\Http\Controllers\Arworkflow;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = User::select('id', 'name')->get();
        $usersList = [];
        foreach ($users as $user) {
            array_push($usersList, ['value' => $user->id, 'content' => $user->name]);
        }
        return response()->json(['users' => $usersList], 200);
    }
}
