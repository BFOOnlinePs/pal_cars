<?php

namespace App\Http\Controllers\ApiControllers\shared_controller\cars_ads_controller;

use App\Http\Controllers\Controller;
use App\Models\CarsAdsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CarsAdsController extends Controller
{
    // the car ads, which is accepted by the admin

    // car model / year / view for / car model year / array of cities / car type / diesel / image / geer type
    public function getCarsAds(Request $request)
    {
        // don't get directly, apply filters before
        $cars_ads = CarsAdsModel::query();

        $cars_ads = $cars_ads->where('ads_status', '1');

        if ($request->has('start-date')) {
            $cars_ads->where('created_at', '>=', Carbon::parse($request->input('start-date'))->startOfDay());
        }

        if ($request->has('end-date')) {
            $cars_ads->where('created_at', '<=', Carbon::parse($request->input('end-date'))->endOfDay());
        }

        if ($request->has('car-type')) {
            $cars_ads->where('car_type', $request->input('car-type'));
        }

        if ($request->has('car-model-year')) {
            $cars_ads->where('car_model_year', $request->input('car-model-year'));
        }


        // cities ex: ["1","2","3"]
        if ($request->has('city-id')) {
            $cars_ads->whereJsonContains('cities', $request->input('city-id'));
        }

        $cars_ads = $cars_ads->orderBy('created_at', 'desc')->paginate(10);
        // order by -> last accepted

        return response()->json([
            'status' => true,
            'pagination' => [
                'current_page' => $cars_ads->currentPage(),
                'last_page' => $cars_ads->lastPage(),
                'per_page' => $cars_ads->perPage(),
                'total_items' => $cars_ads->total(),
            ],
            'cars_parts' => $cars_ads->values(),
        ]);
    }
}
