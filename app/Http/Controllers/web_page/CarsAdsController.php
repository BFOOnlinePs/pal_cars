<?php

namespace App\Http\Controllers\web_page;

use App\Http\Controllers\Controller;
use App\Models\CarModels;
use App\Models\CarsAdsImagesModel;
use App\Models\CarsAdsModel;
use App\Models\CarsType;
use App\Models\Cities;
use App\Models\ColorsModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Colors;

class CarsAdsController extends Controller
{
    protected $years;
    protected $seatsArray;

    public function __construct()
    {
        $currentYear = now()->year;
        // Generate an array of years from 1960 to the current year
        $years = range(1960, $currentYear);
        // Reverse the array to have the most recent year first
        $years = array_reverse($years);
        // Set your parameter here
        $this->years = $years;

        $maxAdditionalSeats = 9; // You can adjust this according to your needs
        $seatsArray = [];

        $seatsArray[] = '1';
        for ($i = 1; $i <= $maxAdditionalSeats; $i++) {
            $seatDescription = '1+' . $i;
            $seatsArray[] = $seatDescription;
        }
        $seatsArray[] = 'أكثر من 10';
        $this->seatsArray = $seatsArray;
    }
    //
    public function index(){
        //here make filter in the index page
        $cars_ads = CarsAdsModel::orderBy('created_at', 'desc')->where('ads_status','=',1)->with('model','carType')->get();
        $cars = CarsType::get();
        $cities = Cities::get();
        $colors = ColorsModel::get();
        // $model =

        foreach ($cars_ads as $car_ad) {
            $city_ids = json_decode($car_ad->cities); // Assuming 'cities' is the column name

            // $city_names = "";
            $city_names = [];

            foreach ($city_ids as $city_id) {
                $city = $cities->where('id', $city_id)->first();

                if ($city) {
                    // $city_names = $city_names.$city->city_name." | ";
                    $city_names[] = $city->city_name;
                }
            }

            $city_names_string = implode(" | ", $city_names);
            // Assign the city names to the car ad
            $car_ad->city_names = $city_names_string;
        }

        // return $cars_ads;

        return view('web_pages.cars_ads.index',['cars_ads'=>$cars_ads,'years'=>$this->years,'cars'=>$cars
        ,'cities'=>$cities,'colors'=>$colors,'seats'=>$this->seatsArray]);
    }

    public function choose_car_type(){
        $cars = CarsType::get();
        return view('web_pages.cars_ads.choose_car_type',['cars'=>$cars]);
    }

    public function add($id,$user_id){
        // $cars = CarsType::get();
        // if($user_id==null){
        //     redirect()->route('login');
        // }

        $user = User::with('city')->where('id',$user_id)->first();

        // return $user;

        $colors = ColorsModel::get();



        $cities = Cities::get();

        $max_adv_days = 59; // You can adjust this according to your needs
        $adv_days = [];

        // $seatsArray[] = '1';
        for ($i = 1; $i <= $max_adv_days; $i++) {
            $advDescription = $i;
            $adv_days[] = $advDescription;
        }
        // $seatsArray[] = 'أكثر من 10';

        return view('web_pages.cars_ads.add',['id'=>$id,'years'=>$this->years,'colors'=>$colors,
        'seats'=>$this->seatsArray,'cities'=>$cities,'adv_days'=>$adv_days,'user'=>$user]);
    }

