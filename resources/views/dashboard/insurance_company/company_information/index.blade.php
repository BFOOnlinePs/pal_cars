@extends('layouts.app')
@section('title')
    بيانات الشركة
@endsection
@section('header_title')
    بيانات الشركة
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
    بيانات الشركة
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

@if (Session::has('success'))
<div class="row">
    <div class="col-md-8 mx-auto">
        <div id="successAlert" class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    </div>
</div>
@endif

@if ($errors->any())
<div class="row">
    <div class="col-md-8 mx-auto">
        <div id="errorAlert" class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="callout callout-info" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;">
            <h5><i class="fas fa-info"></i> ملاحظة : </h5>
            يمكنك من خلال النموذج التالي تعديل بيانات الشركة
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card-body">
            <form id="company_information_form" action="{{ route('dashboard.insurance_company.company_information.update') }}" method="post" enctype="multipart/form-data">
            {{-- <form id="car_adv_form" > --}}
                @csrf
                <input type="text" hidden name="user_id" value="{{auth()->user()->id}}">
                <h3 class="text-center">بيانات الشركة</h3>
                {{-- <hr> --}}
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">البريد الإلكتروني<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="email" name="email" value="{{$data->email}}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">كلمة المرور <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">رقم الجوال <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="user_phone1" name="user_phone1" value="{{$data->user_phone1}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">جوال 2 </label>
                            <input type="number" class="form-control" id="user_phone2" name="user_phone2" value="{{$data->user_phone2}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">العنوان <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="user_address" id="user_address" rows="5" required>{{$data->user_address}}</textarea>
                        </div>
                    </div>
                </div>
                {{-- <button type="submit" class="btn btn-success">إضافة الإعلان</button> --}}
                <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> تعديل بيانات الشركة</button>
            </form>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('script')
<script>
    setTimeout(function() {
        // document.getElementById('successAlert').style.display = 'none';
        var successAlert = document.getElementById('successAlert');
        if (successAlert) {
            successAlert.style.display = 'none';
        }
    }, 3000); // 5000 milliseconds = 5 seconds
    setTimeout(function() {
        var errorAlert = document.getElementById('errorAlert');
        if (errorAlert) {
            errorAlert.style.display = 'none';
        }
        // document.getElementById('errorAlert').style.display = 'none';
    }, 3000); // 5000 milliseconds = 5 seconds
</script>
@endsection
