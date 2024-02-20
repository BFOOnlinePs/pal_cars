@extends('home')
@section('title')
    تفاصيل السكرتيريا
@endsection
@section('header_title')
    تفاصيل السكرتيريا
@endsection
@section('header_link')
    السكرتيريا
@endsection
@section('header_title_link')
    تفاصيل السكرتيريا
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/main.css') }}">


    @include('admin.messge_alert.success')
    @include('admin.messge_alert.fail')
    <div class="card">
        {{--        <div class="card-header text-center">--}}
        {{--            <h5 class="text-bold">تفاصيل المورد</h5>--}}
        {{--        </div>--}}
        <div class="card-body">

            <style>
                .active {
                    color: black !important;
                }

                .nav-link {
                    text-decoration: none;
                }
            </style>


            {{--            <form action="{{ route('users.supplier.create') }}" method="post" enctype="multipart/form-data">--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <h3 class="pb-3">{{ $data->name }}</h3>
                        <ul class="nav nav-tabs alert-info text-white" style="" id="custom-content-below-tab"
                            role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-white" id="custom-content-below-home-tab"
                                   data-toggle="pill"
                                   href="#custom-content-below-home" role="tab"
                                   aria-controls="custom-content-below-home" aria-selected="true">المعلومات العامة</a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link text-white" id="custom-content-below-profile-tab" data-toggle="pill"--}}
{{--                                   href="#custom-content-below-profile" role="tab"--}}
{{--                                   aria-controls="custom-content-below-profile" aria-selected="false">معلومات البنك</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link text-white" id="custom-content-below-messages-tab" data-toggle="pill"--}}
{{--                                   href="#custom-content-below-messages" role="tab"--}}
{{--                                   aria-controls="custom-content-below-messages" aria-selected="false">جهات الاتصال</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link text-white" id="custom-content-below-settings-tab" data-toggle="pill"--}}
{{--                                   href="#custom-content-below-settings" role="tab"--}}
{{--                                   aria-controls="custom-content-below-settings" aria-selected="false">الطلبيات</a>--}}
{{--                            </li>--}}
                            <li class="nav-item">
                                <a class="nav-link text-white" id="custom-content-below-calender-tab" data-toggle="pill"
                                   href="#custom-content-below-calender" role="tab"
                                   aria-controls="custom-content-below-calender" aria-selected="false">تقويم</a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link text-white" id="custom-content-below-settings-tab" data-toggle="pill"--}}
{{--                                   href="#custom-content-below-settings" role="tab"--}}
{{--                                   aria-controls="custom-content-below-settings" aria-selected="false">فواتير</a>--}}
{{--                            </li>--}}
                            <li class="nav-item">
                                <a class="nav-link text-white" id="custom-content-below-settings-tab" data-toggle="pill"
                                   href="#custom-content-below-settings" role="tab"
                                   aria-controls="custom-content-below-settings" aria-selected="false">سجل المتابعة</a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link text-white" id="custom-content-below-settings-tab" data-toggle="pill"--}}
{{--                                   href="#custom-content-below-settings" role="tab"--}}
{{--                                   aria-controls="custom-content-below-settings" aria-selected="false">الأصناف</a>--}}
{{--                            </li>--}}
                        </ul>
                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel"
                                 aria-labelledby="custom-content-below-home-tab">
                                <div class="p-2">
                                    <div class="row">
                                        <div class="col-md-8 p-5">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">الاسم :</label>
                                                        <input onchange="update_user_ajax('name',this.value)" class="form-control" value="{{ $data->name }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">الايميل :</label>
                                                        <input onchange="update_user_ajax('email',this.value)" class="form-control" value="{{ $data->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">رقم الهاتف الاول :</label>
                                                        <input onchange="update_user_ajax('user_phone1',this.value)" class="form-control" value="{{ $data->user_phone1 }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">رقم الهاتف الثاني :</label>
                                                        <input onchange="update_user_ajax('user_phone2',this.value)" class="form-control" value="{{ empty($data->user_phone2) ? 'لا يوجد' : $data->user_phone2}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">ملاحظات : </label>
                                                        <textarea onchange="update_user_ajax('user_notes',this.value)" class="form-control" name="" id="" cols="30"
                                                                  rows="3">{{ $data->user_notes }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">العنوان :</label>
                                                        <textarea onchange="update_user_ajax('user_address',this.value)" class="form-control" name="" id="" cols="30"
                                                                  rows="3">{{ $data->user_address }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                            <input onchange="update_user_ajax('user_status',(this.checked) ?1:0)" @if($data->user_status == 1) checked @endif type="checkbox" class="custom-control-input" id="customSwitch3">
                                                            <label class="custom-control-label" for="customSwitch3">حالة المستخدم</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                <div class="col-md-12">--}}
                                                {{--                                                    <div class="form-group">--}}
                                                {{--                                                        <label for="">تصنيف المستخدم :</label>--}}
                                                {{--                                                        <span class="form-control"></span>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                        </div>
                                        <div class="col-md-4 pt-5 text-center">
                                            <div class="form-group text-center">
                                                @if(empty($data->user_photo))
                                                    <img id="image_preview_container" width="150" src="{{ asset('storage/user_photo/'.$data->user_photo) }}" alt="">
                                                @else
                                                    <img id="image_preview_container" width="150" src="{{ asset('storage/user_photo/'.$data->user_photo) }}" alt="">
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="text-center">{{ $data->name }}</h4>
                                                <hr>
                                                <form method="POST" enctype="multipart/form-data" id="upload_image_form">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="file" name="image" placeholder="Choose image" id="image">
                                                                <span class="text-danger">{{ $errors->first('title') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary">رفع الصورة</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                {{--                                            <p>يحتوي هذا القسم على المعلومات الأساسية للموظف</p>--}}
                                                {{--                                            <a href="{{ route('users.employees.edit',['id'=>$data->id]) }}" class="btn btn-info">تعديل بيانات الموظف</a>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel"
                                 aria-labelledby="custom-content-below-profile-tab">
                                <div class="row">
                                    <div class="col-md-8 p-5">
                                        <div class="form-group">
                                            <label for="">اسم المستفيد :</label>
                                            <input class="form-control" type="text" name="account_owner"
                                                   placeholder="اسم جهة الحساب">
                                        </div>
                                        <div class="form-group">
                                            <label>رقم حساب البنك :</label>
                                            <span
                                                class="form-control">{{ $data->user_account_number }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>اسم البنك :</label>
                                            <span
                                                class="form-control">{{ $data->user_bank_name }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>عنوان البنك :</label>
                                            <textarea disabled class="form-control" name="" id=""
                                                      cols="30"
                                                      rows="3">{{ $data->user_bank_address }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Swift code :</label>
                                            <span
                                                class="form-control">{{ $data->user_swift_code }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>IBAN Number :</label>
                                            <span
                                                class="form-control">{{ $data->user_iban_number }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center pt-5">
                                            <i class="fa-solid fa-building-columns text-info"
                                               style="font-size: 180px"></i>
                                            <br><br>
                                            <h4>معلومات البنك</h4>
                                            <hr>
                                            <p>يحتوي هذا القسم على جميع معلومات البنك الذي يتم التعامل معه بواسطة هذا
                                                المورد</p>
                                            <a href="" class="btn btn-info">تعديل بيانات البنك</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel"
                                 aria-labelledby="custom-content-below-messages-tab">
                                <div class="row">
                                    <div class="col-md-8 pt-5">
                                        <label for="">جهة التواصل</label>
                                        <table style="font-size: 14px;border: solid 1px black;width: 100%"
                                               id="contact_person_table"
                                               class="table-hover table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>الصورة</th>
                                                <th>الاسم</th>
                                                <th>الهاتف</th>
                                                <th>الايميل</th>
                                                <th>الوتس اب</th>
                                                <th>الوي شات</th>
                                                <th>العنوان</th>
                                                <th>العمليات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($company_contact_person as $key)
                                                <tr id="delete_{{$key->id}}">
                                                    <td><img style="width: 30px;height: 30px" class="p-1"
                                                             src="{{ asset('storage/user_photo/avatar.png') }}" alt="">
                                                    </td>
                                                    <td>{{ $key->contact_name }}</td>
                                                    <td>{{ $key->mobile_number }}</td>
                                                    <td>{{ $key->email }}</td>
                                                    <td>{{ $key->whats_app_number }}</td>
                                                    <td>{{ $key->wechat_number }}</td>
                                                    <td>{{ $key->address }}</td>
                                                    <td>
                                                        <button onclick="deleteMessage({{ $key->id }})"
                                                                class="btn btn-sm btn-danger">X
                                                        </button>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center pt-5">
                                            <i class="fa-solid fa-address-card text-info" style="font-size: 180px"></i>
                                            <br><br>
                                            <h4>معلومات جهات الاتصال</h4>
                                            <hr>
                                            <p>يحتوي هذا القسم على معلومات جهات الاتصال التي يتم التواصل من خلالها مع
                                                هذا المورد</p>
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#modal-default">
                                                اضافة جديد
                                            </button>
                                            <div class="modal fade" id="modal-default">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('company_contact_person.supplier.create') }}"
                                                          method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="text" hidden name="company_id"
                                                               value="{{ $data->id }}">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">اضافة جهة تواصل جديدة</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="">الاسم</label>
                                                                    <input name="contact_name" class="form-control"
                                                                           type="text"
                                                                           placeholder="الاسم">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">رقم الهاتف</label>
                                                                    <input name="mobile_number" class="form-control"
                                                                           type="text"
                                                                           placeholder="رقم الهاتف">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">البريد الالكتروني</label>
                                                                    <input name="email" class="form-control" type="text"
                                                                           placeholder="البريد الالكتروني">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">رقم WhatsApp</label>
                                                                    <input name="whats_app_number" class="form-control"
                                                                           type="text"
                                                                           placeholder="رقم الواتس اب">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">رقم WeChat</label>
                                                                    <input name="wechat_number" class="form-control"
                                                                           type="text"
                                                                           placeholder="رقم وي شات">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">العنوان</label>
                                                                    <textarea class="form-control" name="address" id=""
                                                                              cols="30"
                                                                              rows="2" placeholder="العنوان"></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">الصورة</label>
                                                                    <div class="custom-file">
                                                                        <input name="photo" type="file"
                                                                               class="custom-file-input"
                                                                               id="customFile">
                                                                        <label class="custom-file-label"
                                                                               for="customFile">تحميل
                                                                            صورة</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal">اغلاق
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">حفظ
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </form>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel"
                                 aria-labelledby="custom-content-below-settings-tab">
                                <div class="p-2">
                                    <h5 class="text-center">قريبا ..</h5>
{{--                                    <div class="card card-info">--}}
{{--                                        --}}{{--                                        <div class="card-header text-center">--}}
{{--                                        --}}{{--                                            <span>طلبات المورد</span>--}}
{{--                                        --}}{{--                                        </div>--}}

{{--                                        <div class="card-body p-4">--}}
{{--                                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">--}}
{{--                                                <div class="row">--}}
{{--                                                    <div class="col-sm-12">--}}
{{--                                                        <table id="example1"--}}
{{--                                                               class="table table-bordered table-striped dataTable dtr-inline"--}}
{{--                                                               aria-describedby="example1_info">--}}
{{--                                                            <thead>--}}
{{--                                                            <tr>--}}
{{--                                                                <th class="sorting sorting_asc" tabindex="0"--}}
{{--                                                                    aria-controls="example1" rowspan="1" colspan="1"--}}
{{--                                                                    aria-sort="ascending"--}}
{{--                                                                    aria-label="Rendering engine: activate to sort column descending">--}}
{{--                                                                    Rendering engine--}}
{{--                                                                </th>--}}
{{--                                                                <th class="sorting" tabindex="0"--}}
{{--                                                                    aria-controls="example1"--}}
{{--                                                                    rowspan="1" colspan="1"--}}
{{--                                                                    aria-label="Browser: activate to sort column ascending">--}}
{{--                                                                    Browser--}}
{{--                                                                </th>--}}
{{--                                                                <th class="sorting" tabindex="0"--}}
{{--                                                                    aria-controls="example1"--}}
{{--                                                                    rowspan="1" colspan="1"--}}
{{--                                                                    aria-label="Platform(s): activate to sort column ascending">--}}
{{--                                                                    Platform(s)--}}
{{--                                                                </th>--}}
{{--                                                                <th class="sorting" tabindex="0"--}}
{{--                                                                    aria-controls="example1"--}}
{{--                                                                    rowspan="1" colspan="1"--}}
{{--                                                                    aria-label="Engine version: activate to sort column ascending">--}}
{{--                                                                    Engine version--}}
{{--                                                                </th>--}}
{{--                                                                <th class="sorting" tabindex="0"--}}
{{--                                                                    aria-controls="example1"--}}
{{--                                                                    rowspan="1" colspan="1"--}}
{{--                                                                    aria-label="CSS grade: activate to sort column ascending">--}}
{{--                                                                    CSS grade--}}
{{--                                                                </th>--}}
{{--                                                            </tr>--}}
{{--                                                            </thead>--}}
{{--                                                            <tbody>--}}
{{--                                                            </tbody>--}}
{{--                                                        </table>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-calender" role="tabpanel"
                                 aria-labelledby="custom-content-below-calender-tab">
                                <div class="p-2">
                                    <div class="container">
                                        <div class="response"></div>
                                        <div
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar/main.js') }}"></script>

    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>



    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
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
        function add_contact_person() {
            var contact_person_table = document.getElementById('contact_person_table');
            var count = {{ \App\Models\CompanyContactPersonModel::count() }};
            if (contact_person_table.rows.length == count + 1) {
                var new_row = contact_person_table.insertRow();
                var cell1 = new_row.insertCell();
                var cell2 = new_row.insertCell();
                var cell3 = new_row.insertCell();
                var cell4 = new_row.insertCell();
                cell1.innerText = '2';
                cell2.innerText = 'test2';
                cell3.innerHTML = '<button class="btn btn-sm btn-dark">تفاصيل</button>';
                cell4.innerHTML = '<button class="btn btn-sm btn-danger">X</button>';
            } else {
                alert('يرجى تعبئة الحقل الفارغ')
            }
            console.log(contact_person_table.rows.length);
            // console.log(count);

        }

        function deleteMessage(id) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var headers = {
                "X-CSRF-Token": csrfToken
            };
            var confirmationMessage = "هل انت متاكد انك تريد حذف البيانات ؟";
            var userConfirmed = window.confirm(confirmationMessage);
            if (userConfirmed) {
                $.ajax({
                    url: '{{ url('company_contact_person/delete') }}' + '/' + id,
                    method: 'get',
                    headers: headers,
                    success: function (data) {
                        document.getElementById('delete_' + id).remove();
                        toastr.success('تم حذف البيانات بنجاح')
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('error');
                    }
                });
            }
        }

        function update_user_ajax(data_type,value)
        {
            let user_id = {{ $data->id }};
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var headers = {
                "X-CSRF-Token": csrfToken
            };
            $.ajax({
                url: "{{ route('users.update_user_ajax') }}",
                method: 'post',

                headers: headers,
                data: {
                    'data_type':data_type,
                    'value': value ,
                    'id':user_id
                },
                success: function(data) {
                    if(data.success == 'true'){
                        toastr.success(data.message)
                    }
                    else{
                        toastr.error(data.message)
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText);
                    // toastr.error(jqXHR.message)
                }
            });
        }

        $(document).ready(function (e) {
            $('#image').change(function (){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#image_preview_container').attr('src',e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('#upload_image_form').submit(function (e) {
                e.preventDefault();
                let user_id = {{ $data->id }};
                var formData = new FormData(this);
                formData.append('id',user_id);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('users.upload_image') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        toastr.success(data.message);
                        this.reset();
                    },
                    error: function(jqXHR) {
                        console.log(jqXHR.responseText);
                    }
                });
            })
        })

    </script>

    <script>
        $(function () {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'addEventButton',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            defaultDate: '2018-11-16',
            navLinks: true,
            editable: true,
            eventLimit: true,
            selectable: true,
            events: [{
                title: 'Simple static event',
                start: '2018-11-16',
                description: 'Super cool event'
            },

            ],
            select: function (startDate, endDate) {
                var dateStart = moment(startDate);
                var dateEnd = moment(endDate);

                if (dateStart.isValid() && dateEnd.isValid()) {
                    $('#calendar-5').fullCalendar('renderEvent', {
                        title: 'Long event',
                        start: dateStart,
                        end: dateEnd,
                        allDay: true
                    });
                }
            }
        });
    });

</script>






@endsection

