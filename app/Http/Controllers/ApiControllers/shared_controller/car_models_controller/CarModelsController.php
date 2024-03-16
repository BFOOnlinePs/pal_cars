<?php

namespace App\Http\Controllers\ApiControllers\shared_controller\car_models_controller;

use App\Http\Controllers\Controller;
use App\Models\CarModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function addCarModel(Request $request){
        $validator = Validator::make($request->all(), [
            'car_model_name' => 'required',
            'car_id' => 'required|exists:cars_type,id',
        ],[
            'car_model_name.required' => 'يجب إرسال اسم الموديل الجديد',
            'car_id.required' => 'يجب إرسال رقم نوع السيارة',
            'car_id.exists' => 'السيارة غير موجودة',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

         $car_model = new CarModels();
         $car_model->car_id = $request->input('car_id');
         $car_model->car_model = $request->input('car_model_name');
         $car_model->status = 0; // so it can't be used for everyone. only the user added it

         $car_model->save();

        return response()->json([
            'status' => true,
            'message' => 'تم إضافة الموديل بنجاح',
            'carModel' => $car_model
        ]);
    }
}
