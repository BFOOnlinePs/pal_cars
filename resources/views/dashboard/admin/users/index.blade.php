@extends('dashboard.layouts.app')
@section('title')
    المستخدمين
@endsection
@section('header_title')
    المستخدمين
@endsection
@section('header_link')
    الرئيسية
@endsection
@section('header_title_link')
    المستخدمين
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ route('dashboard.users.add_form') }}" class="btn btn-dark">اضافة مستخدم جديد</a>
        </div>
        {{-- <div class="col-md-3 col-sm-6 col-12">
            <a href="" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">موظف المشتريات</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">أمين المستودع</span>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">سكرتيريا</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">الموردين</span>
                    </div>
                </div>

            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">شركات الشحن</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">شركات التخليص</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">شركات النقل المحلي</span>
                    </div>
                </div>
            </a>
        </div> --}}
        <div class="col-md-3 col-sm-6 col-12">
            <a href="{{ route('dashboard.users.admins.index') }}" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    {{-- <span class="info-box-icon bg-info"><i class="far fa-user"></i></span> --}}
                    <span class="info-box-icon bg-info"><i class="fas fa-user-shield"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">المسؤولين</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="{{ route('dashboard.users.insurance_companies.index') }}" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    <span class="info-box-icon bg-success"><i class="fas fa-building"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">شركات التأمين</span>
                    </div>
                </div>
            </a>
        </div>
        {{-- <div class="col-md-3 col-sm-6 col-12">
            <a href="" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">زبائن</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">الموظفين</span>
                    </div>
                </div>
            </a>
        </div> --}}
        <div class="col-md-3 col-sm-6 col-12">
            <a href="{{ route('dashboard.users.appraiser.index') }}" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    <span class="info-box-icon bg-warning"><i class="far fa-eye"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">المخمنين</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="{{ route('dashboard.users.car_part_store.index') }}" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    <span class="info-box-icon bg-danger"><i class="fa fa-car"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">محلات قطع السيارات</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="{{ route('dashboard.users.garage.index') }}" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    <span class="info-box-icon bg-warning"><i class="fa fa-wrench"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">كراجات السيارات</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="{{ route('dashboard.users.tow_truck_owner.index') }}" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    <span class="info-box-icon bg-danger"><i class="fa fa-truck"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">أصحاب الونشات</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <a href="{{ route('dashboard.users.visitor.index') }}" style="text-decoration: none" class="text-dark">
                <div class="info-box shadow-sm">
                    <span class="info-box-icon bg-info"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">الزوار</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection()
