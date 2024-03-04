@extends('layouts.app')
@section('title')
    معرض القطع
@endsection
@section('header_title')
    تفاصيل القطعة:  {{$data->part_name}}
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
<a href="{{route('web_pages.part_expo.index')}}">معرض القطع</a>
@endsection
@section('content')

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
            <h3 class="text-center">{{$data->part_name}}</h3>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-7 order-2 order-md-1">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="info-box bg-gradient-info">
                            <span class="info-box-icon"><i class="fas fa-dollar-sign"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">السعر</span>
                              <span class="info-box-number">{{$data->part_price}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-5">
                        <div class="info-box bg-gradient-danger">
                            <span class="info-box-icon"><i class="fa fa-car"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">نوع السيارة</span>
                              <span class="info-box-number">{{$data->car->car_type}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="info-box bg-gradient-success">
                            <span class="info-box-icon"><i class="fa fa-question"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text">حالة القطعة</span>
                              <span class="info-box-number">{{$data->part_status}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h4>الصور - انقر على الصور للاستعراض</h4>
                        <div>

                            <div class="card">
                                <div class="card-body">



                                    @if ($data->part_main_pic && file_exists(public_path('storage/uploads/partExpoPics/' . $data->part_main_pic)))
                                        <div class="row">
                                            <div class="col-4 mb-2">
                                                <img id="main_pic" src="{{ asset('storage/uploads/partExpoPics/' . $data->part_main_pic) }}" alt="Image" style="cursor: pointer;" onclick="openPic('{{$data->part_main_pic}}')" class="img-thumbnail">
                                            </div>
                                            @if(!$images->isEmpty())
                                            @foreach ($images as $image)
                                            <div class="col-4 mb-2">
                                                <img src="{{ asset('storage/uploads/partExpoPics/' . $image->image_path) }}" alt="Image" style="cursor: pointer;" onclick="openPic('{{$image->image_path}}')" class="img-thumbnail">
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    @else
                                        <img src="{{ asset('storage/uploads/systemPics/noImage.png') }}" width="100%" height="100%" alt="Photo">
                                    @endif

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                </div>
                <div class="col-12 col-md-12 col-lg-5 order-1 order-md-2">
                <h3>تفاصيل القطعة</h3>
                {{-- <br> --}}
                <div class="text-muted">
                    <p class="text-sm">تاريخ النشر
                    <b class="d-block">{{$data->insert_date}}</b>
                    </p>

                    <p class="text-sm">نشر بواسطة
                    {{-- <b class="d-block">{{$data->user->name}}</b> --}}
                    <b class="d-block">Tony Chicken</b>
                    </p>

                    <p class="text-sm">تفاصيل القطعة
                        <b class="d-block">{{$data->part_detail}}</b>
                        {{-- <b class="d-block">Tony Chicken</b> --}}
                    </p>

                    <p class="text-sm">معلومات التواصل
                        {{-- <b class="d-block">{{$data->user->user_phone1}} , {{$data->user->user_phone2}}</b> --}}
                        <b class="d-block">Tony Chicken</b>
                    </p>

                    @if(!$part_models_years->isEmpty())
                    <p class="text-sm">الموديلات المتوافقة مع القطعة
                        <div class="table-responsive">
                            <table class="table table-bordered" id="selectedPairsTable">
                                <thead>
                                    <tr>
                                        <th style="display:none;"></th>
                                        <th>اسم الموديل</th>
                                        <th>السنوات المتوافقة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($part_models_years as $models)
                                    <tr>
                                        <td>{{$models->accepted_model->car_model}}</td>
                                        <td>{{$models->part_model_years}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </p>
                    @endif

                </div>


                </div>
            </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    @include('web_pages.part_expo.modals.pic_modal')
</div>

@endsection
@section('script')
<script>
    function openPic(data){
        link= "storage/uploads/partExpoPics/"
        var assetPath = '{{ asset('') }}'+link+data;
        var x = `<img width="100%" height="100%" src="${assetPath}" alt="Car Model">`;
        $('#modal_body').html(x);
        $('#pic_modal').modal('show');
    }
</script>
@endsection
