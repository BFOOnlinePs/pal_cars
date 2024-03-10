<?php

namespace App\Http\Controllers\web_page;

use App\Http\Controllers\Controller;
use App\Models\CarModels;
use App\Models\CarsType;
use App\Models\PartAcceptModelsModel;
use App\Models\PartExpoImagesModel;
use App\Models\PartExpoModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PartExpoController extends Controller
{
    //
    public function index(){
        $data = PartExpoModel::with('car','user')->get();
        $cars = CarsType::get();
        // return $data;
        return view('web_pages.part_expo.index',['data'=>$data,'cars'=>$cars]);
    }

    public function details($id){
        $data = PartExpoModel::with('car','user')->where('id',$id)->first();
        $part_images = PartExpoImagesModel::where('part_id',$id)->get();
        $part_models_years = PartAcceptModelsModel::with('accepted_model')->where('part_id',$id)->get();
        // return $part_models_years;
        // return $data;
        return view('web_pages.part_expo.details',['data'=>$data,'images'=>$part_images,'part_models_years'=>$part_models_years]);
    }

    public function add(){
        $cars = CarsType::get();
        return view('web_pages.part_expo.add',['cars'=>$cars]);
    }

    public function delete(Request $request){
        // $reuest->id;
        $data = PartExpoModel::where('id',$request->id)->first();

        if ($data->delete()){
            $data = $data = PartExpoModel::with('car','user')->get();
            return response()->json([
                'success'=>'true',
                'message'=>'تم تعديل البيانات بنجاح',
                'view'=>view('web_pages.part_expo.ajax.part_expo_table',['data'=>$data])->render(),
            ]);
        }
        else{
            return response()->json([
                'success'=>'false',
                'message'=>'هناك خلل ما لم يتم تعديل البيانات'
            ]);
        }
    }

    public function search(Request $request){
        $query = PartExpoModel::query();
        // $check = false;
        $part_status_array = json_decode($request->part_status_array, true);
        if ($request->car_type != 0) {
            $query->where('part_car_type', $request->car_type);
        }
        if(!empty($part_status_array)){
            $query->whereIn('part_status', $part_status_array);
        }

        if($request->part_name!=""){
            $query->where('part_name','like','%'.$request->part_name.'%');
            // where('c_name','like','%'.$request->search.'%')
        }

        //new
        if($request->from_date!=""){
            $query->where('insert_date', '>=', Carbon::parse($request->from_date)->startOfDay());
        }

        if($request->to_date!=""){
            $query->where('insert_date', '<=', Carbon::parse($request->to_date)->endOfDay());
        }
        //

        $parts=PartExpoModel::with('car','user')->whereIn('id',$query->select('id'))->get();


        return response()->json([
            'success'=>'true',
            'view'=>view('web_pages.part_expo.ajax.part_expo_table',['data'=>$parts])->render(),
        ]);
    }

    public function get_models($id){
        $models = CarModels::where('car_id',$id)->where('status',1)->get();
        return response()->json([
            'success'=>'true',
            'models'=>$models,
        ]);
    }

    public function add_part(Request $request){

        $part = new PartExpoModel();

        $part->part_name = $request->name;
        $part->part_car_type = $request->car_type;
        $part->part_detail = $request->description;
        // $part->part_detail = $request->description;
        $part->part_price = $request->price;
        if($request->status==1){
            $part->part_status = "جديد";
        }elseif($request->status==2){
            $part->part_status = "مستخدم";
        }elseif($request->status==3){
            $part->part_status = "مجدد";
        }
        elseif($request->status==4){
            $part->part_status = "تقليد";
        }
        $part->insert_by = $request->user_id;

        if ($request->hasFile('primary_image')) {

            $file = $request->file('primary_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('uploads/partExpoPics', $filename, 'public');

            $part->part_main_pic = $filename;
        }

        // $modelss = json_decode($request->car_models, true);

        if($part->save()){
            $insertedId = $part->id;

            $years_models_part = json_decode($request->years_models_part, true);
            $car_models = json_decode($request->car_models, true);

            if($years_models_part!=null){
                if(count($years_models_part)!=0){
                    $years = $years_models_part;

                    foreach ($years as $year) {
                        $part_accept_model = new PartAcceptModelsModel();
                        $part_accept_model->part_id= $insertedId;
                        $part_accept_model->part_model_id=$year['model'];
                        $part_accept_model->part_model_years=json_encode($year['years']);
                        $part_accept_model->save();
                    }
                }
            }
            elseif($car_models!=null){

                if(count($car_models)!=0){

                    foreach ($car_models as $model) {
                        $part_accept_model = new PartAcceptModelsModel();
                        $part_accept_model->part_id=$insertedId;
                        $part_accept_model->part_model_id=$model;
                        $part_accept_model->save();
                    }
                }
            }

            if ($request->hasFile('other_images')) {


                foreach ($request->file('other_images') as $index => $image) {
                    // Store or process the file as needed
                    // $image->storeAs('images', 'image_' . $index . '.' . $image->getClientOriginalExtension());
                // }
                // $files = $request->file('other_images');

                // foreach ($files as $file) {

                    // if ($file->isValid()) {
                        $part_image = new PartExpoImagesModel();
                        $part_image->part_id = $insertedId;

                        $extension = $image->getClientOriginalExtension();
                        // $filename = time() . '.' . $extension;
                        $filename = time() . '_' . $index . '.' . $extension;
                        $image->storeAs('uploads/partExpoPics', $filename, 'public');
                        $part_image->image_path = $filename;
                        $part_image->save();
                    // }
                }
            }
        }

        // return redirect()->route('web_pages.part_expo.index')->with(['success'=>'تم اضافة البيانات بنجاح','tab_id'=>1]);

        return response()->json([
            'success'=>'true',
        ]);
    }

    public function add_temp_car_model(Request $request){
        $model = new CarModels();
        $model->car_id = $request->car_type;
        $model->car_model = $request->model_name;
        $model->status = 0;

        if($model->save()){
            $model->get();
            return response()->json([
                'success'=>'true',
                'model'=>$model
            ]);
        }
    }


}
