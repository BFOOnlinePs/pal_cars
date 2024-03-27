<ul class="navbar-nav">
    {{-- <li class="nav-item">
        <a class="nav-link text-white text-white" data-widget="pushmenu" href="#" role="button"><i
                class="fas fa-bars"></i></a>
    </li> --}}

    {{-- <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link">الرئيسية</a>
    </li> --}}

    <li class="nav-item dropdown">
        {{-- <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" class="nav-link text-white dropdown-toggle">الحسابات</a> --}}
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" class="nav-link dropdown-toggle">الحسابات</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                {{-- <li><a href="#" class="dropdown-item">شجرة الحسابات</a></li> --}}
                <li><a href="{{route('dashboard.users.index')}}" class="dropdown-item">المستخدمين</a></li>
                {{-- <li><a href="" class="dropdown-item">الموردين</a></li> --}}
                {{-- <li><a href="" class="dropdown-item">الزبائن</a></li> --}}
                {{-- <li><a href="#" class="dropdown-item">النقدية</a></li> --}}
                {{-- <li><a href="#" class="dropdown-item">البنوك</a></li> --}}
            </ul>
    </li>

    {{-- <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" class="nav-link dropdown-toggle">مبيعات</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
        </ul>
    </li>

    <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" class="nav-link dropdown-toggle">مشتريات</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" class="nav-link dropdown-toggle">سندات</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" class="nav-link dropdown-toggle">الأصناف</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" class="nav-link dropdown-toggle">الانتاج</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" class="nav-link dropdown-toggle">الموارد البشرية</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
           aria-expanded="false" class="nav-link dropdown-toggle">التقارير</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
        </ul>
    </li> --}}

    <li class="nav-item">
        <a class="nav-link disabled" href="">العمليات</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard.cars_ads.index')}}">إعلانات السيارات</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard.parts_ads.index')}}">إعلانات القطع</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard.accident_announcements.index')}}">تبليغات الحوادث</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="">التقارير والإحصائيات</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard.suggestions')}}">اقتراحات الزوار</a>
    </li>

    <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="{{route('dashboard.settings.index')}}" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" class="nav-link dropdown-toggle">الإعدادات</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            {{-- <a href="{{route('dashboard.settings.cities.index')}}">test</a> --}}
            <li><a href="{{route('dashboard.settings.cities.index')}}" class="dropdown-item">المدن</a></li>
            <li><a href="{{route('dashboard.settings.cars_type.index')}}" class="dropdown-item">أنواع السيارات</a></li>
            <li><a href="{{route('dashboard.settings.terms_of_use.index')}}" class="dropdown-item">شروط الاستخدام</a></li>
            <li><a href="{{route('dashboard.settings.cars_colors.index')}}" class="dropdown-item">ألوان السيارات</a></li>
            <li><a href="" class="dropdown-item">حالات متابعة الحوادث</a></li>
        </ul>
    </li>
</ul>
