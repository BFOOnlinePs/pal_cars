<ul class="navbar-nav">

    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard.insurance_company.company_information.index', ['id' => auth()->user()->id])}}">البيانات الشخصية</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">طلب قطعة</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">المطلوب بواسطتي</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">طلبات عامة</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard.insurance_company.accidents.index', ['id' => auth()->user()->id])}}">قائمة تبليغات الحوادث</a>
    </li>
</ul>
