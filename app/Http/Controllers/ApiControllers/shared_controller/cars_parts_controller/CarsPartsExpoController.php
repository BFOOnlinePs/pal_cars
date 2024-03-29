<?php

namespace App\Http\Controllers\ApiControllers\shared_controller\cars_parts_controller;

use App\Http\Controllers\Controller;
use App\Models\CarModels;
use App\Models\PartAcceptModelsModel;
use App\Models\PartExpoImagesModel;
use App\Models\PartExpoModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            ->paginate(10);

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

    // by current user
    public function addNewCarPartToExpo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'part_name' => 'required',
            'part_status' => 'required|in:مستخدم,مجدد,جديد,تقليد',
            'part_price' => 'required',
            'part_details' => 'required',
            'part_main_pic' => 'nullable|image', // file|mimes:jpg,jpeg,png,svg
            'part_pics.*' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048', // array + file|mimes:jpg,jpeg,png,svg
            //image|mimes:jpeg,png,jpg,gif|max:2048
            'car_type' => 'required|exists:cars_type,id',
        ], [
            'part_name.required' => 'الرجاء إرسال إسم القطعة',
            'part_status.required' => 'الرجاء تحديد حالة القطعة',
            'part_status.in' => 'حالة القطعة غير صحيحة',
            'part_price.required' => 'الرجاء كتابة سعر القطعة',
            'part_details.required' => 'الرجاء كتابة تفاصيل القطعة',
            // 'part_main_pic' => 'nullable',
            'part_pics.image' => 'يجب ان تكون صورة',
            'part_pics.mimes' => 'الصيغة',
            'car_type.required' => 'الرجاء تحديد نوع السيارة',
            'car_type.exists' => 'نوع السيارة غير موجود',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        // ex format:
        // "car_models": [
        //     {
        //         "car_model_name": "my model",
        //         "car_model_years": "[\"2020\",\"2022\"]" // you can not send it in the body, or send it with empty string '' / it has default value
        //     },
        //     {
        //         "car_model_name": "my model 2",
        //         "car_model_years": "[\"2020\",\"2022\",\"2023\"]"
        //     }
        // ]

        $part_expo = new PartExpoModel();
        $part_expo->part_name = $request->input('part_name');
        $part_expo->part_car_type = $request->input('car_type');
        $part_expo->part_detail = $request->input('part_details');
        $part_expo->part_status = $request->input('part_status');
        $part_expo->part_price = $request->input('part_price');
        $part_expo->insert_by = Auth()->user()->id;

        if ($request->hasFile('part_main_pic')) {
            $file = $request->file('part_main_pic');
            // return $file;
            $folderPath = 'uploads/partExpoPics';
            // $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $request->file('part_main_pic')->storeAs($folderPath, $fileName, 'public');

            $part_expo->part_main_pic = $fileName;
        }

        if ($part_expo->save()) {
            // for part expo pictures
            if ($request->hasFile('part_pics')) {
                $images = $request->file('part_pics');
                foreach ($request->part_pics as $image) {
                    $part_expo_images = new PartExpoImagesModel();
                    $folderPath = 'uploads/partExpoPics';
                    // $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $fileName = time() . '_' . uniqid() . '.' . $extension;
                    $image->storeAs($folderPath, $fileName, 'public');

                    $part_expo_images->image_path = $fileName;
                    $part_expo_images->part_id = $part_expo->id;

                    $part_expo_images->save();
                }
            }

            // for car model
            if ($request->has('car_models')) {
                $new_car_models = $request->input('car_models');
                foreach ($new_car_models as $new_car_model) {

                    // // return $new_car_model['car_model_name'];
                    // $car_model = new CarModels();
                    // $car_model->car_id = $request->input('car_type');
                    // $car_model->car_model = $new_car_model['car_model_name'];
                    // $car_model->status = 0; // so it can't be used for everyone. only the user added it




                    // add to db only if it not exists
                    // else get its id
                    // save it to the accepted models in both cases

                    // if ($car_model->save()) {
                    //     $part_accept_models = new PartAcceptModelsModel();
                    //     $part_accept_models->part_id = $part_expo->id;
                    //     $part_accept_models->part_model_id = $car_model->id;
                    //     $part_accept_models->part_model_years = $new_car_model['car_model_years'] ?? '-';
                    //     $part_accept_models->save();
                    // }

                    $car_model_in_db = CarModels::where('car_id', $request->input('car_type'))
                        ->where('car_model', $new_car_model['car_model_name'])->first();

                    $car_model_id = null;
                    if ($car_model_in_db) {
                        // get its id
                        $car_model_id =  $car_model_in_db->id;
                    } else {
                        // add to db
                        $car_model = new CarModels();
                        $car_model->car_id = $request->input('car_type');
                        $car_model->car_model = $new_car_model['car_model_name'];
                        $car_model->status = 0; // so it can't be used for everyone. only the user added it

                        $car_model->save();

                        $car_model_id = $car_model->id;
                    }

                    $part_accept_models = new PartAcceptModelsModel();
                    $part_accept_models->part_id = $part_expo->id;
                    $part_accept_models->part_model_id =  $car_model_id;
                    $part_accept_models->part_model_years = $new_car_model['car_model_years'] ?? '-';
                    $part_accept_models->save();
                }
                // return response();
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'تمت إضافة القطعة للمعرض بنجاح'
        ]);
    }
}
