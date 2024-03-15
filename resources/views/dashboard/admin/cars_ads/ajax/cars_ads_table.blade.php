<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>صورة</th>
            <th>نوع السيارة</th>
            <th>سنة التصنيع</th>
            <th>السعر</th>
            <th>اسم المُعلن</th>
            <th>رقم المُعلن</th>
            <th class="text-nowrap">تاريخ الإضافة</th>
            <th>حالة الإعلان</th>
            <th>مدة الإعلان</th>
            <th>متبقي على الانهاء </th>
            <th colspan="3">العمليات</th>
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
                    @if ($key->pic_1 && file_exists(public_path('storage/uploads/carExpoPics/' . $key->pic_1)))
                        <img src="{{ asset('storage/uploads/carExpoPics/' . $key->pic_1) }}" width="50px" alt="Photo">
                    @else
                        <img src="{{ asset('storage/uploads/systemPics/noImage.png') }}" width="50px" alt="Photo">
                    @endif
                </td>
                <td class="text-nowrap">
                    <img src="{{ asset('storage/uploads/carTypeLogo/' . $key->carType->logo) }}" alt="Logo" width="30">
                    {{$key->carType->car_type}}
                </td>
                <td>{{$key->car_model_year}}</td>
                <td>{{$key->price}} ₪</td>
                <td>{{$key->visitor_name}}</td>
                <td>{{$key->visitor_mobile}}</td>
                <td>{{$key->created_at->format('Y-m-d')}}</td>

                @switch($key->ads_status)
                @case(0)
                <td><span class="badge bg-danger">بانتظار موافقة النشر</span></td>
                @break
                @case(1)
                <td><span class="badge bg-success">موافق عليه</span></td>
                @break
                @case(2)
                <td><span class="badge bg-warning">ملغي</span></td>
                @break
                @endswitch

                <td>{{$key->ads_days}} يوم</td>

                @if($key->end_date != null)
                    @if($key->ads_status==1)
                        @if(\Carbon\Carbon::parse($key->end_date)->isToday() || \Carbon\Carbon::parse($key->end_date)->isFuture())
                        <td class="text-danger">{{\Carbon\Carbon::parse($key->end_date)->diffInDays(\Carbon\Carbon::now())}} يوم</td>
                        @else
                        <td class="text-danger">مُنتهي</td>
                        @endif
                    @elseif ($key->ads_status==2)
                    <td>بانتظار إعادة النشر</td>
                    @endif
                @else
                <td>بانتظار النشر</td>
                @endif

                <td><a href="{{ route('web_pages.cars_ads.details', ['id' => $key->id]) }}" class="btn btn-sm btn-success text-white"><i class="fas fa-search"></i></a></td>
                @if($key->ads_status==0)
                <td><button class="btn btn-sm btn-info text-white" onclick="post_adv({{$key->id}})">نشر</td>
                @elseif ($key->ads_status==1)
                <td><button class="btn btn-sm btn-info text-white" onclick="un_post_adv({{$key->id}})">إلغاء نشر</td>
                @elseif ($key->ads_status==2)
                <td><button class="btn btn-sm btn-info text-white" onclick="re_post_adv({{$key->id}})">إعادة نشر</td>
                @endif
                <td><button class="btn btn-sm btn-danger text-white" onclick="delete_adv({{$key->id}})"><i class="fas fa-trash"></i></button></td>
            </tr>
        @endforeach
        @endif

        </tbody>
    </table>
</div>
