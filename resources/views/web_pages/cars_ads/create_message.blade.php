@extends('layouts.app')
{{-- @section('title')
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
@endsection --}}
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
    <div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-body">
            <div class="container text-center mt-3 mb-5">
                <div class="display-1 text-success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="lead text-success">
                    {{session('success')}}
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
