<?php

namespace App\Http\Controllers\ApiControllers\shared_controller\car_models_controller;

use App\Http\Controllers\Controller;
use App\Models\CarModels;
use Illuminate\Http\Request;

class CarModelsController extends Controller
{
    // car id as query param
    public function getCarModelsByCarId(Request $request)
    {
        $car_models = CarModels::where('car_id', $request->input('car_id'))
            ->where('status', 1)
            ->get();

        return response()->json([
            'status' => 'true',
            'car_models' => $car_models,
        ]);
    }
}
