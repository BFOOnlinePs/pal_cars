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

<nav class="main-header navbar navbar-expand-md navbar-dark" style="z-index: 500">
    <div class="container">
        {{-- <a href="../../index3.html" class="navbar-brand">
            <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a> --}}
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse2"
            aria-controls="navbarCollapse2" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse2">



            @if(auth()->check() && in_array('1', json_decode(auth()->user()->user_role, true)))
                @include('dashboard.layouts.navbars.admin_navbar')
            @endif

            @if(auth()->check() && in_array('8', json_decode(auth()->user()->user_role, true)))
                @include('dashboard.layouts.navbars.insurance_company_navbar')
            @endif

            @if(auth()->check() && in_array('13', json_decode(auth()->user()->user_role, true)))
                @include('dashboard.layouts.navbars.part_store_navbar')
            @endif

            @if(auth()->check() && in_array('16', json_decode(auth()->user()->user_role, true)))
                @include('dashboard.layouts.navbars.visitor_navbar')
            @endif

            @if(auth()->check() && in_array('14', json_decode(auth()->user()->user_role, true)))
                @include('dashboard.layouts.navbars.garage_navbar')
            @endif

            @if(auth()->check() && in_array('12', json_decode(auth()->user()->user_role, true)))
                @include('dashboard.layouts.navbars.appraiser_navbar')
            @endif

            @if(auth()->check() && in_array('15', json_decode(auth()->user()->user_role, true)))
                @include('dashboard.layouts.navbars.tow_truck_owner_navbar')
            @endif










            {{-- <form class="form-inline ml-0 ml-md-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form> --}}
        </div>

        {{-- <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link text-white" data-toggle="dropdown" href="#">
                    <i class="fas fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">

                        <div class="media">
                            <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar"
                                class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>

                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">

                        <div class="media">
                            <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar"
                                class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>

                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">

                        <div class="media">
                            <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar"
                                class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>

                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>

            {{-- <li class="nav-item dropdown">
                <a class="nav-link text-white" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li> --}}
        {{-- </ul> --}}
    </div>
    {{-- <div class="mt-1">

        <a class="btn btn-sm btn-success" href="{{route("home")}}">الموقع</a>

        <a class="text-danger" style="font-size: 12px" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">( تسجيل الخروج )</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>

    </div> --}}
</nav>
