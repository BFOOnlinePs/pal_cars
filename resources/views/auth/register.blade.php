@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-secondary">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" align="center">

                            <img src="{{ asset('storage/uploads/systemPics/palcars.jpg') }}" width="200"> <br>

                            <h3 align=" ">التسجيل في الموقع</h3>

                            <p align=" ">اهلا بك عزيزي الزائر || للتسجيل في الموقع يرجى ملئ الحقول ادناه والضغط على زر التسجيل</p>

                            <br>

                            <h3 align="center">شروط الاستخدام</h3>

                            <p align="right" dir="rtl"></p>

                            <ul style="text-align:right !important ; ">
                                @foreach($terms as $line)
                                    <li><span dir="rtl"> </span>{{$line}}</li>
                                @endforeach
                            </ul>
                            &nbsp;<p></p>

                        </div>

                        <div class="col-md-6">
                            <form method="POST" action="{{ route('register') }}">

                                @csrf

                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label">اسم الشركة/المحل/الزبون <span class="text-danger">*</span></label>

                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <label for="user_phone1" class="col-md-4 col-form-label text-md-end">رقم المحمول <span class="text-danger">*</span></label>

                                    <div class="col-md-8">
                                        <input id="user_phone1" type="tel" class="form-control @error('user_phone1') is-invalid @enderror" name="user_phone1" required pattern="[0-9]{10}">

                                        @error('user_phone1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <label for="user_phone2" class="col-md-4 col-form-label text-md-end">جوال 2</label>

                                    <div class="col-md-8">
                                        <input id="user_phone2" type="user_phone2" class="form-control" name="user_phone2">
                                    </div>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">البريد الإلكتروني</label>

                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">كلمة المرور <span class="text-danger">*</span></label>

                                    <div class="col-md-8">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">تأكيد كلمة المرور <span class="text-danger">*</span></label>

                                    <div class="col-md-8">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <hr>


                                <div class="row mb-3">
                                    <label for="user_phone1" class="col-md-4 col-form-label text-md-end">المدينة / المنطقة <span class="text-danger">*</span></label>

                                    <div class="col-md-8">

                                        <select name="user_city" class="form-control select2" style="width: 100%;">
                                            @foreach ($data as $city)
                                            <option value="{{$city->id}}">{{$city->city_name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <label for="user_address" class="col-md-4 col-form-label text-md-end">العنوان الكامل <span class="text-danger">*</span></label>

                                    <div class="col-md-8">
                                        <textarea class="form-control" rows="3" id="user_address" name="user_address" required></textarea>
                                    </div>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <label for="user_phone1" class="col-md-4 col-form-label text-md-end">هل أنت <span class="text-danger">*</span></label>

                                    <div class="form-group">
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" name="user_role" value='["14"]'>
                                        <label class="form-check-label">صاحب كراج</label>
                                        </div>
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" name="user_role" value='["13"]'>
                                        <label class="form-check-label">محل قطع سيارات</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="user_role" value='["15"]'>
                                            <label class="form-check-label">صاحب ونش</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="user_role" value='["8"]'>
                                            <label class="form-check-label">شركة تأمين</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="user_role" value='["16"]'>
                                            <label class="form-check-label">زبون</label>
                                        </div>

                                    </div>

                                </div>

                                <hr>



                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="accept" name="terms_of_use" required>
                                    <label class="form-check-label" for="accept">أوافق على شروط الاستخدام</label>
                                </div>

                                <br>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-info">
                                            تسجيل
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

function test(){
    console.log($('#testForm').serialize());
}

</script>
@endsection
