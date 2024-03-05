<?php

namespace App\Http\Controllers\ApiControllers\shared_controller\cars_parts_controller;

use App\Http\Controllers\Controller;
use App\Models\PartAcceptModelsModel;
use App\Models\PartExpoImagesModel;
use App\Models\PartExpoModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CarsPartsExpoController extends Controller
{
    // for all users
    // it has filters as query params
    public function getCarsPartsExpo(Request $request)
    {
        // don't get directly, apply filters before
        $cars_parts_expo = PartExpoModel::query();
        if ($request->has('part-name')) {
            $cars_parts_expo->where('part_name', 'LIKE', '%' . $request->input('part-name') . '%');
        }

        if ($request->has('car-type')) {
            $cars_parts_expo->where('part_car_type', $request->input('car-type'));
        }

        if ($request->has('part-status')) {
            $selected_parts_statuses = $request->input('part-status'); // ex: part-status=جديد,مستخدم

            if (!is_array($selected_parts_statuses)) {
                // If it's not an array, convert it to an array
                $selected_parts_statuses = explode(',', $selected_parts_statuses);
            }
            $cars_parts_expo->whereIn('part_status', $selected_parts_statuses);
        }

        if ($request->has('start-date')) {
            $cars_parts_expo->where('insert_date', '>=', Carbon::parse($request->input('start-date'))->startOfDay());
        }

        if ($request->has('end-date')) {
            $cars_parts_expo->where('insert_date', '<=', Carbon::parse($request->input('end-date'))->endOfDay());
        }

        $cars_parts_expo = $cars_parts_expo->with('carType:id,car_type,logo')
            ->orderBy('insert_date', 'desc')
            ->paginate(7);

        // pagination object
        return response()->json([
            'status' => true,
            'pagination' => [
                'current_page' => $cars_parts_expo->currentPage(),
                'last_page' => $cars_parts_expo->lastPage(),
                'per_page' => $cars_parts_expo->perPage(),
                'total_items' => $cars_parts_expo->total(),
            ],
            'cars_parts' => $cars_parts_expo->values(),

        ]);
    }

    public function getCarPartDetails($id)
    {
        $car_part = PartExpoModel::find($id);

        if (!$car_part) {
            return response()->json([
                'status' => false,
                'message' => 'رقم القطعة غير صحيح',
            ]);
        }

        $car_part = $car_part->load('carType:id,car_type,logo')
            ->load('user:id,name,email,user_phone1,user_phone2,user_photo,user_website,user_address,user_city');

        $car_part->part_images = PartExpoImagesModel::where('part_id', $id)
            ->get(['id', 'image_path']);

        $car_part->accepted_models = PartAcceptModelsModel::with('carModel:id,car_model')
            ->where('part_id', $id)->get();

        return response()->json([
            'status' => true,
            'car_part' => $car_part,
        ]);
    }
}
