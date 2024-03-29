@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">تسجيل الدخول</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">رقم الهاتف</label>

                            <div class="col-md-6">
                                <input id="user_phone1" type="text" placeholder="0599999999" class="form-control @error('user_phone1') is-invalid @enderror" name="user_phone1" required  autofocus>

                                @error('user_phone1')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">كلمة المرور</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        تذكر بيانات الدخول
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    تسجيل الدخول
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        نسيت كلمة المرور؟
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="mt-2">
                            <div class="div p-1 ">
                                <button onclick="login('1234567890','123456789')" type="button" class="btn btn-info form-control">أدمن</button>
                            </div>
                            <div class="div p-1">
                                <button onclick="login('1111111111','123456789')" type="button" class="btn btn-info form-control">شركة التأمين</button>
                            </div>
                            <div class="div p-1">
                                <button onclick="login('2222222222','123456789')" type="button" class="btn btn-info form-control">محل قطع سيارات</button>
                            </div>
                            <div class="div p-1">
                                <button onclick="login('3333333333','123456789')" type="button" class="btn btn-info form-control">كراج</button>
                            </div>
                            <div class="div p-1">
                                <button onclick="login('abdelmajeed@jawwal.ps','123456789')" type="button" class="btn btn-info form-control">مخمن</button></button>
                            </div>

                            <div class="div p-1">
                                <button onclick="login('4444444444','123456789')" type="button" class="btn btn-info form-control">ونش</button>
                            </div>
                            <div class="div p-1">
                                <button onclick="login('0000000000','123456789')" type="button" class="btn btn-info form-control">زائر</button>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-4 mt-3 offset-md-4 text-center">
                                <a href="{{route('register')}}">التسجيل في الموقع</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function login(username,password) {
        document.getElementById('user_phone1').value = username;
        document.getElementById('password').value = password;
    }
</script>
@endsection
