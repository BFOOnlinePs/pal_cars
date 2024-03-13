@extends('layouts.app')
@section('title')
    الإعلان عن سيارة
@endsection
@section('header_title')
    الإعلان عن سيارة
@endsection
@section('header_link')
    <a href="{{route('web_pages.cars_ads.index')}}">معرض السيارات</a>
@endsection
@section('header_title_link')
    الإعلان عن سيارة
@endsection
@section('style')
<style>
    .delete-btn {
        position: absolute;
        top: 10px;
        right: 20px;
        cursor: pointer;
        background-color: #dc3545;
        width: 30px;
        height: 30px;
        align-items: center;
        text-align: center;
        border-radius: 5px;
        color: #fff;
    }

    .loader-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.35); /* خلفية شفافة لشاشة التحميل */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* يجعل شاشة التحميل فوق جميع العناصر الأخرى */
    }
    /* body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 500px;
            margin-top: 50px;
        } */

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 30px;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            color: #007bff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            color: #333;
            font-weight: bold;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="callout callout-info" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;">
            <h5><i class="fas fa-info"></i> ملاحظة : </h5>
            يمكنك من خلال النموذج التالي الإعلان عن سيارة متوفرة لديك ليشاهد إعلانك المئات من المهتمين
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mx-auto">
    <div class="card">
        <div class="card-body">
            <form id="car_adv_form" action="{{ route('web_pages.cars_ads.create') }}" method="post" enctype="multipart/form-data">
            {{-- <form id="car_adv_form" > --}}
                @csrf
                <input type="text" hidden name="car_type" value="{{$id}}">
                <h3 class=""style="background-color:"> <i class="fa fa-car"></i> مواصفات السيارة</h3>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">موديل السيارة <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="car_model" name="car_model" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1">سنة التصنيع <span class="text-danger">*</span></label>
                            <select required id="production_year" name="production_year" class="form-control select2" style="width: 100%;">
                                <option value="" disabled selected>--موديل سنة--</option>
                                @foreach ($years as $year)
                                <option value="{{$year}}">{{$year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">لون السيارة <span class="text-danger">*</span></label>
                            <select required id="car_color" name="car_color" class="form-control select2" style="width: 100%;">
                                <option value="" disabled selected>--اللون--</option>
                                @foreach ($colors as $color)
                                <option value="{{$color->id}}">{{$color->color}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">عدد الركاب <span class="text-danger">*</span></label>
                            <select required id="seats_number" name="seats_number" class="form-control select2" style="width: 100%;">
                                <option value="" disabled selected>--عدد الركاب--</option>
                                @foreach ($seats as $seat)
                                <option value="{{$seat}}">{{$seat}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">عداد السيارة <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="car_counter" name="car_counter" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">طراز المحرك <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="car_motor" name="car_motor" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">قوة الماتور <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="motor_size" name="motor_size" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">نوع الوقود <span class="text-danger">*</span></label>
                            <div class="checkbox-group mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diesel" value="ديزل" required>
                                    <label class="form-check-label" for="checkbox1">ديزل</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diesel" value="بنزين" required>
                                    <label class="form-check-label" for="checkbox2">بنزين</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diesel" value="هايبرد" required>
                                    <label class="form-check-label" for="checkbox3">هايبرد</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diesel" value="كهرباء" required>
                                    <label class="form-check-label" for="checkbox4">كهرباء</label>
                                </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">نوع الجير <span class="text-danger">*</span></label>
                            <div class="checkbox-group mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="geer_type" value="عادي" required>
                                    <label class="form-check-label" for="checkbox1">عادي</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="geer_type" value="أوتوماتيك" required>
                                    <label class="form-check-label" for="checkbox2">أوتوماتيك</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="geer_type" value="نصف أوتوماتيك" required>
                                    <label class="form-check-label" for="checkbox3">نصف أوتوماتيك</label>
                                </div>

                          </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">الزجاج <span class="text-danger">*</span></label>
                            <div class="checkbox-group mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="glass" value="إلكتروني" required>
                                    <label class="form-check-label" for="checkbox1">إلكتروني</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="glass" value="يدوي" required>
                                    <label class="form-check-label" for="checkbox2">يدوي</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">الإضافات المتوفرة <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="addon" id="addon" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">صورة أساسية</label>
                        <input type="file" name="primary_image" id="primary_image" class="form-control">
                    </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">صور إضافية</label>
                            <input type="file" name="images[]" id="imageInput" class="form-control" multiple>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                {{-- <label for="exampleInputPassword1">اختيار الصور</label> --}}

                                <div class="row" class="preview-container" id="imagePreview">

                                </div>
                            </div>
                        </div>

                    </div>



                    {{-- <div class="col-md-4">
                    <h5 class="alert alert-info row">
                        <span class="col-md-2 mt-2"><i class="fa fa-plus"></i> صور إضافية للقطعة</span>
                        <input type="file" class="form-control col-md-2" id="imageInput" style="background-color: transparent;
                        border: transparent;" name="images[]" multiple>
                    </h5>
                    </div> --}}




                </div>



                <br>
                <h3 class=""style="background-color:"> <i class="fa fa-info-circle"></i> معلومات السيارة</h3>
                <hr>


                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1">عدد المالكين السابقين <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="old_owner" name="old_owner" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1">أصل السيارة <span class="text-danger">*</span></label>
                            <select required id="car_sours" name="car_sours" class="form-control select2" style="width: 100%;">
                                <option value="" disabled selected>--الأصل--</option>
                                {{-- <option value="">أصل السيارة</option> --}}
                                <option value="خصوصي">خصوصي</option>
                                <option value="عمومي">عمومي</option>
                                <option value="تأجير">تأجير</option>
                                <option value="تدريب سياقة">تدريب سياقة</option>
                                <option value="تجاري">تجاري</option>
                                <option value="حكومي">حكومي</option>
                            </select>
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">السعر</label>
                            <input type="text" class="form-control" id="part_name" name="part_name" required>
                        </div>
                    </div> --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">رخصة السيارة <span class="text-danger">*</span></label>
                            <div class="checkbox-group mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="agreement" value="فلسطينية" required>
                                    <label class="form-check-label" for="checkbox1">فلسطينية</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="agreement" value="نمرة صفراء" required>
                                    <label class="form-check-label" for="checkbox2">نمرة صفراء</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="exampleInputEmail1">معلومات إضافية</label>
                            <textarea class="form-control" name="additional_info" id="additional_info" rows="5"></textarea>
                        </div>
                    </div>

                </div>


                <h3 class=""style="background-color:"> <i class="fa fa-bullhorn"></i> تفاصيل الإعلان</h3>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">عرض لـ <span class="text-danger">*</span></label>
                            <div class="checkbox-group mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="view_for" value="البيع" required>
                                    <label class="form-check-label" for="checkbox1">البيع</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="view_for" value="التبديل" required>
                                    <label class="form-check-label" for="checkbox2">التبديل</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="view_for" value="البيع والتبديل" required>
                                    <label class="form-check-label" for="checkbox3">البيع والتبديل</label>
                                </div>

                          </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">مدة الإعلان <span class="text-danger">*</span></label>
                            <select required id="ads_days" name="ads_days" class="form-control select2" style="width: 100%;">
                                <option value="" disabled selected>--المدة--</option>
                                @foreach ($adv_days as $day)
                                <option value="{{$day}}">{{$day}} يوم</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">المناطق <span class="text-danger">*</span></label>
                            <select required class="form-control select2bs4" multiple="multiple"  id="cities" name="cities[]" style="width: 100%;">
                                @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->city_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">السعر <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">طريقة الدفع <span class="text-danger">*</span></label>
                            <div class="checkbox-group mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="payment_method" value="نقداً" required>
                                    <label class="form-check-label" for="checkbox1">نقداً</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="payment_method" value="تقسيط" required>
                                    <label class="form-check-label" for="checkbox2">تقسيط</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="payment_method" value="نصف نقداً ونصف تقسيط" required>
                                    <label class="form-check-label" for="checkbox3">نصف نقداً ونصف تقسيط</label>
                                </div>

                          </div>
                        </div>
                    </div>
                </div>

                <br>
                <h3 class=""style="background-color:"> <i class="fa fa-user"></i> معلومات المُعلن</h3>
                <hr>
                <div class="row">
                    <input type="text" hidden name="add_by" value="{{$user->id}}">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم المعلن <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="visitor_name" name="visitor_name" value="{{$user->name}}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">هاتف <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="visitor_phone1" name="visitor_phone1" value="{{$user->user_phone1}}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">هاتف 2</label>
                            <input type="text" class="form-control" id="visitor_phone2" name="visitor_phone2" value="{{$user->user_phone2}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">البريد الإلكتروني</label>
                            <input type="text" class="form-control" id="visitor_email" name="visitor_email" value="{{$user->email}}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">المدينة <span class="text-danger">*</span></label>
                            <select required id="visitor_city" name="visitor_city" class="form-control select2" style="width: 100%;">
                                @foreach ($cities as $city)
                                <option value="{{$city->id}}" {{ $user->city && $user->city->id == $city->id ? 'selected' : '' }}>{{$city->city_name}}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" id="part_name" name="part_name" value="{{$user->city->city_name}}" required> --}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">العنوان <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="visitor_address" name="visitor_address" value="{{$user->user_address}}" required>
                        </div>
                    </div>
                </div>
                {{-- <button type="submit" class="btn btn-success">إضافة الإعلان</button> --}}
                <button type="button" onclick="submitForm()" class="btn btn-success"><i class="fa fa-plus"></i> إضافة الإعلان</button>
            </form>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('script')
<script>
    var selectedFiles = [];


    //     var form = document.getElementById('car_adv_form');
    //     console.log('hi')
    //     form.submit();
    // }

    // document.getElementById("car_adv_form").addEventListener("submit", (e) => {
    function submitForm(){

        var form = document.getElementById('car_adv_form');

        var dataTransfer = new DataTransfer();

        // Loop through selected files and append them to the DataTransfer object
        for (var i = 0; i < selectedFiles.length; i++) {
            dataTransfer.items.add(selectedFiles[i]);
        }

        // Create a new file input and set its files property using the DataTransfer object
        var fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = 'add_images[]'; // Set the name attribute as needed
        fileInput.id = 'add_images'; // Set the id attribute as needed
        fileInput.multiple = true; // If you want to allow multiple file selection
        fileInput.files = dataTransfer.files;
        fileInput.style.display = 'none';

        // Append the file input to the form
        form.appendChild(fileInput);

        // You can add more parameters here if needed
        // console.log(additionalParam)


        // Submit the form
        form.submit();
    }

    $('#imageInput').on('change', function() {
        console.log('hi')
        var files = $(this)[0].files;
        var previewContainer = $('#imagePreview');

        // document.getElementById('loaderContainer').hidden = false;


        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
            selectedFiles.push(file);

            // reader.onloadstart = function () {
            //     document.getElementById('loaderContainer').hidden = false;
            // };

            reader.onload = function(e) {
                // document.getElementById('loaderContainer').hidden = true;
                var imageSrc = e.target.result;
                var previewItem = '<div class="col-2 mb-2"><img src="' + imageSrc + '" class="img-thumbnail" style="width:100%; height:100%" alt="Preview"><span class="delete-btn" onclick="deleteImage(this)">x</span></div>';
                previewContainer.append(previewItem);


            };

            reader.readAsDataURL(file);
        }
    });

    function deleteImage(deleteBtn) {

        var previewItem = $(deleteBtn).parent();
        var index = previewItem.index();

        selectedFiles.splice(index, 1);
        // Remove the corresponding preview item
        $(deleteBtn).parent().remove();
        // Clear the file input to allow re-selection of the same image
        $('#imageInput').val('');
    }
</script>
@endsection
