@extends('layouts.app')
@section('title')
    طلبات القطع بواسطتي
@endsection
@section('header_title')
    طلبات القطع بواسطتي
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
    طلبات القطع بواسطتي
@endsection
@section('style')
<style>
    .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            /* padding: 30px; */
        }
</style>
@endsection
@section('content')


<div class="row">
    <div class="col-md-10 mx-auto">
        <a class="btn btn-danger mb-2 mr-3" href="{{route('web_pages.required_parts.disable_requests')}}">تعطيل جميع الطلبات</a>
    </div>
</div>


<div class="row">

    <div class="col-md-10 mx-auto">

        {{-- <div class="card"> --}}
            {{-- <div class="card-body"> --}}
                <div class="row">
                    @foreach ($data as $key)
                    {{-- <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <br>
                                        <br>
                                        <img src="{{ asset('storage/uploads/carTypeLogo/' . $key->car->logo) }}" class="img-fluid" alt="image">
                                        <br>
                                        <p class="card-text">{{$key->car->car_type}}</p>
                                        <a href="{{route('web_pages.required_parts.request_offers', ['id' => $key->id])}}" class="btn btn-success btn-sm col-md-12">عروض الأسعار</a>
                                        <br>
                                        <br>
                                        <a href="#" class="btn btn-danger btn-sm col-md-12">تعطيل الطلب</a>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body text-center">
                                            <table class="table table-bordered" dir="rtl">
                                                <tbody>
                                                    <tr>
                                                        <td class="bg-info">القطعة المطلوبة</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{$key->part_request}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-info">تاريخ الطلب</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{$key->created_at}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-info">عدد العروض الواردة</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h1 class="text-danger">{{$key->offers_number}}</h1>
                                                            <p>عرض سعر</p>
                                                            {{$key->prices_range}}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-3" align="center"
                                    @if($key->request_status==0)
                                    style="background-color: #dc3545; border-radius: 10px;"
                                    @endif>
                                        <br>
                                        <br>

                                        <img src="{{ asset('storage/uploads/carTypeLogo/' . $key->car->logo) }}" width="90%" alt="image">

                                        <br>

                                        <p class="card-text">{{$key->car->car_type}}</p>


                                        <a href="{{route('web_pages.required_parts.request_offers', ['id' => $key->id])}}" class="btn btn-success btn-sm col-md-12"> عروض الاسعار </a>

                                        <br>
                                        <br>
                                        @if($key->request_status==1)
                                            <a href="{{route('web_pages.required_parts.disable_request', ['id' => $key->id])}}" class="btn btn-danger btn-sm col-md-12"> تعطيل الطلب </a>
                                        @elseif ($key->request_status==0)
                                            <a href="{{route('web_pages.required_parts.enable_request', ['id' => $key->id])}}" class="btn btn-info btn-sm col-md-12"> إلغاء تعطيل الطلب </a>
                                        @endif
                                    </div>

                                    <div class="col-md-9 ">
                                        <div class="card-body" align="center">
                                            {{-- <table width="100%" border="1" dir="rtl"> --}}
                                            <table width="100%" class="table-bordered" dir="rtl">
                                                <tbody>
                                                    <tr>
                                                        <td class="bg-info">القطعة المطلوبة</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="" align="center">{{$key->part_request}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-info">تاريخ الطلب </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="center"><span>{{$key->created_at}}</span></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="bg-info">عدد العروض الواردة</td>
                                                    </tr>

                                                    <tr>
                                                        <td align="center"><h1 class="text-danger">{{$key->offers_number}}</h1><p align="center">عرض سعر </p>

                                                            {{$key->prices_range}}
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach


                </div>
            {{-- </div> --}}
        {{-- </div> --}}



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
