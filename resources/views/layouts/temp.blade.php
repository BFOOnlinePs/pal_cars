<nav class="main-header navbar navbar-expand-md navbar-light">
    <div class="container">
        {{-- <a href="../../index3.html" class="navbar-brand">
            <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a> --}}
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">


            @if(auth()->check())
            <ul class="navbar-nav">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-bell" style="font-size: 25px;"></i>
                        {{-- notifications number --}}
                        @if(count($notifications) != 0)
                        <span class="badge badge-danger navbar-badge" style="font-size: 10px;margin-top: -2px;">{{count($notifications)}}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                        <span class="dropdown-item dropdown-header">الإشعارات</span>

                        @if($notifications->isEmpty())
                            {{-- هاد اللي بدي اكرره --}}
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item">
                                لا يوجد إشعارات
                            </a>
                        @else
                            @foreach ($notifications as $notif)
                                <div class="dropdown-divider"></div>

                                @if($notif->type == 'accedent')
                                    <a href="{{ route('dashboard.insurance_company.accidents.details_notification', ['id' => $notif->rec_id,'notification_id'=>$notif->id]) }}" class="dropdown-item">
                                        <i class="fas fa-exclamation-triangle text-warning"></i>  يوجد بلاغ حادث جديد
                                    </a>
                                @elseif($notif->type == 'offer')
                                    <a href="{{ route('web_pages.required_parts.offer_notification', ['id' => $notif->rec_id,'notification_id'=>$notif->id]) }}" class="dropdown-item">
                                        <i class="fas fa-tag text-info"></i> يوجد عرض سعر جديد
                                    </a>
                                @elseif ($notif->type == 'request')
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-question-circle text-success"></i> يوجد طلب قطعة جديد
                                    </a>
                                @endif

                            @endforeach
                        @endif

                    </div>
                </li>
            </ul>
            @endif


            <ul class="navbar-nav">
                {{-- <li class="nav-item">
                    <a class="nav-link text-white text-white" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('web_app_home') }}" class="nav-link">الرئيسية</a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('web_pages.required_parts.index') }}" class="nav-link">القطع المطلوبة</a>

                </li> --}}



                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="{{ route('web_pages.required_parts.index') }}" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" class="nav-link dropdown-toggle">القطع المطلوبة</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="{{ route('web_pages.required_parts.index') }}" class="dropdown-item">القطع المطلوبة</a></li>
                        <li><a href="{{ route('web_pages.required_parts.choose_car_type') }}" class="dropdown-item">الإعلان عن قطعة المطلوبة</a></li>
                        <li><a href="{{ route('web_pages.required_parts.offers_by_me') }}" class="dropdown-item">عروض بواسطتي</a></li>
                        <li><a href="{{route('web_pages.required_parts.requests_by_me')}}" class="dropdown-item">المطلوب بواسطتي</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('web_pages.part_expo.index') }}" class="nav-link">معرض القطع</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('web_pages.cars_ads.index') }}" class="nav-link">معرض السيارات</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link disabled">تخمين سيارة</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link disabled">دفتر السيارة</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('web_pages.accidents.index') }}" class="nav-link">الحوادث</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('web_pages.about_us') }}" class="nav-link">من نحن</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('web_pages.contact_us') }}" class="nav-link">اتصل بنا</a>
                </li>
                {{-- @if (auth()->check() && in_array('1', json_decode(auth()->user()->user_role, true))) --}}
                @if (auth()->check())
                <li class="nav-item">
                    {{-- <a class="btn btn-sm btn-warning mt-2" href="{{route("dashboard.index")}}">لوحة التحكم</a> --}}
                    {{-- <a class="bg-warning nav-link rounded" href="{{route("dashboard.index")}}">لوحة التحكم</a> --}}
                    <a class="bg-warning nav-link rounded" style="cursor: pointer" onclick="toggleNavbar()">لوحة التحكم</a>
                </li>
                @endif
            </ul>


        </div>

    </div>
    <div class="mt-1">
        {{-- auth()->user()->u_role_id == 5 --}}
        @if (auth()->check())

        {{-- @if(auth()->user()->user_role == '["1"]')
        <a class="btn btn-sm btn-warning" href="{{route("dashboard.index")}}">لوحة التحكم</a>
        @endif --}}

        <span style="font-size: 15px">أهلاً بك <span class="text-info">{{auth()->user()->name}}</span></span>

        <a class="text-danger" style="font-size: 12px" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">( تسجيل الخروج )</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>



        @else
        {{-- <button  class="btn btn-sm btn-success">تسجيل دخول</button> --}}
        <a class="btn btn-sm btn-success" href="{{route("login")}}">تسجيل دخول</a>
        أو
        {{-- <button class="btn btn-sm btn-info"></button> --}}
        <a class="btn btn-sm btn-info" href="{{ route('register') }}">التسجيل</a>
        @endif

    </div>
