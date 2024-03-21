<?php

namespace App\Http\Controllers\ApiControllers\shared_controller\shared_controller;

use App\Http\Controllers\Controller;
use App\Models\ColorsModel;
use Illuminate\Http\Request;

class ColorsController extends Controller
{
    public function getColors()
    {
        $colors = ColorsModel::get();

        return response()->json([
            'status' => true,
            'colors' => $colors
        ]);
    }
}
