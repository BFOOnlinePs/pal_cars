<?php

namespace App\Http\Controllers\web_page;

use App\Http\Controllers\Controller;
use App\Models\CarModels;
use App\Models\CarsType;
use App\Models\Cities;
use App\Models\NotificationsModel;
use App\Models\NotInterestedModel;
use App\Models\RequestImagesModel;
use App\Models\RequestModel;
use App\Models\RequestOfferModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequiredPartsController extends Controller
{
    //
    public function index(){
        $user_id = Auth::id();

        //not get not intersted parts
        $not_interested_parts = NotInterestedModel::where('user_id',$user_id)->pluck('part_id')->toArray();

        //not get the parts thats has offer by this user
        $parts_has_offer = RequestOfferModel::where('offer_from_user_id',$user_id)->pluck('request_id')->toArray();

        $data = RequestModel::with('car')->whereNotIn('id', $not_interested_parts)
        ->whereNotIn('id',$parts_has_offer)
        ->get();

        return view('web_pages.required_parts.index',['data'=>$data]);
    }

    public function choose_car_type(){
        $cars = CarsType::get();
        return view('web_pages.required_parts.choose_car_type',['cars'=>$cars]);
    }

    public function add($id){
        $car_type = CarsType::where('id',$id)->first();
        $car_models = CarModels::where('car_id',$car_type->id)->get();

        $currentYear = now()->year;
        // Generate an array of years from 1960 to the current year
        $years = range(1960, $currentYear);
        // Reverse the array to have the most recent year first
        $years = array_reverse($years);

        $cities = Cities::get();
        return view('web_pages.required_parts.add',['car_type'=>$car_type,'car_models'=>$car_models
        ,'years'=>$years,'cities'=>$cities
        ]);
    }

    public function create(Request $request){
        $car_part = new RequestModel();

        $car_part->car_type = $request->car_type_id;
        $car_part->car_model = $request->car_model;
        $car_part->model_note = $request->car_model_text;
        $car_part->pr_year = $request->production_year;
        $car_part->geer_type = $request->geer_type;
        $car_part->motor_type = $request->car_counter_type;
        $car_part->motor_size = $request->motor_size;
        $car_part->city = $request->city;
        $car_part->location = $request->address;
        $car_part->part_request = $request->part;
        $car_part->new_part = $request->has('new_part') ? 1 : 0;
        $car_part->used_part = $request->has('used_part') ? 1 : 0;
        $car_part->copying_part = $request->has('copying_part') ? 1 : 0;
        $car_part->renovated_part = $request->has('renovated_part') ? 1 : 0;
        $car_part->notes = $request->notes;
        $car_part->user_id = Auth::id();
        // $car_part->request_status = 1;
        $car_part->Fuel_type = $request->diesel;

        // return $car_part;
        // return $request;

        if($car_part->save()){
            $new_id = $car_part->id;
            if ($request->hasFile('add_images')) {
                $images = $request->file('add_images');

                foreach ($images as $index => $image) {
                    $other_images = new RequestImagesModel();
                    $other_images->request_id = $new_id;

                    $extension = $image->getClientOriginalExtension();
                    $filename = time() . '_' . $index . '.' . $extension;
                    $image->storeAs('uploads/partRequestPics', $filename, 'public');
                    $other_images->image_path = $filename;
                    $other_images->save();
                }
            }
            return "everything good";
            //edit here to return the requested parts by me page
            return redirect()->route('web_pages.cars_ads.create_message');
        }else {
            return redirect()->back()->withInput();
        }

        //هون عمل اشعار يجي للشركات اللي عاملة انتيريست على نوع السيارة
    }

    public function not_interested(Request $request){
        $part_id = $request->id;
        $user_id = Auth::id();

        $not_interested_part = new NotInterestedModel();
        $not_interested_part->user_id = $user_id;
        $not_interested_part->part_id = $part_id;

        if($not_interested_part->save()){
            return response()->json([
                'success'=>'true',
                'message'=>'تم الإزالة  بنجاح',
            ]);
        }else{
            return response()->json([
                'success'=>'false',
                'message'=>'هناك خلل ما لم تتم الإزالة'
            ]);
        }

    }

    public function offers_by_me(){
        $user_id = Auth::id();
        $offers = RequestOfferModel::with('request')->where('offer_from_user_id',$user_id)->get();
        return view('web_pages.required_parts.offers_by_me',['data'=>$offers]);
    }

    public function new_part_price(Request $request){
        $user_id = Auth::id();
        $data = new RequestOfferModel();
        $data->price_offer = $request->new_part_price;
        $data->offer_from_user_id = $user_id;
        $data->offer_detail = "عرض مباشر";
        $data->request_id = $request->request_id;
        if($data->save()){
            return redirect()->route('web_pages.required_parts.add_offer_photos', ['id' => $data->id]);
        } else {
            return redirect()->back()->withInput()->withErrors(['فشل إضافة السعر']);
        }
    }

    public function add_offer_photos($id){
        return view('web_pages.required_parts.add_photos_page',['id'=>$id]);
    }

    public function create_offer_photos(Request $request){
        if ($request->hasFile('add_images')) {
            $images = $request->file('add_images');

            foreach ($images as $index => $image) {
                $other_images = new RequestImagesModel();
                $other_images->request_id = $request->offer_id;

                $extension = $image->getClientOriginalExtension();
                $filename = time() . '_' . $index . '.' . $extension;
                $image->storeAs('uploads/requestOfferPics', $filename, 'public');
                $other_images->image_path = $filename;
                $other_images->save();
            }
        }
        return redirect()->route('web_pages.required_parts.offers_by_me');
    }

    public function requested_part_details($id){
        // return $id;
        $data = RequestModel::with('model','city_name')->where('id',$id)->first();
        $add_offer = true;
        $user_id = Auth::id();
        $offer = RequestOfferModel::where('offer_from_user_id',$user_id)->where('request_id',$id)->first();
        if($offer != null){
            $add_offer = false;
        }
        return view('web_pages.required_parts.requested_part_details',['data'=>$data,'add_offer'=>$add_offer]);
    }

    public function add_offer($id){
        $data = RequestModel::with('model','city_name')->where('id',$id)->first();
        return view('web_pages.required_parts.add_offer',['data'=>$data]);
    }

    public function create_offer(Request $request){
        $request_user_id = RequestModel::where('id',$request->request_id)->first()->user_id;
        $offer = new RequestOfferModel();
        $offer->request_id = $request->request_id;
        $offer->price_offer = $request->new_price;
        $offer->price_used_part = $request->used_price;
        $offer->price_copying_part = $request->copying_price;
        $offer->price_renovated_part = $request->renovated_price;
        $offer->offer_detail = $request->offer_notes;
        $offer->offer_from_user_id = Auth::id();

        if($offer->save()){
            $notification = new NotificationsModel();
            $notification->user_id = $request_user_id;
            $notification->rec_id = $offer->id;
            $notification->type = "offer";
            $notification->insert_by = Auth::id();
            if($notification->save()){
                return redirect()->route('web_pages.cars_ads.create_message')->with(['success' => 'تم إضافة عرض الأسعار بنجاح !']);
            }else {
                return redirect()->back()->withInput();
            }
        }
    }

    public function offer_details($id){
        // $id for offer;
        // $user_id = Auth::id();

        //offer
        $offer = RequestOfferModel::with('offer_by')->where('id',$id)->first();

        //request
        $data = RequestModel::with('model','city_name')->where('id',$offer->request_id)->first();


        return view('web_pages.required_parts.offer_details',['data'=>$data,'offer'=>$offer]);
    }

    public function request_offer_details($id){

        //offer
        $offer = RequestOfferModel::with('offer_by')->where('request_id',$id)->first();

        //request
        $data = RequestModel::with('model','city_name')->where('id',$id)->first();


        return view('web_pages.required_parts.offer_details',['data'=>$data,'offer'=>$offer]);
    }

    public function offer_notification($id,$notification_id){

        $notification = NotificationsModel::where('id',$notification_id)->first();
        $notification->seen = 1;
        if($notification->save()){
            //offer
            $offer = RequestOfferModel::with('offer_by')->where('id',$id)->first();

            //request
            $data = RequestModel::with('model','city_name')->where('id',$offer->request_id)->first();

            $offer->seen = 1;

            if($offer->save()){
                return view('web_pages.required_parts.offer_details',['data'=>$data,'offer'=>$offer]);
            }


        }

    }
}
