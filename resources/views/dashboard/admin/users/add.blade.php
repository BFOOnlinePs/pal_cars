@extends('dashboard.layouts.app')
@section('title')
    إضافة مستخدم
@endsection
@section('header_title')
    إضافة مستخدم
@endsection
@section('header_link')
    <a href="{{route('dashboard.users.index')}}">المستخدمين</a>
@endsection
@section('header_title_link')
    إضافة مستخدم
@endsection
@section('content')
    <form action="{{ route('dashboard.users.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-md-12">
                                            <h5>معلومات المستخدم الاساسية</h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">الاسم الكامل</label>
                                                <input required value="{{ old('name') }}" placeholder="الاسم الكامل" name="name" class="form-control"
                                                       type="text">
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">الايميل</label>
                                                <input required value="{{ old('email') }}" name="email" placeholder="الايميل" class="form-control"
                                                       type="text">
                                                @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div hidden class="col-md-6">
                                            <div hidden class="form-group">
                                                <label for="">كلمة المرور</label>
                                                <input {{ old('password') }} placeholder="كلمة المرور" name="password" class="form-control"
                                                       type="text" value="<?php echo rand(11111,9999999) ?>">
                                                @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>رقم الهاتف الاول</label>
                                                <input required value="{{ old('user_phone1') }}" placeholder="رقم الهاتف الاول" class="form-control"
                                                       name="user_phone1" type="text">
                                                @error('user_phone1')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">رقم الهاتف الثاني</label>
                                                <input value="{{ old('user_phone2') }}" placeholder="رقم الهاتف الثاني" class="form-control"
                                                       name="user_phone2" type="text">
                                                @error('user_phone2')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">ملاحظات</label>
                                                <textarea placeholder="الملاحظات" class="form-control" name="user_notes" id="" cols="30"
                                                          rows="5">{{ old('user_notes') }}</textarea>
                                                @error('user_notes')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-md-12">
                                            <h5>معلومات المستخدم الفرعية</h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">الموقع الالكتروني</label>
                                                        <input {{ old('user_website') }} placeholder="الموقع الالكتروني" name="user_website"
                                                               class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">تصنيف المستخدم</label>
                                                        <input class="form-control" type="text" name="user_category" placeholder="تنصيف المستخدم">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">العنوان الكامل</label>
                                                        <textarea class="form-control" placeholder="العنوان الكامل" name="user_address" id="" cols="30"
                                                                  rows="3"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">الصلاحيات</label>
                                                        @foreach ($user_role as $key)
                                                            <input name="role_level[]" value="{{ $key->id }}" id="role_user_{{ $loop->index }}" type="checkbox">
                                                            <label for="role_user_{{ $loop->index }}">{{ $key->name }}</label>
                                                            <br>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <img style="width: 100px" src="{{ asset('assets/images/avatar.png') }}" alt="">
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">الصورة الشخصية</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input value="{{ old('user_photo') }}" name="user_photo"
                                                                       type="file" class="custom-file-input"
                                                                       id="exampleInputFile">
                                                                <label class="custom-file-label" for="exampleInputFile">رفع
                                                                    صورة</label>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">رفع</span>
                                                            </div>
                                                        </div>
                                                        @error('user_photo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-success btn-block"><i
                class="fa-solid fa-floppy-disk"></i> حفظ
        </button>
    </form>


@endsection()
