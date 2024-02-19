<?php

namespace App\Http\Controllers\dashboard\admin\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarsType;
use App\Models\CarModels;

class CarsTypeController extends Controller
{
    public function index(){
        $data = CarsType::get();
        return view('dashboard.admin.settings.cars_type.index',['data'=>$data]);
    }

    public function create(Request $request){
        // $request->validate([
        //     // 'type' => 'required|string|max:255',
        //     'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $carType = new CarsType();
        $carType->car_type = $request->car_type;
        if($request->note==""){
            $carType->note = "-";
        }else{
            $carType->note = $request->note;
        }


        if ($request->hasFile('logo')) {

            // $file = $request->file('logo');
            // $extension = $file->getClientOriginalExtension();
            // $filename = time() . '.' . $extension;
            // $destinationPath = public_path('assets/images/carTypeLogo');
            // $file->move($destinationPath, $filename);

            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('uploads/carTypeLogo', $filename, 'public');
            $carType->logo = $filename;

            if($carType->save()){
                $data = CarsType::get();
                return response()->json([
                    'success'=>'true',
                    'view'=>view('dashboard.admin.settings.cars_type.ajax.cars_type_table',['data'=>$data])->render(),
                ]);
            }
        }

    }

    public function delete(Request $request){
        $data = CarsType::where('id',$request->type_id)->first();

        if($data->delete()) {
            $data = CarsType::get();
            return response()->json([
                'success'=>'true',
                'view'=>view('dashboard.admin.settings.cars_type.ajax.cars_type_table',['data'=>$data])->render(),
            ]);
        }
    }

    public function update(Request $request){

        // $carType = new CarsType();
        // $carType->car_type = $request->car_type;

        $carType = CarsType::where('id',$request->type_id)->first();
        $carType->car_type = $request->car_type;

        if($request->note==""){
            $carType->note = "-";
        }else{
            $carType->note = $request->note;
        }


        if ($request->hasFile('logo')) {

            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('uploads/carTypeLogo', $filename, 'public');
            $carType->logo = $filename;
        }

        if($carType->save()){
            $data = CarsType::get();
            return response()->json([
                'success'=>'true',
                'view'=>view('dashboard.admin.settings.cars_type.ajax.cars_type_table',['data'=>$data])->render(),
            ]);
        }
    }

    public function car_models($id){
        $data = CarModels::where('car_id',$id)->get();
        $car_type = CarsType::where('id',$id)->value('car_type');

        return view('dashboard.admin.settings.cars_models.index',['data'=>$data,'car_type'=>$car_type,'car_id'=>$id]);
    }

    public function createCarModel(Request $request){
        $carModel = new CarModels();

        $carModel->car_model = $request->model;
        $carModel->car_id = $request->car_id;


        if ($request->hasFile('model_pic')) {

            $file = $request->file('model_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('uploads/carModelsPics', $filename, 'public');
            $carModel->car_model_pic = $filename;

            if($carModel->save()){
                $data = CarModels::where('car_id',$request->car_id)->get();
                return response()->json([
                    'success'=>'true',
                    'view'=>view('dashboard.admin.settings.cars_models.ajax.cars_models_table',['data'=>$data])->render(),
                ]);
            }
        }
    }

    public function deleteCarModel(Request $request){
        $data = CarModels::where('id',$request->model_id)->first();
        $type_id = $data->car_id;

        if($data->delete()) {
            $data = CarModels::where('car_id',$type_id)->get();
            return response()->json([
                'success'=>'true',
                'view'=>view('dashboard.admin.settings.cars_models.ajax.cars_models_table',['data'=>$data])->render(),
            ]);
        }
    }

    public function updateCarModel(Request $request){

        $carModel = CarModels::where('id',$request->model_id)->first();
        $carModel->car_model = $request->car_model;
        $type_id = $carModel->car_id;

        if ($request->hasFile('model_pic')) {

            $file = $request->file('model_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('uploads/carModelsPics', $filename, 'public');
            $carModel->car_model_pic = $filename;
        }

        if($carModel->save()){
            $data = CarModels::where('car_id',$type_id)->get();
            return response()->json([
                'success'=>'true',
                'view'=>view('dashboard.admin.settings.cars_models.ajax.cars_models_table',['data'=>$data])->render(),
            ]);
        }
    }

}
