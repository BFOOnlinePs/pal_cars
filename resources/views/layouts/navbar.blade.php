{{-- <nav class="main-header navbar navbar-expand-md navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link text-white">الرئيسية</a>
        </li>
        <li class="pt-2 text-success">
            <span>شركة جيلانكو للتجارة والصناعة</span>
        </li>
    </ul>


    </ul>
    <div class="mt-1">
        {{ \Illuminate\Support\Facades\Auth::user()->name }}
        <a class="text-danger" style="font-size: 12px" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">( تسجيل الخروج )</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>

    </div>
</nav> --}}

<nav class="main-header navbar navbar-light navbar-expand-md" style="
  padding-top: 0px;
  padding-bottom: 10px;
  border-bottom: 1px solid #4950571f;
  /* color: rgb(223 14 14 / 50%); */">


<div class="mt-3">
    <a class="btn" href="{{ route('web_app_home') }}"><h3>Pal Cars</h3></a>
    {{-- <h3>Pal Cars</h3> --}}
</div>
<div class="container mt-2">
    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <div class="row ms-auto" style="">

            @if (auth()->check())
            <div class="col-10" style="
                background-color: #ffc107;
                border-radius: 10px;
                /* border-bottom: 1px solid #a2a2a736; */">

                {{-- <ul class="navbar-nav float-none float-md-end" style="color: red;">
                      <li class="nav-item" style="color: red !important;"><a class="nav-link active" href="#">First Item</a></li>
                      <li class="nav-item"><a class="nav-link" href="#" style="color: rgba(0,0,0,.5);">Second Item</a></li>
                      <li class="nav-item"><a class="nav-link" href="#">Third Item</a></li>
                </ul> --}}
                @if(in_array('1', json_decode(auth()->user()->user_role, true)))
                @include('dashboard.layouts.navbars.admin_navbar')
                @endif

                @if(in_array('8', json_decode(auth()->user()->user_role, true)))
                @include('dashboard.layouts.navbars.insurance_company_navbar')
                @endif

                @if(in_array('13', json_decode(auth()->user()->user_role, true)))
                @include('dashboard.layouts.navbars.part_store_navbar')
                @endif

                @if(in_array('16', json_decode(auth()->user()->user_role, true)))
                @include('dashboard.layouts.navbars.visitor_navbar')
                @endif

                @if(in_array('14', json_decode(auth()->user()->user_role, true)))
                @include('dashboard.layouts.navbars.garage_navbar')
                @endif

                @if(in_array('12', json_decode(auth()->user()->user_role, true)))
                @include('dashboard.layouts.navbars.appraiser_navbar')
                @endif

                @if(in_array('15', json_decode(auth()->user()->user_role, true)))
                @include('dashboard.layouts.navbars.tow_truck_owner_navbar')
                @endif
            </div>
            @endif

            <div class="col-12 order-md-first" style="/* background-color: #ffc107; */">
                <ul class="navbar-nav float-none float-md-end">
                    <li class="nav-item">
                        <a href="{{ route('web_app_home') }}" class="nav-link">الرئيسية</a>
                    </li>
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
                </ul>
            </div>
        </div>
    </div>

</div>
<div class="mt-2">
    @if (auth()->check())
        <span style="font-size: 15px">أهلاً بك <span class="text-info">{{auth()->user()->name}}</span></span>

        <a class="text-danger" style="font-size: 12px" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">( تسجيل الخروج )</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    @else
        <a class="btn btn-sm btn-success" href="{{route("login")}}">تسجيل دخول</a>
        أو
        <a class="btn btn-sm btn-info" href="{{ route('register') }}">التسجيل</a>
    @endif
</div>








    {{-- <a class="navbar-brand" href="#" style="
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
    </div> --}}


</nav>
