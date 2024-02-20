@extends('home')
@section('title')
    الموردين
@endsection
@section('header_title')
    الموردين
@endsection
@section('header_link')
    الرئيسية
@endsection
@section('header_title_link')
    الموردين
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection
@section('content')
    @include('admin.messge_alert.success')
    @include('admin.messge_alert.fail')
    <div class="card">

        <div class="card-body">

            <form action="{{ route('users.supplier.update_bank_supplier') }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{--                    <div class="col-md-12">--}}
                    {{--                        <div>--}}
                    {{--                            <div class="card card-warning">--}}
                    {{--                                <div class="card-header text-center">--}}
                    {{--                                    <span>المعلومات العامة</span>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="card-body p-4">--}}
                    {{--                                    <div class="row">--}}
                    {{--                                        <div class="col">--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <label for="">الاسم الكامل</label>--}}
                    {{--                                                <input value="{{ old('name',$data->name) }}" placeholder="الاسم الكامل"--}}
                    {{--                                                       name="name" class="form-control"--}}
                    {{--                                                       type="text">--}}
                    {{--                                                @error('name')--}}
                    {{--                                                <span class="text-danger">{{ $message }}</span>--}}
                    {{--                                                @enderror--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <label for="">الايميل</label>--}}
                    {{--                                                <input value="{{ old('email',$data->email) }}" name="email"--}}
                    {{--                                                       placeholder="الايميل" class="form-control"--}}
                    {{--                                                       type="text">--}}
                    {{--                                                @error('email')--}}
                    {{--                                                <span class="text-danger">{{ $message }}</span>--}}
                    {{--                                                @enderror--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <label for="">كلمة المرور</label>--}}
                    {{--                                                <input {{ old('password') }} placeholder="كلمة المرور" name="password"--}}
                    {{--                                                       class="form-control"--}}
                    {{--                                                       type="text">--}}
                    {{--                                                @error('password')--}}
                    {{--                                                <span class="text-danger">{{ $message }}</span>--}}
                    {{--                                                @enderror--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="row form-group">--}}
                    {{--                                                <div class="col">--}}
                    {{--                                                    <label>رقم الهاتف الاول</label>--}}
                    {{--                                                    <input value="{{ old('user_phone1',$data->user_phone1) }}"--}}
                    {{--                                                           placeholder="رقم الهاتف الاول" class="form-control"--}}
                    {{--                                                           name="user_phone1" type="text">--}}
                    {{--                                                    @error('user_phone1')--}}
                    {{--                                                    <span class="text-danger">{{ $message }}</span>--}}
                    {{--                                                    @enderror--}}
                    {{--                                                </div>--}}
                    {{--                                                <div class="col">--}}
                    {{--                                                    <label for="">رقم الهاتف الثاني</label>--}}
                    {{--                                                    <input value="{{ old('user_phone2',$data->user_phone2) }}"--}}
                    {{--                                                           placeholder="رقم الهاتف الثاني" class="form-control"--}}
                    {{--                                                           name="user_phone2" type="text">--}}
                    {{--                                                    @error('user_phone2')--}}
                    {{--                                                    <span class="text-danger">{{ $message }}</span>--}}
                    {{--                                                    @enderror--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <label for="">الموقع الالكتروني</label>--}}
                    {{--                                                <input value="{{ old('user_website',$data->user_website) }}"--}}
                    {{--                                                       placeholder="الموقع الالكتروني" name="user_website"--}}
                    {{--                                                       class="form-control" type="text">--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <label for="">العنوان الكامل</label>--}}
                    {{--                                                <textarea class="form-control" placeholder="العنوان الكامل"--}}
                    {{--                                                          name="user_address" id="" cols="30"--}}
                    {{--                                                          rows="3">{{ old('user_address',$data->user_address) }}</textarea>--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <label for="">تصنيف المستخدم</label>--}}
                    {{--                                                <input class="form-control" type="text" name="user_category"--}}
                    {{--                                                       placeholder="تنصيف المستخدم">--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="form-group">--}}


                    {{--                                                <div class="row">--}}
                    {{--                                                    <div class="col-md-5 text-center">--}}

                    {{--                                                        <img width="150"--}}
                    {{--                                                             src="{{ asset('storage/user_photo/'. $data->user_photo) }}"--}}
                    {{--                                                             alt="">--}}
                    {{--                                                        <br>--}}
                    {{--                                                        <label for="exampleInputFile">الصورة الشخصية</label>--}}

                    {{--                                                    </div>--}}
                    {{--                                                    <div class="col-md-7 pt-5">--}}
                    {{--                                                        <div class="input-group">--}}
                    {{--                                                            <div class="custom-file">--}}
                    {{--                                                                <input type="file" class="custom-file-input" id="exampleInputFile">--}}
                    {{--                                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>--}}
                    {{--                                                            </div>--}}
                    {{--                                                            <div class="input-group-append">--}}
                    {{--                                                                <span class="input-group-text">رفع</span>--}}
                    {{--                                                            </div>--}}
                    {{--                                                        </div>--}}
                    {{--                                                    </div>--}}

                    {{--                                                </div>--}}


                    {{--                                                --}}{{--                                                <div class="input-group mt-3">--}}
                    {{--                                                --}}{{--                                                    <div class="custom-file">--}}

                    {{--                                                --}}{{--                                                    </div>--}}
                    {{--                                                --}}{{--                                                    <div class="input-group-append">--}}
                    {{--                                                --}}{{--                                                        <span class="input-group-text">رفع</span>--}}
                    {{--                                                --}}{{--                                                    </div>--}}
                    {{--                                                --}}{{--                                                </div>--}}
                    {{--                                                @error('user_photo')--}}
                    {{--                                                <span class="text-danger">{{ $message }}</span>--}}
                    {{--                                                @enderror--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="form-group">--}}
                    {{--                                                <label for="">ملاحظات</label>--}}
                    {{--                                                <textarea placeholder="الملاحظات" class="form-control" name="user_notes"--}}
                    {{--                                                          id="" cols="30"--}}
                    {{--                                                          rows="5">{{ old('user_notes',$data->user_notes) }}</textarea>--}}
                    {{--                                                @error('user_notes')--}}
                    {{--                                                <span class="text-danger">{{ $message }}</span>--}}
                    {{--                                                @enderror--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}

                    {{--                    </div>--}}
                    <div class="col-md-12">
                        <div>
                            <div class="card card-danger">
                                <div class="card-header text-center">
                                    <span>معلومات البنك</span>
                                </div>
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">اسم البنك</label>
                                                <select class="form-control select2bs4" name="bank_id" id="">
                                                    @foreach($banks as $bank)
                                                        <option @if($data->bank_id == $bank->id) selected
                                                                @endif value="{{ $bank->id }}">{{ $bank->user_bank_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">اسم المستفيد</label>
                                                <input readonly class="form-control"
                                                       value="{{ $data->beneficiary_name }}"
                                                       type="text" name="account_owner" placeholder="اسم البنك">
                                            </div>
                                            <div class="form-group">
                                                <label for="">رقم الحساب البنكي</label>
                                                <input readonly class="form-control"
                                                       value="{{ $data['bank']->account_number }}"
                                                       type="text" name="user_account_number"
                                                       placeholder="رقم الحساب البنكي">
                                            </div>
                                            <div class="form-group">
                                                <label for="">عنوان البنك</label>
                                                <textarea readonly class="form-control" placeholder="عنوان البنك"
                                                          name="user_bank_address" id=""
                                                          cols="30"
                                                          rows="3">{{ $data['bank']->user_bank_address }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Swift code</label>
                                                <input readonly class="form-control"
                                                       value="{{ $data['bank']->user_swift_code }}"
                                                       name="user_swift_code" type="text" placeholder="Swift code">
                                            </div>
                                            <div class="form-group">
                                                <label for="">IBAN Number</label>
                                                <input readonly class="form-control"
                                                       value="{{ $data['bank']->user_iban_number }}"
                                                       name="user_iban_number" type="text" placeholder="IBAN Number">
                                            </div>
                                            <div class="form-group">
                                                <label for="">معلومات التواصل مع الشخص</label>
                                                <input readonly class="form-control"
                                                       value="{{ $data['bank']->contact_person }}"
                                                       name="user_iban_number" type="text" placeholder="IBAN Number">
                                            </div>
                                            <div class="form-group">
                                                <label for="">معلومات الاتصال</label>
                                                <input readonly class="form-control"
                                                       value="{{ $data['bank']->contact_mobile }}"
                                                       name="user_iban_number" type="text" placeholder="IBAN Number">
                                            </div>
                                            <div class="form-group">
                                                <label for="">الملاحظات</label>
                                                <textarea readonly class="form-control" name="" id="" cols="30"
                                                          rows="3">{{ $data->notes }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-block"><i
                                    class="fa-solid fa-floppy-disk"></i> تعديل
                            </button>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
            //Money Euro
            $('[data-mask]').inputmask()

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });

            //Date and time picker
            $('#reservationdatetime').datetimepicker({icons: {time: 'far fa-clock'}});

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function (start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
            )

            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'LT'
            })

            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function (event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            })

            $("input[data-bootstrap-switch]").each(function () {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

        })
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = false

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "/target-url", // Set the url
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        })

        myDropzone.on("addedfile", function (file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function () {
                myDropzone.enqueueFile(file)
            }
        })

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function (progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        myDropzone.on("sending", function (file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function (progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function () {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        }
        document.querySelector("#actions .cancel").onclick = function () {
            myDropzone.removeAllFiles(true)
        }
        // DropzoneJS Demo Code End
    </script>

@endsection
