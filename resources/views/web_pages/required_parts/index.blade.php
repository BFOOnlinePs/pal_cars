@extends('layouts.app')
@section('title')
    القطع المطلوبة
@endsection
@section('header_title')
    القطع المطلوبة
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
    القطع المطلوبة
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('content')


<div class="card">

    <div class="card-body">

        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                           aria-describedby="example1_info">
                        <thead>
                        <tr>
                            {{-- <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                colspan="1" aria-sort="ascending">غير مهتم</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">القطعة المطلوبة</th>

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">نوع السيارة</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">موديل السيارة</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">سنة الإنتاج الحساب</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">الجير</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">الماتور</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">المدينة</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">سعر القطعة الجديدة</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">العمليات</th> --}}
                            {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">العمليات</th> --}}
                            {{-- <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                colspan="1" aria-sort="ascending">غير مهتم</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">القطعة المطلوبة</th> --}}

                            <th>غير مهتم</th>
                            <th> القطعة</th>
                            <th>نوع السيارة</th>
                            <th>موديل السيارة</th>
                            <th>سنة الإنتاج الحساب</th>
                            <th>الجير</th>
                            <th>الماتور</th>
                            <th>المدينة</th>
                            <th>سعر القطعة الجديدة</th>
                            <th>العمليات</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key)
                            <tr id="row{{$key->id}}">
                                <td>
                                    <button type="button" onclick="not_interested({{$key->id}})" class="btn btn-danger">غير مهتم</button>
                                </td>
                                <td>{{$key->part_request}}</td>
                                <td class="text-nowrap">
                                    <img src="{{ asset('storage/uploads/carTypeLogo/' . $key->car->logo) }}" alt="Logo" width="30">
                                    {{$key->car->car_type}}
                                </td>
                                <td>{{$key->car_model}}</td>
                                <td>{{$key->pr_year}}</td>
                                <td>{{$key->geer_type}}</td>
                                <td>{{$key->motor_type}}</td>
                                <td>{{$key->city}}</td>
                                <td>
                                    {{-- test --}}
                                    <form action="{{ route('web_pages.required_parts.new_part_price') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row" style="width:100%">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <input type="number" class="form-control form-control-sm" id="new_part_price" name="new_part_price" placeholder="سعر القطعة الجديدة" required>
                                                    <input hidden name="request_id" value="{{$key->id}}">
                                                </div>
                                            </div>
                                            <div class="col-md-1" style="padding-right:0px;">
                                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-paper-plane"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                    {{-- <input type="number" placeholder="سعر القطعة الجديدة"> --}}
                                </td>
                                <td>
                                    <a href="{{ route('web_pages.required_parts.requested_part_details', ['id' => $key->id]) }}" class="btn btn-sm btn-success text-white"><i class="fas fa-search"></i></a>
                                    <a href="{{ route('web_pages.required_parts.add_offer', ['id' => $key->id]) }}" class="btn btn-sm btn-success text-white">تقديم عرض</a>

                                    {{-- test --}}
                                </td>

                                <td>

                                </td>

                                {{-- <td></td> --}}
                                {{-- <td><a href="{{ route('web_pages.part_expo.details', ['id' => $key->id]) }}" class="btn btn-sm btn-success text-white">تقديم عرض</a></td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="text-primary" style="cursor: pointer">مسح الكل</div>
        {{-- </div> --}}
        {{-- <div class="row">
            <div class="col-md-12" id="part_expo_table">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>القطعة المطلوبة</th>
                            <th>نوع السيارة</th>
                            <th>سنة الإنتاج</th>
                            <th>الجير</th>
                            <th>الماتور</th>
                            <th>المنطقة</th>
                            <th>العمليات</th>
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
                                <td><button class="btn btn-danger">غير مهتم</button></td>
                                <td>{{$key->part_request}}</td>
                                <td class="text-nowrap">
                                    <img src="{{ asset('storage/uploads/carTypeLogo/' . $key->car->logo) }}" alt="Logo" width="30">
                                    {{$key->car->car_type}}
                                </td>
                                <td>{{$key->pr_year}}</td>
                                <td>{{$key->geer_type}}</td>
                                <td>{{$key->motor_type}}</td>
                                <td>{{$key->city}}</td>
                                <td><a href="{{ route('web_pages.part_expo.details', ['id' => $key->id]) }}" class="btn btn-sm btn-success text-white"><i class="fas fa-search"></i></a></td>
                                <td><a href="{{ route('web_pages.part_expo.details', ['id' => $key->id]) }}" class="btn btn-sm btn-success text-white">تقديم عرض</a></td>
                            </tr>
                        @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>

            </div>
        </div> --}}
    </div>
{{-- </div> --}}


</div>



@endsection

@section('script')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
{{-- <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script> --}}
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            // "columnDefs": [
            // { "visible": false, "targets": [9, 10] } // Hide columns 10 and 11 (indexing starts from 0)
            // ],
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

<script>
    function not_interested(id){

        var row = document.getElementById('row' + id);

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: "{{ route('web_pages.required_parts.not_interested') }}",
            type: 'POST',
            data: { id: id },
            success: function (response) {
                if(response.success == 'true'){
                    if (row) {
                        row.remove();
                    } else {
                        console.error('Row with id ' + id + ' not found.');
                    }
                    toastr.success(response.message);
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
