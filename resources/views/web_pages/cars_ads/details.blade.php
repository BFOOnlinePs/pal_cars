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
                      <div class="table-responsive">
                        <table class="table table-bordered" id="selectedPairsTable">
                            <tbody>
                                <tr>
                                    <td>اسم المُعلن</td>
                                    <td>{{$data->visitor_name}}</td>
                                </tr>
                                <tr>
                                    <td>هاتف</td>
                                    <td>{{$data->visitor_mobile}}</td>
                                </tr>
                                <tr>
                                    <td>هاتف 2</td>
                                    <td>{{ $data->visitor_Mobile2 ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>البريد الإلكتروني</td>
                                    <td>{{$data->visitor_email}}</td>
                                </tr>
                                <tr>
                                    <td>المحافظة</td>
                                    <td>{{$data->visitorCity->city_name}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

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
                        {{-- <span class="info-box-icon bg-success"><i class="fa fa-dollar-sign"></i></span> --}}
                        <span class="info-box-icon bg-success"><i class="fas fa-coins"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">السعر</span>
                          <span class="info-box-number">{{$data->price}} ₪</span>
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

                    <div class="table-responsive">
                        <table class="table table-bordered" id="selectedPairsTable">
                            <tbody>
                                <tr>
                                    <td>لون السيارة</td>
                                    <td>{{$data->color->color}}</td>
                                </tr>
                                <tr>
                                    <td>موديل السيارة</td>
                                    <td>{{$data->model->car_model}}</td>
                                </tr>
                                <tr>
                                    <td>عدد الركاب</td>
                                    <td>{{$data->car_count_rokab}}</td>
                                </tr>
                                <tr>
                                    <td>عداد السيارة</td>
                                    <td>{{$data->car_counter}}</td>
                                </tr>
                                <tr>
                                    <td>طراز المحرك</td>
                                    <td>{{$data->car_motor}}</td>
                                </tr>
                                <tr>
                                    <td>قوة الماتور</td>
                                    <td>{{$data->car_motor_size}}</td>
                                </tr>
                                <tr>
                                    <td>نوع الوقود</td>
                                    <td>{{$data->diesel}}</td>
                                </tr>
                                <tr>
                                    <td>نوع الجير</td>
                                    <td>{{$data->geer_type}}</td>
                                </tr>
                                <tr>
                                    <td>الزجاج</td>
                                    <td>{{$data->glass}}</td>
                                </tr>
                                <tr>
                                    <td>الإضافات المتوفرة</td>
                                    <td>{{ $data->addon ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>عدد المالكين السابقين</td>
                                    <td>{{$data->old_owner}}</td>
                                </tr>
                                <tr>
                                    <td>أصل السيارة</td>
                                    <td>{{$data->car_sours}}</td>
                                </tr>
                                <tr>
                                    <td>رخصة السيارة</td>
                                    <td>{{$data->agreement}}</td>
                                </tr>
                                <tr>
                                    <td>معلومات إضافية</td>
                                    <td>{{ $data->additional_info ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>معروضة للـ</td>
                                    <td>{{$data->view_for}}</td>
                                </tr>
                                <tr>
                                    <td>المناطق</td>
                                    <td>{{$data->id}}</td>
                                </tr>
                                <tr>
                                    <td>طريقة الدفع</td>
                                    <td>{{$data->payment_method}}</td>
                                </tr>
                                <tr>
                                    <td>حالة الإعلان</td>
                                    @if($data->ads_status==1)
                                    <td><small class="badge badge-success">فعَّال</small></td>
                                    @elseif($data->ads_status==0)
                                    <td><small class="badge badge-danger">بانتظار المُوافقة</small></td>
                                    @elseif($data->ads_status==2)
                                    <td><small class="badge badge-warning">ملغي</small></td>
                                    @endif
                                </tr>

                            </tbody>
                        </table>
                    </div>


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
