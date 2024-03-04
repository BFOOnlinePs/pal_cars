<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>صورة</th>
            <th>اسم القطعة</th>
            <th>نوع السيارة</th>
            {{-- <th>الموديلات المتوافقة</th> --}}
            {{-- <th>سنة التصنيع</th> --}}
            <th>معلومات القطعة</th>
            <th>الحالة</th>
            <th>السعر</th>
            <th class="text-nowrap">تاريخ الإضافة</th>
            {{-- <th>بواسطة</th> --}}
            {{-- <th colspan="2">محمول</th> --}}

            <th>عرض</th>
            @if(auth()->check() && auth()->user()->user_role == '["1"]')
            <th>حذف</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @if ($data->isEmpty())
            <tr>
                <td colspan="14" class="text-center"><span>لا توجد بيانات</span></td>
            </tr>
        @else
        @foreach ($data as $key)
            <tr>
                <td>
                    @if ($key->part_main_pic && file_exists(public_path('storage/uploads/partExpoPics/' . $key->part_main_pic)))
                        <img src="{{ asset('storage/uploads/partExpoPics/' . $key->part_main_pic) }}" width="50px" alt="Photo">
                    @else
                        <img src="{{ asset('storage/uploads/systemPics/noImage.png') }}" width="50px" alt="Photo">
                    @endif
                </td>
                <td>{{$key->part_name}}</td>
                <td class="text-nowrap">

                    <img src="{{ asset('storage/uploads/carTypeLogo/' . $key->car->logo) }}" alt="Logo" width="30">
                    {{$key->car->car_type}}
                </td>
                {{-- <td>{{$key->part_accept_models}}</td> --}}
                {{-- <td>{{$key->part_car_year}}</td> --}}
                <td>{{$key->part_detail}}</td>
                @switch($key->part_status)
                @case('مستخدم')
                <td><span class="badge bg-danger">{{$key->part_status}}</span></td>
                @break
                @case('جديد')
                <td><span class="badge bg-success">{{$key->part_status}}</span></td>
                @break
                @case('تقليد')
                <td><span class="badge bg-warning">{{$key->part_status}}</span></td>
                @break
                @case('مجدد')
                <td><span class="badge bg-info">{{$key->part_status}}</span></td>
                @break
                @endswitch
                <td>{{$key->part_price}}</td>
                <td>{{ date('Y-m-d', strtotime($key->insert_date)) }}</td>
                {{-- @if($key->user) --}}
                {{-- <td>{{$key->user->name}}</td> --}}
                {{-- <td>{{$key->user->user_phone1}}</td> --}}
                {{-- @if($key->user->user_phone2)
                <td>-</td>
                @endif
                <td>{{$key->user->user_phone2}}</td>
                @else --}}
                {{-- <td>الاسم</td>
                <td>هاتف 1</td>
                <td>هاتف 2</td> --}}
                {{-- @endif --}}

                <td><a href="{{ route('web_pages.part_expo.details', ['id' => $key->id]) }}" class="btn btn-sm btn-success text-white"><i class="fas fa-search"></i></a></td>
                @if(auth()->check() && auth()->user()->user_role == '["1"]')
                <td><button class="btn btn-sm btn-danger text-white" onclick="delete_car_part({{$key->id}})"><i class="fas fa-trash"></i></button></td>
                @endif
            </tr>
        @endforeach
        @endif

        </tbody>
    </table>
</div>
