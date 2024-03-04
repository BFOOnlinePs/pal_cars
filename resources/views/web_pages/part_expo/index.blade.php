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


        <div class="row">
            {{-- <div class="col-2 d-flex align-items-center"> --}}
                <a class="btn btn-warning mb-2 mr-3" href="{{route('web_pages.part_expo.add')}}"><i class="fa fa-plus"></i> الإعلان عن قطع متوفرة</a>
            {{-- </div> --}}
        </div>

        {{-- <div class="row"> --}}


            {{-- <div class="col-12"> --}}
                <form id="searchForm" action="">
                <div class="card card-info">
                    <div class="card-header">
                    <h6 class="text-center">ابحث عن قطعة</h6>
                    </div>
                    <div class="card-body">
                    <div class="row">

                        <div class="col-md-2">
                        <div class="form-group">
                            {{-- <label>Date range:</label> --}}
                            <label for="startDate">من تاريخ</label>
                            <input id="startDate" class="form-control" name="from_date" type="date" />
                        </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                {{-- <label>Date range:</label> --}}
                                <label for="startDate">إلى تاريخ</label>
                                <input id="startDate" class="form-control" name="to_date" type="date" />
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
                    <!-- /.card-body -->
                </div>
                </form>
            {{-- </div> --}}

            {{-- <div class="col-2 d-flex align-items-center">
                <a class="btn btn-warning mb-2" href="{{route('web_pages.part_expo.add')}}"><i class="fa fa-plus"></i> الإعلان عن قطع متوفرة</a>
            </div> --}}

        {{-- </div> --}}

        <div class="row">
            <div class="col-md-12" id="part_expo_table">
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
            url: "{{ route('web_pages.part_expo.delete') }}",
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

    var selectedValues = [];

    $('#searchForm').find(':input').each(function () {
        $(this).on('change', function () {

            // console.log("hi")

            if(this.type=='checkbox'){
                if($(this).prop('checked')){
                    selectedValues.push(this.value);
                }else{
                    var indexToRemove = selectedValues.indexOf(this.value);
                    if (indexToRemove !== -1) {
                        selectedValues.splice(indexToRemove, 1);
                    }
                }
            }

            //selectedValues this : has the on checkbox values

            document.getElementById('part_status_array').value = JSON.stringify(selectedValues);

            // console.log($('#searchForm').serialize())

            var csrfToken = $('meta[name="csrf-token"]').attr('content');


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('web_pages.part_expo.search') }}",
                data: $('#searchForm').serialize(),
                dataType: 'json',
                success: function(response) {
                    // console.log(response.data);
                    // console.log(response.check);
                    $('#part_expo_table').html(response.view);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

        });
    });

    function part_name_search(data){

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })

        $.ajax({
            type: 'POST',
            url: "{{ route('web_pages.part_expo.search') }}",
            data: $('#searchForm').serialize(),
            dataType: 'json',
            success: function(response) {
                console.log(response.data);
                $('#part_expo_table').html(response.view);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);

            }
        });

}

</script>
@endsection