</nav>

{{-- new one --}}
<nav class="navbar navbar-light navbar-expand-md" style="
  padding-top: 0px;
  padding-bottom: 10px;
  border-bottom: 1px solid #4950571f;
  /* color: rgb(223 14 14 / 50%); */">

    <a class="navbar-brand" href="#" style="
    width: 25%;
    height: 5%;
    /* width: 10%; */
    margin: 15px;
    text-align: center;
    /* font-weight: bold; */
    /* border-left: 10px black; */
    font-size: 25px;
    ">Pal Cars
    </a>




    <div class="col-md-8" style="/* color: red; */">

        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navcol-1" aria-expanded="false">
              <span class="visually-hidden">Toggle navigation</span>
              <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navcol-1" class="navbar-collapse collapse" style="">
            <div class="row ms-auto" style="">
                <div class="col-12" style="
                    background-color: #ffc107;
                    border-radius: 10px;
                    /* border-bottom: 1px solid #a2a2a736; */">

                    <ul class="navbar-nav float-none float-md-end" style="color: red;">
                          <li class="nav-item" style="color: red !important;"><a class="nav-link active" href="#">First Item</a></li>
                          <li class="nav-item"><a class="nav-link" href="#" style="color: rgba(0,0,0,.5);">Second Item</a></li>
                          <li class="nav-item"><a class="nav-link" href="#">Third Item</a></li>
                    </ul>
                </div>

                <div class="col-12 order-md-first" style="/* background-color: #ffc107; */">
                    <ul class="navbar-nav float-none float-md-end">
                        <li class="nav-item">
                            <a href="http://localhost/befound/pal_cars/public" class="nav-link">الرئيسية</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="http://localhost/befound/pal_cars/public/web_pages/required_parts/index" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">القطع المطلوبة</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="http://localhost/befound/pal_cars/public/web_pages/required_parts/index" class="dropdown-item">القطع المطلوبة</a></li>
                                <li><a href="http://localhost/befound/pal_cars/public/web_pages/required_parts/choose_car_type" class="dropdown-item">الإعلان عن قطعة المطلوبة</a></li>
                                <li><a href="http://localhost/befound/pal_cars/public/web_pages/required_parts/offers_by_me" class="dropdown-item">عروض بواسطتي</a></li>
                                <li><a href="http://localhost/befound/pal_cars/public/web_pages/required_parts/requests_by_me" class="dropdown-item">المطلوب بواسطتي</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/befound/pal_cars/public/web_pages/part_expo/index" class="nav-link">معرض القطع</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/befound/pal_cars/public/web_pages/cars_ads/index" class="nav-link">معرض السيارات</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/befound/pal_cars/public/home" class="nav-link disabled">تخمين سيارة</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/befound/pal_cars/public/home" class="nav-link disabled">دفتر السيارة</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/befound/pal_cars/public/web_pages/accidents/index" class="nav-link">الحوادث</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/befound/pal_cars/public/web_pages/about_us" class="nav-link">من نحن</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/befound/pal_cars/public/web_pages/contact_us" class="nav-link">اتصل بنا</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-2" style="
    text-align: left;
">
        <button class="btn btn-success">login</button>
        <button class="btn btn-success">register</button>
    </div>


</nav>
