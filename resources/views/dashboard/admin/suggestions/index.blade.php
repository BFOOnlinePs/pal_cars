@extends('dashboard.layouts.app')
@section('title')
    اقتراحات الزوار
@endsection
@section('header_title')
    اقتراحات الزوار
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
    اقتراحات الزوار
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

    .card:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .blue-circle {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        color: white;
        font-size: 40px;
    }

    .vertical-hr {
        border-left: 1px solid #ccc;
    }

    p{
        margin-top: 10px;
    }
</style>
@endsection
@section('content')

<div class="row">
    @foreach ($data as $suggestion)
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Column 1 (Left) -->

                    <!-- Column 3 (Right) -->
                    <div class="col-md-1 col-3">
                        <div class="text-center">
                            <div class="blue-circle bg-info">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2 (Center) -->
                    <div class="col-md-3 col-9">
                        <div class="">
                            <h6 class="card-text">الاسم الكامل: {{$suggestion->from_name}}</h6>
                            <h6 class="card-text">معلومات التواصل: {{$suggestion->tel}}</h6>
                        </div>
                    </div>

                    <div class="vertical-hr d-md-block d-none"></div>

                    <div class="col-md-7 col-12">
                        <!-- Content for the left column -->
                        <p>{{$suggestion->content}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
