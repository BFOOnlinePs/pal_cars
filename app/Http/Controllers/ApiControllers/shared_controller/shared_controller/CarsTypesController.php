<?php

namespace App\Http\Controllers\ApiControllers\shared_controller\shared_controller;

use App\Http\Controllers\Controller;
use App\Models\CarsType;
use Illuminate\Http\Request;

class CarsTypesController extends Controller
{
    public function getCarsTypes()
    {
        $cars_types = CarsType::orderBy('car_type', 'asc')
            ->get(['id', 'car_type', 'logo']);

        return response()->json([
            'status' => true,
            'cars_types' => $cars_types,
        ]);
    }
}
