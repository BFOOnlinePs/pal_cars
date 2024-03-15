@extends('layouts.app')
@section('title')
    الإبلاغ عن حادث
@endsection
@section('header_title')
    الإبلاغ عن حادث
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
    الإبلاغ عن حادث
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

        .card-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            color: #007bff;
        }


</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="callout callout-info" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;">
            <h5><i class="fas fa-info"></i> ملاحظة : </h5>
            يمكنك من خلال النموذج التالي الإبلاغ عن حوادث السير
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card-body">
            <form id="car_accident_form" action="{{ route('web_pages.accidents.create') }}" method="post" enctype="multipart/form-data">
            {{-- <form id="car_adv_form" > --}}
                @csrf
                <input type="text" hidden name="user_id" value="{{auth()->check() ? auth()->user()->id : null}}">
                <h3 class="text-center">الإبلاغ عن حادث سير</h3>
                {{-- <hr> --}}
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">شركة التأمين <span class="text-danger">*</span></label>
                            <select required id="Insurance_company_id" name="Insurance_company_id" class="form-control select2" style="width: 100%;">
                                <option value="" disabled selected>--اختر شركة--</option>
                                @foreach ($insurance_companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم السائق <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="driver_name" name="driver_name" required>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">رقم الهوية <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="id_number" name="id_number" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">رقم الرخصة <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="license_id" name="license_id" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">رقم لوحة السيارة <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="car_number" name="car_number" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">رقم بوليصة التامين <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="Insurance_id" name="Insurance_id" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">تفاصيل الحادث <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="accident_desc" id="accident_desc" rows="5" required></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">موقع الحادث <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="accident_location" id="accident_location" rows="5" required></textarea>
                        </div>
                    </div>
                </div>
                {{-- <button type="submit" class="btn btn-success">إضافة الإعلان</button> --}}
                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> الإبلاغ عن حادث سير</button>
            </form>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('script')

@endsection
