<?php

namespace App\Http\Controllers\dashboard\admin\settings;

use App\Http\Controllers\Controller;
use App\Models\ColorsModel;
use Illuminate\Http\Request;

class CarsColorsController extends Controller
{
    //
    public function index(){
        $data = ColorsModel::get();
        return view('dashboard.admin.settings.cars_colors.index',['data'=>$data]);
    }

    public function add(Request $request){
        $color = new ColorsModel();
        $color->color = $request->color;

        if($color->save()){
            $data = ColorsModel::get();
            return response()->json([
                'success'=>'true',
                'message'=>'تم الإضافة  بنجاح',
                'view'=>view('dashboard.admin.settings.cars_colors.ajax.car_colors_table',['data'=>$data])->render(),
            ]);
        }else{
            return response()->json([
                'success'=>'false',
                'message'=>'هناك خلل ما لم يتم الإضافة'
            ]);
        }
    }

    public function update(Request $request){
        $color = ColorsModel::where('id',$request->edit_color_id)->first();
        $color->color = $request->edit_color_name;

        if($color->save()){
            $data = ColorsModel::get();
            return response()->json([
                'success'=>'true',
                'message'=>'تم التعديل  بنجاح',
                'view'=>view('dashboard.admin.settings.cars_colors.ajax.car_colors_table',['data'=>$data])->render(),
            ]);
        }else{
            return response()->json([
                'success'=>'false',
                'message'=>'هناك خلل ما لم يتم التعديل'
            ]);
        }
    }
}
