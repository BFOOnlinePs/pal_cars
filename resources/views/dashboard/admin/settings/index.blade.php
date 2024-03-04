@extends('dashboard.layouts.app')
@section('title')
    الإعدادات
@endsection
@section('header_title')
    الإعدادات
@endsection
@section('header_link')
    الإعدادات
@endsection
@section('header_title_link')
    {{-- المدن --}}
@endsection
@section('content')
<div class="row">

    <div class="col-lg-3 col-6">

        <div class="small-box bg-info">
            <div class="inner">
                <h3>المدن</h3>
                <p>المدن</p>
            </div>
            <div class="icon">
                <i class="fa fa-city"></i>
            </div>
            <a href="{{ route('dashboard.settings.cities.index') }}" class="small-box-footer">المزيد <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-success">
            <div class="inner">
                <h3>أنواع السيارات</h3>
                <p>أنواع السيارات</p>
            </div>
            <div class="icon">
                <i class="fa fa-car"></i>
            </div>
            <a href="{{ route('dashboard.settings.cars_type.index') }}" class="small-box-footer">المزيد <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-danger">
            <div class="inner">
                <h3>شروط الاستخدام</h3>
                <p>شروط الاستخدام</p>
            </div>
            <div class="icon">
                <i class="fa fa-exclamation"></i>
            </div>
            <a href="{{ route('dashboard.settings.terms_of_use.index') }}" class="small-box-footer">المزيد <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- ./col -->
    {{-- <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>53<sup style="font-size: 20px">%</sup></h3>

          <p>Bounce Rate</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div> --}}
    <!-- ./col -->
    {{-- <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>44</h3>

          <p>User Registrations</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div> --}}
    <!-- ./col -->
    {{-- <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>65</h3>

          <p>Unique Visitors</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div> --}}
    <!-- ./col -->
  </div>


@endsection
@section('script')

@endsection
