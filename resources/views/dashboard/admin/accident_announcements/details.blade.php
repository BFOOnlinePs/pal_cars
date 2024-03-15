@extends('layouts.app')
@section('title')
    تفاصيل الحادث
@endsection
@section('header_title')
    تفاصيل الحادث
@endsection
@section('header_link')
    <a href="{{route('dashboard.accident_announcements.index')}}">تبليغات الحوادث</a>
@endsection
@section('header_title_link')
    تفاصيل الحادث
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


{{-- <div class="card"> --}}

    {{-- <div class="card-body"> --}}

        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-warning"><i class="fa fa-calendar"></i></span>

                                    <div class="info-box-content">
                                    <span class="info-box-text">تاريخ الإضافة</span>
                                    <span class="info-box-number">{{$data->created_at}}</span>
                                    </div>

                                </div>
                            </div>

                            <h6 class="font-weight-bold mt-3">تفاصيل الحادث</h6>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="selectedPairsTable">
                                    <tbody>
                                        <tr>
                                            <td>أُضيف بواسطة</td>
                                            <td>{{$data->visitor->name ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td>اسم السائق</td>
                                            <td>{{$data->driver_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>رقم الهوية</td>
                                            <td>{{$data->id_number}}</td>
                                        </tr>
                                        <tr>
                                            <td>رقم الرخصة</td>
                                            <td>{{$data->license_id}}</td>
                                        </tr>
                                        <tr>
                                            <td>رقم التأمين</td>
                                            <td>{{$data->Insurance_id}}</td>
                                        </tr>
                                        <tr>
                                            <td>رقم السيارة</td>
                                            <td>{{$data->car_number}}</td>
                                        </tr>
                                        <tr>
                                            <td>وصف الحادث</td>
                                            <td>{{$data->accident_desc}}</td>
                                        </tr>
                                        <tr>
                                            <td>مكان الحادث</td>
                                            <td>{{$data->accident_location}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}

{{-- </div> --}}



@endsection

@section('script')

@endsection
