@extends('layouts.app')
@section('title')
    معرض القطع
@endsection
@section('header_title')
    معرض القطع
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
    معرض القطع
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
            <div class="col-md-12" id="part_expo_table">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>صورة</th>
                            <th>اسم القطعة</th>
                            <th>نوع السيارة</th>
                            <th>معلومات القطعة</th>
                            <th>الحالة</th>
                            <th>السعر</th>
                            <th class="text-nowrap">تاريخ الإضافة</th>

                            <th>عرض</th>
                            {{-- @if(auth()->check() && in_array('1', json_decode(auth()->user()->user_role, true))) --}}
                            <th>حذف</th>
                            {{-- @endif --}}
                        </tr>
                        </thead>
                        <tbody>
                        @if ($data->isEmpty())
                            <tr>
                                <td colspan="9" class="text-center"><span>لا توجد بيانات</span></td>
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
                                <td>{{$key->part_price}} ₪</td>
                                <td>{{ date('Y-m-d', strtotime($key->created_at)) }}</td>

                                <td><a href="{{ route('web_pages.part_expo.details', ['id' => $key->id]) }}" class="btn btn-sm btn-success text-white"><i class="fas fa-search"></i></a></td>
                                {{-- @if(auth()->check() && in_array('1', json_decode(auth()->user()->user_role, true))) --}}
                                <td><button class="btn btn-sm btn-danger text-white" onclick="delete_car_part({{$key->id}})"><i class="fas fa-trash"></i></button></td>
                                {{-- @endif --}}
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
    function delete_car_part(id){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: "{{ route('dashboard.parts_ads.delete') }}",
            type: 'POST',
            data: { id: id },
            success: function (response) {
                if(response.success == 'true'){
                    toastr.success(response.message);
                    $('#part_expo_table').html(response.view);
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