    public function create(Request $request){
        // return $request;

        $data = new CarsAdsModel();
        $data->car_type = $request->car_type;

        $model = CarModels::where('car_model',$request->car_model)->first();
        if($model !=null){
            $data->car_model = $model->id;
        }else{
            $model = new CarModels();
            $model->car_model = $request->car_model;
            $model->car_id=$request->car_type;
            if($model->save()){
                $data->car_model = $model->id;
            }
        }
        // $data->car_model = $request->car_model;//make check
        $data->car_model_year = $request->production_year;
        $data->car_color = $request->car_color;
        $data->car_count_rokab = $request->seats_number;
        $data->car_counter = $request->car_counter;
        $data->car_motor = $request->car_motor;
        $data->car_motor_size = $request->motor_size;
        $data->diesel = $request->diesel;
        $data->geer_type = $request->geer_type;
        $data->glass = $request->glass;
        $data->addon = $request->addon;
        $data->old_owner = $request->old_owner;
        $data->car_sours = $request->car_sours;
        $data->agreement = $request->agreement;
        $data->additional_info = $request->additional_info;
        $data->view_for = $request->view_for;
        $data->ads_days = $request->ads_days;
        // $data->cities = $request->cities;
        $data->cities = json_encode($request->cities);
        $data->price = $request->price;
        $data->payment_method = $request->payment_method;
        $data->visitor_city = $request->visitor_city;
        $data->visitor_name = $request->visitor_name;
        $data->visitor_mobile = $request->visitor_phone1;
        $data->	visitor_Mobile2 = $request->visitor_phone2;
        $data->visitor_email = $request->visitor_email;
        $data->visitor_address = $request->visitor_address;
        $data->ads_status=0;
        $data->add_by=$request->add_by;

        if ($request->hasFile('primary_image')) {

            $file = $request->file('primary_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('uploads/carExpoPics', $filename, 'public');

            $data->pic_1 = $filename;
        }

        if($data->save()){
            $new_id = $data->id;
            if ($request->hasFile('add_images')) {
                $images = $request->file('add_images');

                foreach ($images as $index => $image) {
                    $other_images = new CarsAdsImagesModel();
                    $other_images->car_ads_id = $new_id;

                    $extension = $image->getClientOriginalExtension();
                    // $filename = time() . '.' . $extension;
                    $filename = time() . '_' . $index . '.' . $extension;
                    $image->storeAs('uploads/carExpoPics', $filename, 'public');
                    $other_images->image_path = $filename;
                    $other_images->save();
                }
            }
            return redirect()->route('web_pages.cars_ads.create_message')->with(['success' => 'تم إضافة الإعلان بنجاح ! بإنتظار موافقة الآدمن']);
        }else {
            return redirect()->back()->withInput();
        }





        // if ($request->hasFile('primary_image')) {
        // return $request;
        // return $request;
        // }

        // if ($data->save()) {
            return redirect()->route('web_pages.cars_ads.create_message')->with(['success' => 'تم إضافة الإعلان بنجاح ! بإنتظار موافقة الآدمن']);
        // } else {
            // return redirect()->back()->withInput();
        // }
    }

    public function details($id){
        $data = CarsAdsModel::with('visitorCity','model')->where('id',$id)->first();
        $images = CarsAdsImagesModel::where('car_ads_id',$id)->get();
        // return $images;
        return view('web_pages.cars_ads.details',['data'=>$data,'images'=>$images]);
    }

    public function create_message(){
        return view('web_pages.cars_ads.create_message');
    }

    public function search(Request $request){

        $cars_ads = CarsAdsModel::query()
        ->when($request->filled('from_date'), function ($query) use ($request) {
            return $query->where('insert_date', '>=', $request->from_date)->where('ads_status','!=',0);
        })
        ->when($request->filled('to_date'), function ($query) use ($request) {
            return $query->where('insert_date', '<=', $request->to_date)->where('ads_status','!=',0);
        })
        ->when($request->filled('car_type'), function ($query) use ($request) {
            return $query->where('car_type', '=', $request->car_type)->where('ads_status','!=',0);
        })
        ->when($request->filled('production_year'), function ($query) use ($request) {
            return $query->where('car_model_year', '=', $request->production_year)->where('ads_status','!=',0);
        })
        ->when($request->filled('city'), function ($query) use ($request) {
            // return $query->where('city', '=', $request->city);
            $cityValue = [$request->city];
            return $query->whereJsonContains('cities', $cityValue);
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json([
            'success'=>'true',
            'view'=>view('web_pages.cars_ads.ajax.car_ads',['cars_ads'=>$cars_ads])->render(),
        ]);
    }

    public function advanced_search(Request $request){

        $cars_ads = CarsAdsModel::query()
        ->when($request->filled('car_color'), function ($query) use ($request) {
            return $query->where('car_color', '=', $request->car_color);
        })
        ->when($request->filled('seats_number'), function ($query) use ($request) {
            return $query->where('car_count_rokab', '=', $request->seats_number);
        })
        ->when($request->filled('diesel'), function ($query) use ($request) {
            return $query->where('diesel', '=', $request->diesel);
        })
        ->when($request->filled('geer_type'), function ($query) use ($request) {
            return $query->where('geer_type', '=', $request->geer_type);
        })
        ->when($request->filled('glass'), function ($query) use ($request) {
            return $query->where('glass', '=', $request->input('glass'));
        })
        ->when($request->filled('counter'), function ($query) use ($request) {
            $counter = $request->input('counter');
            switch ($counter) {
                case 1:
                    return $query->whereBetween('car_counter', [0, 20000]);
                case 2:
                    return $query->whereBetween('car_counter', [20000, 50000]);
                case 3:
                    return $query->whereBetween('car_counter', [50000, 100000]);
                case 4:
                    return $query->whereBetween('car_counter', [100000, 150000]);
                case 5:
                    return $query->where('car_counter', '>', 150000);
                default:
                    return $query;
            }
            // return $query->where('car_counter', '=', $request->counter);
        })
        ->when($request->filled('car_motor_size'), function ($query) use ($request) {
            // return $query->where('car_motor_size', '=', $request->car_motor_size);
            $counter = $request->input('car_motor_size');
            switch ($counter) {
                case 1:
                    return $query->whereBetween('car_motor_size', [500, 1000]);
                case 2:
                    return $query->whereBetween('car_motor_size', [1000, 2000]);
                case 3:
                    return $query->whereBetween('car_motor_size', [2000, 3000]);
                case 4:
                    return $query->whereBetween('car_motor_size', [3000, 4000]);
                case 5:
                    return $query->whereBetween('car_motor_size', [4000, 5000]);
                default:
                    return $query;
            }
        })
        ->when($request->filled('old_owners'), function ($query) use ($request) {
            return $query->where('old_owner', '=', $request->old_owners);
        })
        ->when($request->filled('car_sours'), function ($query) use ($request) {
            return $query->where('car_sours', '=', $request->car_sours);
        })
        ->when($request->filled('agreement'), function ($query) use ($request) {
            return $query->where('agreement', '=', $request->agreement);
        })
        ->when($request->filled('view_for'), function ($query) use ($request) {
            return $query->where('view_for', '=', $request->view_for);
        })
        ->when($request->filled('price'), function ($query) use ($request) {
            // return $query->where('price', '=', $request->price);
            $counter = $request->input('price');
            switch ($counter) {
                case 1:
                    return $query->whereBetween('price', [0, 10000]);
                case 2:
                    return $query->whereBetween('price', [10000, 20000]);
                case 3:
                    return $query->whereBetween('price', [20000, 30000]);
                case 4:
                    return $query->whereBetween('price', [30000, 40000]);
                case 5:
                    return $query->whereBetween('price', [40000, 50000]);
                case 6:
                    return $query->whereBetween('price', [50000, 60000]);
                case 7:
                    return $query->whereBetween('price', [60000, 70000]);
                case 8:
                    return $query->whereBetween('price', [70000, 80000]);
                case 9:
                    return $query->whereBetween('price', [80000, 90000]);
                case 10:
                    return $query->where('price', '>', 100000);
                default:
                    return $query;
            }
        })
        ->when($request->filled('payment_method'), function ($query) use ($request) {
            return $query->where('payment_method', '=', $request->payment_method);
        })
        ->orderBy('created_at', 'desc')
        ->get();


        return response()->json([
            'success'=>'true',
            'view'=>view('web_pages.cars_ads.ajax.car_ads',['cars_ads'=>$cars_ads])->render(),
        ]);
    }

}
