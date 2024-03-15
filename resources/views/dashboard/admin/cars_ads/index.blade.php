@extends('layouts.app')
@section('title')
    إعلانات السيارات
@endsection
@section('header_title')
    إعلانات السيارات
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
    إعلانات السيارات
@endsection
@section('content')


<div class="card">

    <div class="card-body">


        {{-- <form id="searchForm" action="">
            <div class="card card-info">
                <div class="card-header">
                <h6 class="text-center">ابحث عن قطعة</h6>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                    <div class="form-group">
                        <label for="startDate">من تاريخ</label>
                        <input id="from_date" class="form-control" name="from_date" type="date" />
                    </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="startDate">إلى تاريخ</label>
                            <input id="to_date" class="form-control" name="to_date" type="date" />
                        </div>
                        </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">اسم القطعة</label>
                            <input type="text" onkeyup="part_name_search(this.value)" class="form-control" id="part_name" name="part_name">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">نوع السيارة</label>
                            <select name="car_type" class="form-control select2" style="width:100%">
                                <option value="0">جميع السيارات</option>
                                @foreach ($cars as $car)
                                <option value="{{$car->id}}">{{$car->car_type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">الحالة</label>
                            <div class="checkbox-group mt-2">
                                <div class="form-check form-check-inline" style="margin-left: 0px;">
                                    <input class="form-check-input" type="checkbox" id="status1" name="status1" value="جديد">
                                    <label class="form-check-label" for="status1">جديد</label>
                                </div>
                                <div class="form-check form-check-inline" style="margin-left: 0px;">
                                    <input class="form-check-input" type="checkbox" id="status2" name="status2" value="مستخدم">
                                    <label class="form-check-label" for="status2">مستخدم</label>
                                </div>
                                <div class="form-check form-check-inline" style="margin-left: 0px;">
                                    <input class="form-check-input" type="checkbox" id="status3" name="status3" value="مجدد">
                                    <label class="form-check-label" for="status3">مجدد</label>
                                </div>
                                <div class="form-check form-check-inline" style="margin-left: 0px;">
                                    <input class="form-check-input" type="checkbox" id="status4" name="status4" value="تقليد">
                                    <label class="form-check-label" for="status4">تقليد</label>
                                </div>
                            </div>
                            <input hidden id="part_status_array" name="part_status_array">
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </form> --}}

        <div class="row">
            <div class="col-md-12" id="cars_ads_table">
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

            </div>
        </div>
    </div>

</div>



@endsection

@section('script')
<script>

    function post_adv(id){

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: "{{ route('dashboard.cars_ads.post_adv') }}",
            type: 'POST',
            data: { id: id },
            success: function (response) {
                if(response.success == 'true'){
                    toastr.success(response.message);
                    $('#cars_ads_table').html(response.view);
                }
                else{
                    toastr.error(response.message)
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function un_post_adv(id){

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: "{{ route('dashboard.cars_ads.un_post_adv') }}",
            type: 'POST',
            data: { id: id },
            success: function (response) {
                if(response.success == 'true'){
                    toastr.success(response.message);
                    $('#cars_ads_table').html(response.view);
                }
                else{
                    toastr.error(response.message)
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function re_post_adv(id){

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: "{{ route('dashboard.cars_ads.re_post_adv') }}",
            type: 'POST',
            data: { id: id },
            success: function (response) {
                if(response.success == 'true'){
                    toastr.success(response.message);
                    $('#cars_ads_table').html(response.view);
                }
                else{
                    toastr.error(response.message)
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function delete_adv(id){

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: "{{ route('dashboard.cars_ads.delete_adv') }}",
            type: 'POST',
            data: { id: id },
            success: function (response) {
                if(response.success == 'true'){
                    toastr.success(response.message);
                    $('#cars_ads_table').html(response.view);
                }
                else{
                    toastr.error(response.message)
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }


</script>
@endsection
