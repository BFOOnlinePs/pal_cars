<?php

namespace App\Http\Controllers\ApiControllers\shared_controller\shared_controller;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function getAllCities(){
        $cities = Cities::get();

        return response()->json([
            'status' => true,
            'cities' => $cities
        ]);
    }
}
