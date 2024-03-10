@extends('layouts.app')
@section('title')
    معرض السيارات
@endsection
@section('header_title')
    معرض السيارات
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
    معرض السيارات
@endsection
@section('style')
<style>
    .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 30px;
        }
</style>
@endsection
@section('content')
<div class="row">

    <div class="col-md-5 mx-auto">
        <div class="card">
            @if ($data->pic_1 && file_exists(public_path('storage/uploads/carExpoPics/' . $data->pic_1)))
                <img class="card-img-top" src="{{ asset('storage/uploads/carExpoPics/' . $data->pic_1) }}" style="cursor: pointer;" onclick="openPic({{$data}},'primary')" alt="Alternate Text" />
            @else
                <img class="card-img-top" src="{{ asset('storage/uploads/systemPics/noImage.png') }}" alt="Photo" />
            @endif
            {{-- <img src="" class="card-img-top" alt="Car 1"> --}}
            <div class="card-body">
                      {{-- <h5 class="card-title">Car Model 1</h5> --}}
                      @if(!$images->isEmpty())
                      <div class="car-images">
                        <h6 class="font-weight-bold mt-3">صور إضافية</h6>
                        <div class="row">
                            @foreach ($images as $image)
                            {{-- <div class="col-4 mb-2">
                                <img src="{{ asset('storage/uploads/partExpoPics/' . $image->image_path) }}" alt="Image" style="cursor: pointer;" onclick="openPic('{{$image->image_path}}')" class="img-thumbnail">
                            </div> --}}
                            <div class="col-md-3">
                                <img src="{{ asset('storage/uploads/carExpoPics/' . $image->image_path) }}" style="cursor: pointer;" onclick="openPic({{$image}},'other')" width="100%" alt="">
                            </div>
                            @endforeach


                          <!-- Add more images as needed -->
                        </div>
                      </div>
                      @endif

                      <h6 class="font-weight-bold mt-3">معلومات المُعلن</h6>
                      <ul class="list-group">
                        <li class="list-group-item">اسم المعلن: {{$data->visitor_name}}</li>
                        <li class="list-group-item">هاتف: {{$data->visitor_mobile}}</li>
                        <li class="list-group-item">هاتف 2: {{$data->visitor_Mobile2}}</li>
                        <li class="list-group-item">البريد الإلكتروني: {{$data->visitor_email}}</li>
                        <li class="list-group-item">المحافظة: {{$data->visitorCity->city_name}}</li>
                        {{-- <li class="list-group-item">العنوان: </li> --}}
                        <!-- Add more details as needed -->
                      </ul>


            </div>
        </div>
    </div>

    <div class="col-md-7 mx-auto">
        <div class="card">
            {{-- <img src="{{asset('storage/uploads/systemPics/noImage.png')}}" class="card-img-top" alt="Car 1"> --}}
            {{-- <img src="" class="card-img-top" alt="Car 1"> --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 col-sm-6 col-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fa fa-car"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">نوع السيارة</span>
                          <span class="info-box-number">{{$data->carType->car_type}}</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 col-sm-6 col-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fa fa-dollar-sign"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">السعر</span>
                          <span class="info-box-number">{{$data->price}}</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fa fa-calendar"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">سنة التصنيع</span>
                          <span class="info-box-number">{{$data->car_model_year}}</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>

                  </div>
                {{-- <div class="card"> --}}

                    {{-- <div class="card-body"> --}}
                      {{-- <h5 class="card-title">Car Model 1</h5> --}}

                      {{-- <div class="car-images">
                        <h6 class="font-weight-bold mt-3">Additional Images:</h6>
                        <div class="row">
                          <div class="col-md-3">
                            <img src="car1_1.jpg" alt="Car 1 Image 1">
                          </div>
                          <div class="col-md-3">
                            <img src="car1_2.jpg" alt="Car 1 Image 2">
                          </div>
                          <!-- Add more images as needed -->
                        </div>
                      </div> --}}

                      <h6 class="font-weight-bold mt-3">معلومات السيارة</h6>
                      <ul class="list-group">
                        <li class="list-group-item">لون السيارة: {{$data->color->color}}</li>
                        <li class="list-group-item">موديل السيارة: {{$data->model->car_model}}</li>
                        <li class="list-group-item">عدد الركاب: {{$data->car_count_rokab}}</li>
                        <li class="list-group-item">عداد السيارة: {{$data->car_counter}}</li>
                        <li class="list-group-item">طراز المحرك: {{$data->car_motor}}</li>
                        <li class="list-group-item">قوة الماتور: {{$data->car_motor_size}}</li>
                        <li class="list-group-item">نوع الوقود: {{$data->diesel}}</li>
                        <li class="list-group-item">نوع الجير: {{$data->geer_type}}</li>
                        <li class="list-group-item">الزجاج: {{$data->glass}}</li>
                        <li class="list-group-item">الإضافات المتوفرة: {{$data->addon}}</li>
                        <li class="list-group-item">عدد المالكين السابقين: {{$data->old_owner}}</li>
                        <li class="list-group-item">أصل السيارة: {{$data->car_sours}}</li>
                        <li class="list-group-item">رخصة السيارة: {{$data->agreement}}</li>
                        <li class="list-group-item">معلومات إضافية: {{$data->additional_info}}</li>
                        <li class="list-group-item">معروضة للـ: {{$data->view_for}}</li>
                        <li class="list-group-item">المناطق: {{$data->id}}</li>
                        <li class="list-group-item">طريقة الدفع: {{$data->payment_method}}</li>
                        @if($data->ads_status==1)
                        <li class="list-group-item">حالة الإعلان: مٌفعل</li>
                        @elseif($data->ads_status==2)
                        <li class="list-group-item">حالة الإعلان: منتهي</li>
                        @endif
                        {{-- <li class="list-group-item">: {{$data->}}</li>
                        <li class="list-group-item">: {{$data->}}</li> --}}
                        <!-- Add more details as needed -->
                      </ul>
                    {{-- </div> --}}
                  {{-- </div> --}}

            </div>
        </div>
    </div>

</div>
<div>
    @include('web_pages.cars_ads.modals.pic_modal')
</div>
@endsection
@section('script')
<script>
    function openPic(data,photo_type){

        if(photo_type=='primary'){
            var pic = data.pic_1;
        }else{
            var pic = data.image_path;
        }

        link= "storage/uploads/carExpoPics/"
        var assetPath = '{{ asset('') }}'+link+pic;
        // var x = '<img width="100%" height="100%" src="' + assetPath + pic + '" alt="Car Model">';
        var x = `<img width="100%" height="100%" src="${assetPath}" alt="Car Model">`;
        $('#modal_body').html(x);
        $('#pic_modal').modal('show');
    }
</script>
@endsection
