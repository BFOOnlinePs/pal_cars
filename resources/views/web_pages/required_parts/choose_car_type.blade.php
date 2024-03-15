@extends('layouts.app')
@section('title')
    الإعلان عن سيارة
@endsection
@section('header_title')
    الإعلان عن سيارة
@endsection
@section('header_link')
    <a href="{{route('web_pages.cars_ads.index')}}">معرض السيارات</a>
@endsection
@section('header_title_link')
    الإعلان عن سيارة
@endsection
@section('style')
<style>
    /* body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 500px;
            margin-top: 50px;
        } */

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 30px;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            color: #007bff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            color: #333;
            font-weight: bold;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
</style>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12 mx-auto">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center"> طلب قطعة على الموقع</h3>
            <h6 class="text-center"> لطلب قطعة الرجاء اختيار نوع السيارة</h6>
            <br>
            <div class="row justify-content-center">
                @foreach ($cars as $car)
                <div class="card col-md-2 ml-3">
                    <br>
                    {{-- <h3>{{$car->id}}</h3> --}}
                    <a href="{{ auth()->check() ? route('web_pages.required_parts.add', ['id' => $car->id]) : route('login') }}">
                        <img class="card-img-top" src="{{ asset('storage/uploads/carTypeLogo/' . $car->logo) }}" width="50px" alt="">
                        <div class="card-body" align="center">
                            <p class="card-text">{{$car->car_type}}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
