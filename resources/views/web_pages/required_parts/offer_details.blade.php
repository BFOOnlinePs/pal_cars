@extends('layouts.app')
@section('title')
    تفاصيل عرض السعر
@endsection
@section('header_title')
    تفاصيل عرض السعر
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
    تفاصيل عرض السعر
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

{{-- @if($add_offer)
<div class="row">
    <div class="col-md-8 mx-auto">
        <a class="btn btn-warning mb-2 mr-3" href=""><i class="fa fa-plus"></i> تفاصيل عرض السعر</a>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-8 mx-auto">
        <a class="btn btn-warning mb-2 mr-3" href=""><i class="fa fa-search"></i> تفاصيل العرض المُقدم بواسطتي لهذا الطلب</a>
    </div>
</div>
@endif --}}

<div class="row">


    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-body">
                <h5 class="text-center">تفاصيل عرض الأسعار المُقدم</h5>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="selectedPairsTable">
                        <tbody>
                            <tr>
                                <td>تاريخ إرسال العرض</td>
                                <td>{{$offer->created_at}}</td>
                            </tr>
                            <tr>
                                <td>عرض بواسطة</td>
                                <td>{{$offer->offer_by->name}}</td>
                            </tr>
                            <tr>
                                <td>هاتف</td>
                                <td>{{$offer->offer_by->user_phone1}}</td>
                            </tr>
                            <tr>
                                <td>هاتف 2</td>
                                <td>{{ $offer->offer_by->user_phone2 ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>تفاصيل</td>
                                <td>{{$offer->offer_detail ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td>سعر الجديد</td>
                                <td>{{$offer->price_offer ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td>سعر المستخدم</td>
                                <td>{{$offer->price_used_part ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td>سعر التقليد</td>
                                <td>{{$offer->price_copying_part ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td>سعر المُجدد</td>
                                <td>{{$offer->price_renovated_part ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td>تمت مشاهدة العرض المٌقدم</td>
                                <td>
                                    @if($offer->seen==0)
                                        <small class="badge badge-warning">لم يُشاهد بعد</small>
                                    @else
                                        <small class="badge badge-success"> تمت مشاهدته</small>
                                    @endif
                                </td>
                            </tr>
                            {{-- <tr>
                                <td>المحافظة</td>
                                <td>{{$data->visitorCity->city_name}}</td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>{{$data->part_request}}</h3>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fa fa-car"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">نوع السيارة</span>
                          <span class="info-box-number">{{$data->car->car_type}}</span>
                          {{-- <span class="info-box-number">test</span> --}}
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6 col-sm-6 col-12">
                      <div class="info-box">
                        {{-- <span class="info-box-icon bg-success"><i class="fa fa-dollar-sign"></i></span> --}}
                        <span class="info-box-icon bg-success"><i class="fas fa-question-circle"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">حالة القطعة المطلوبة</span>
                          <span class="info-box-number">
                            @if($data->new_part==1)
                            <small class="badge badge-secondary">مطلوب جديد</small>
                            @endif
                            @if($data->used_part==1)
                            <small class="badge badge-secondary">مطلوب مستخدم</small>
                            @endif
                            @if($data->copying_part==1)
                            <small class="badge badge-secondary">مطلوب تقليد</small>
                            @endif
                            @if($data->renovated_part==1)
                            <small class="badge badge-secondary">مطلوب مجدد</small>
                            @endif
                        </span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->


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

                    <h6 class="font-weight-bold mt-3">تفاصيل طلب القطعة</h6>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="selectedPairsTable">
                            <tbody>
                                <tr>
                                    <td>تاريخ الطلب</td>
                                    <td>{{$data->created_at}}</td>
                                </tr>
                                @if($data->car_model)
                                <tr>
                                    <td>موديل السيارة</td>
                                    <td>{{$data->model->car_model}}</td>
                                </tr>
                                @endif
                                @if($data->model_note)
                                <tr>
                                    <td>تفاصيل موديل السيارة</td>
                                    <td>{{$data->model_note}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>سنة التصنيع</td>
                                    <td>{{$data->pr_year}}</td>
                                </tr>
                                <tr>
                                    <td>نوع الجير</td>
                                    <td>{{$data->geer_type}}</td>
                                </tr>
                                <tr>
                                    <td>نوع الوقود</td>
                                    <td>{{$data->Fuel_type}}</td>
                                </tr>
                                <tr>
                                    <td>نوع الماتور</td>
                                    <td>{{$data->motor_type}}</td>
                                </tr>
                                <tr>
                                    <td>حجم الماتور</td>
                                    <td>{{$data->motor_size}}</td>
                                </tr>
                                <tr>
                                    <td>ملاحظات</td>
                                    <td>{{ $data->notes ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <td>المدينة</td>
                                    <td>{{$data->city_name->city_name}}</td>
                                </tr>
                                <tr>
                                    <td>العنوان</td>
                                    <td>{{ $data->location ?? '-' }}</td>
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
