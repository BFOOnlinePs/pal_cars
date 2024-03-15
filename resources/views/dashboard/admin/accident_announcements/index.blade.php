@extends('layouts.app')
@section('title')
    تبليغات الحوادث
@endsection
@section('header_title')
    تبليغات الحوادث
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
    تبليغات الحوادث
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
            <div class="col-md-12" id="accidents_table">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>اسم السائق</th>
                            <th>رقم الهوية</th>
                            <th>رقم الرخصة</th>
                            <th>شركة التأمين</th>
                            <th>تاريخ التبليغ</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($data->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center"><span>لا توجد بيانات</span></td>
                            </tr>
                        @else
                        @foreach ($data as $key)
                            <tr>
                                <td>{{$key->driver_name}}</td>
                                <td>{{$key->id_number}}</td>
                                <td>{{$key->license_id}}</td>
                                <td>{{$key->insurance_company->name ?? ''}}</td>
                                <td>{{$key->created_at}}</td>
                                <td><a href="{{ route('dashboard.accident_announcements.details', ['id' => $key->id]) }}" class="btn btn-sm btn-success text-white"><i class="fas fa-search"></i></a></td>
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
    // function delete_car_part(id){
    //     var csrfToken = $('meta[name="csrf-token"]').attr('content');

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': csrfToken
    //         }
    //     });

    //     $.ajax({
    //         url: "{{ route('web_pages.part_expo.delete') }}",
    //         type: 'POST',
    //         data: { id: id },
    //         success: function (response) {
    //             if(response.success == 'true'){
    //                 toastr.success(response.message);
    //                 $('#part_expo_table').html(response.view);
    //             }
    //             else{
    //                 toastr.error(response.message)
    //             }
    //         },
    //         error: function (error) {
    //             console.log(error);
    //         }
    //     });
    // }

    // var selectedValues = [];

    // $('#searchForm').find(':input').each(function () {
    //     $(this).on('change', function () {

    //         // console.log("hi")

    //         if(this.type=='checkbox'){
    //             if($(this).prop('checked')){
    //                 selectedValues.push(this.value);
    //             }else{
    //                 var indexToRemove = selectedValues.indexOf(this.value);
    //                 if (indexToRemove !== -1) {
    //                     selectedValues.splice(indexToRemove, 1);
    //                 }
    //             }
    //         }

    //         //selectedValues this : has the on checkbox values

    //         document.getElementById('part_status_array').value = JSON.stringify(selectedValues);

    //         // console.log($('#searchForm').serialize())

    //         var csrfToken = $('meta[name="csrf-token"]').attr('content');


    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': csrfToken
    //             }
    //         });

    //         $.ajax({
    //             type: 'POST',
    //             url: "{{ route('web_pages.part_expo.search') }}",
    //             data: $('#searchForm').serialize(),
    //             dataType: 'json',
    //             success: function(response) {
    //                 // console.log(response.data);
    //                 // console.log(response.check);
    //                 $('#part_expo_table').html(response.view);
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error(xhr.responseText);
    //             }
    //         });

    //     });
    // });

    // function part_name_search(data){

    //     var csrfToken = $('meta[name="csrf-token"]').attr('content');

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': csrfToken
    //         }
    //     })

    //     $.ajax({
    //         type: 'POST',
    //         url: "{{ route('web_pages.part_expo.search') }}",
    //         data: $('#searchForm').serialize(),
    //         dataType: 'json',
    //         success: function(response) {
    //             console.log(response.data);
    //             $('#part_expo_table').html(response.view);
    //         },
    //         error: function(xhr, status, error) {
    //             console.error(xhr.responseText);

    //         }
    //     });

    // }

</script>
@endsection
