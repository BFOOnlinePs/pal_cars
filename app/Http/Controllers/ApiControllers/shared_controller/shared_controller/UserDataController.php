<?php

namespace App\Http\Controllers\ApiControllers\shared_controller\shared_controller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    public function getUserInfo($id)
    {
        // return $id;
        $user = User::find($id);

        if ($user) {
            return response()->json([
                'status' => true,
                'user' => $user
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'المستخدم غير موجود'
            ]);
        }
    }
}
