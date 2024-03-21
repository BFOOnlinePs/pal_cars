<?php

namespace App\Http\Controllers\ApiControllers\shared_controller\cars_ads_controller;

use App\Http\Controllers\Controller;
use App\Models\CarModels;
use App\Models\CarsAdsImagesModel;
use App\Models\CarsAdsModel;
use App\Models\Cities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $cars_ads = $cars_ads->with('carTypeDetails:id,car_type,logo')
            ->with('model:id,car_model')
            // ->with('carCities')
            ->orderBy('created_at', 'desc')->paginate(10);
        // XX order by -> last accepted

        // cities ex: ["1","2","3"]
        // Map city IDs to names
        $cars_ads->transform(function ($car_ad) {
            $city_ids = json_decode($car_ad->cities);
            $cities = Cities::whereIn('id', $city_ids)->pluck('city_name');
            $car_ad->cities_names = $cities;
            return $car_ad;
        });

        return response()->json([
            'status' => true,
            'pagination' => [
                'current_page' => $cars_ads->currentPage(),
                'last_page' => $cars_ads->lastPage(),
                'per_page' => $cars_ads->perPage(),
                'total_items' => $cars_ads->total(),
            ],
            'cars_ads' => $cars_ads->values(),
        ]);
    }

    public function addNewCarAds(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_type_id' => 'required|exists:cars_type,id',
            'car_model_name' => 'required',
            'car_model_year' => 'required',
            'car_color_id' => 'required|exists:colors,id',
            'car_count_rokab' => 'required',
            'car_counter' => 'required',
            'car_motor' => 'required',
            'car_motor_size' => 'required',
            'car_diesel' => 'required|in:ديزل,بنزين,هايبرد,كهرباء',
            'car_geer_type' => ' required|in:عادي,أوتوماتيك,نصف أوتوماتيك',
            'car_glass' => 'required|in:إلكتروني,يدوي',
            'addon' => 'nullable',
            'car_main_pic' => 'nullable|image|mimes:jpg,jpeg,png,svg',
            'car_pics.*' => 'image|mimes:jpg,png,jpeg,gif,svg',
            'old_owner' => 'required',
            'car_sours' => 'required|in:خصوصي,عمومي,تأجير,تدريب سياقة,تجاري,حكومي',
            'car_agreement' => 'required|in:فلسطينية,نمرة صفراء',
            'additional_info' => 'nullable',
            'view_for' => 'required|in:البيع,التبديل,البيع والتبديل',
            'ads_days' => 'required',
            'cities' => 'required', // ex: ["1","2","3"]
            'price' => 'required',
            'payment_method' => 'required|in:نقداً,تقسيط,نصف نقداً ونصف تقسيط',
            // 'added_by' => 'required|exists:users,id', // use Auth instead
            'visitor_name' => 'required',
            'visitor_mobile' => 'required',
            'visitor_mobile2' => 'nullable',
            'visitor_email' => 'nullable',
            'visitor_city' => 'required|exists:cities,id',
            'visitor_address' => 'required',
        ], [
            'car_type_id.required' => 'الرجاء إرسال رقم نوع السيارة',
            'car_type_id.exists' => 'رقم نوع السيارة غير موجود',
            'car_model_name.required' => 'الرجاء ارسال اسم موديل السيارة',
            'car_model_year.required' => 'الرجاء ارسال سنة موديل السيارة',
            'car_color_id.required' => 'الرجاء ارسال لون السيارة',
            'car_color_id.exists' => 'لون السيارة غير موجود',
            'car_count_rokab.required' => 'الرجاء ارسال عدد الركاب',
            'car_counter.required' => 'الرجاء ارسال عداد السيارة',
            'car_motor.required' => 'الرجاء ارسال موتور السيارة',
            'car_motor_size.required' => 'الرجاء ارسال حجم موتور السيارة',
            'car_diesel.required' => 'الرجاء إرسال نوع الوقود',
            'car_diesel.in' => 'نوع الوقود غير معرف',
            'car_geer_type.required' => 'الرجاء إرسال نوع الجير',
            'car_geer_type.in' => 'نوع الجير غير معرف',
            'car_glass.required' => 'الرجاء إرسال نوع الزجاج',
            'car_glass.in' => 'نوع الزجاج غير معرف',
            'car_main_pic.image' => 'يجب ان تكون الصورة الرئيسية نوعها صورة',
            'car_main_pic.mimes' => 'يجب ان يكون نوع الصورة: jpg, jpeg, png, svg.',
            'car_pics.*.image' => 'يجب ان تكون الصور نوعها صورة',
            'car_pics.*.mimes' => 'يجب ان يكون نوع الصور: jpg, jpeg, png, gif, svg.',
            'old_owner.required' => 'الرجاء إرسال عدد المالكين السابقين',
            'car_sours.required' => 'الرجاء إرسال اصل السيارة',
            'car_sours.in' => 'أصل السيارة غير معرف',
            'car_agreement.required' => 'الرجاء إرسال رخصة السيارة',
            'car_agreement.in' => 'إسم رخصة السيارة غير معرف',
            'view_for.required' => 'الرجاء ارسال العرض ل',
            'view_for.in' => 'العرض ل غير معرف',
            'ads_days.required' => 'الرجاء ارسال عدد أيام العرض',
            'cities.required' => 'الرجاء ارسال المدن',
            'price.required' => 'الرجاء ارسال السعر',
            'payment_method.required' => 'الرجاء ارسال طريقة الدفع',
            'payment_method.in' => 'طريقة الدفع غير معرفة',
            'visitor_name.required' => 'الرجاء ارسال إسم صاحب السيارة',
            'visitor_mobile.required' => 'الرجاء ارسال رقم هاتف المعلن',
            'visitor_city.required' => 'الرجاء ارسال مدينة المعلن',
            'visitor_city.exists' => 'مدينة المعلن غير معرفة',
            'visitor_address.required' => 'الرجاء ارسال عنوان المعلن',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $car_ads = new CarsAdsModel();

        $car_type_id = $request->input('car_type_id');
        $car_ads->car_type = $car_type_id;

        $car_model_name = $request->input('car_model_name');
        $car_model_id = CarModels::where('car_id', $car_type_id)->where('car_model', $car_model_name)->pluck('id')->first();

        if (!$car_model_id) {
            $new_car_model = new CarModels();
            $new_car_model->car_id = $car_type_id;
            $new_car_model->car_model = $car_model_name;
            $new_car_model->status = 0;
            $new_car_model->save();
            $car_model_id = $new_car_model->id;
        }

        $car_ads->car_model = $car_model_id;
        $car_ads->car_model_year = $request->input('car_model_year');
        $car_ads->car_color = $request->input('car_color_id');
        $car_ads->car_count_rokab = $request->input('car_count_rokab');
        $car_ads->car_counter = $request->input('car_counter');
        $car_ads->car_motor = $request->input('car_counter');
        $car_ads->car_motor_size = $request->input('car_motor_size');
        $car_ads->diesel = $request->input('car_diesel');
        $car_ads->geer_type = $request->input('car_geer_type');
        $car_ads->glass = $request->input('car_glass');
        $car_ads->addon = $request->input('addon');





        if ($request->has('car_main_pic')) {
            $file = $request->file('car_main_pic');
            $folderPath = 'uploads/carExpoPics';
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $request->file('car_main_pic')->storeAs($folderPath, $fileName, 'public');

            $car_ads->pic_1 = $fileName;
        }



        $car_ads->old_owner = $request->input('old_owner');
        $car_ads->car_sours = $request->input('car_sours');
        $car_ads->agreement = $request->input('car_agreement');
        $car_ads->additional_info = $request->input('additional_info');
        $car_ads->view_for = $request->input('view_for');
        $car_ads->ads_days = $request->input('ads_days');
        $car_ads->cities = $request->input('cities');
        $car_ads->price = $request->input('price');
        $car_ads->payment_method = $request->input('payment_method');
        $car_ads->add_by = auth()->user()->id;
        $car_ads->visitor_name = $request->input('visitor_name');
        $car_ads->visitor_mobile = $request->input('visitor_mobile');
        $car_ads->visitor_mobile2 = $request->input('visitor_mobile2');
        $car_ads->visitor_email = $request->input('visitor_email');
        $car_ads->visitor_city = $request->input('visitor_city');
        $car_ads->visitor_address = $request->input('visitor_address');

        $car_ads->ads_status = 0; // not shared yet


        // after car ads saved, add car expo pics:
        // for car expo pictures
        if ($car_ads->save())
            if ($request->hasFile('car_pics')) {
                $images = $request->file('car_pics');
                foreach ($request->car_pics as $image) {
                    $car_expo_images = new CarsAdsImagesModel();
                    $folderPath = 'uploads/carExpoPics';
                    $extension = $image->getClientOriginalExtension();
                    $fileName = time() . '_' . uniqid() . '.' . $extension;
                    $image->storeAs($folderPath, $fileName, 'public');

                    $car_expo_images->image_path = $fileName;
                    $car_expo_images->car_ads_id = $car_ads->id;

                    $car_expo_images->save();
                }
            }


        return response()->json([
            'status' => true,
            'message' => 'تم إضافة إعلان السيارة بنجاح',
            'car_ad' => $car_ads
        ]);
    }
}
