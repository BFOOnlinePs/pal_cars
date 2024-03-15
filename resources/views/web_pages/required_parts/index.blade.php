@extends('layouts.app')
@section('title')
    القطع المطلوبة
@endsection
@section('header_title')
    القطع المطلوبة
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
    القطع المطلوبة
@endsection
@section('content')


<div class="card">

    <div class="card-body">

        <div class="row">
            <div class="col-md-12" id="part_expo_table">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>القطعة المطلوبة</th>
                            <th>نوع السيارة</th>
                            <th>سنة الإنتاج</th>
                            <th>الجير</th>
                            <th>الماتور</th>
                            <th>المنطقة</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($data->isEmpty())
                            <tr>
                                <td colspan="9" class="text-center"><span>لا توجد بيانات</span></td>
                            </tr>
                        @else
                        @foreach ($data as $key)
                            <tr>
                                <td><button class="btn btn-danger">غير مهتم</button></td>
                                <td>{{$key->part_request}}</td>
                                <td class="text-nowrap">
                                    <img src="{{ asset('storage/uploads/carTypeLogo/' . $key->car->logo) }}" alt="Logo" width="30">
                                    {{$key->car->car_type}}
                                </td>
                                <td>{{$key->pr_year}}</td>
                                <td>{{$key->geer_type}}</td>
                                <td>{{$key->motor_type}}</td>
                                <td>{{$key->city}}</td>
                                <td><a href="{{ route('web_pages.part_expo.details', ['id' => $key->id]) }}" class="btn btn-sm btn-success text-white"><i class="fas fa-search"></i></a></td>
                                <td><a href="{{ route('web_pages.part_expo.details', ['id' => $key->id]) }}" class="btn btn-sm btn-success text-white">تقديم عرض</a></td>
                            </tr>
                        @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>



@endsection

@section('script')

@endsection
