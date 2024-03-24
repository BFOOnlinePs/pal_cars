@extends('layouts.app')
@section('title')
    طلب قطعة سيارة
@endsection
@section('header_title')
    طلب قطعة سيارة
@endsection
@section('header_link')
    <a href="{{route('web_pages.required_parts.index')}}">القطع المطلوبة</a>
@endsection
@section('header_title_link')
    طلب قطعة سيارة
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
    <div class="col-md-8 mx-auto">
        <div class="callout callout-info" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;">
            <h5><i class="fas fa-info"></i> ملاحظة : </h5>
            يمكنك من خلال النموذج التالي طلب قطعة سيارة
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card-body">
            <form id="car_part_form" action="{{ route('web_pages.required_parts.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" hidden name="car_type_id" value="{{$car_type->id}}">
                <h3 class=""style="background-color:"> <i class="fa fa-car"></i>معلومات السيارة</h3>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">نوع السيارة <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="car_type" name="car_type" disabled value="{{$car_type->car_type}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">موديل السيارة <span class="text-danger">*</span></label>
                            <select required id="car_model" name="car_model" class="form-control select2" style="width: 100%;">
                                <option value="0">--اختيار الموديل--</option>
                                @foreach ($car_models as $model)
                                <option value="{{$model->id}}">{{$model->car_model}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="exampleInputEmail1">نص موديل السيارة <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="car_model_text" name="car_model_text" placeholder="قم بإدخال موديل السيارة في حال لم يكن موجود" required>
                        </div>
                    </div>


                </div>
                <div class="row">

                    <div class="col-md-4">
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

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">نوع الموتور <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="car_counter_type" name="car_counter_type" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">حجم الماتور <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="motor_size" name="motor_size" required>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-5">
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

                    <div class="col-md-5">
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

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">الإضافات المتوفرة <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="notes" id="notes" rows="5"></textarea>
                        </div>
                    </div>
                </div>

                {{-- <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">صور إضافية</label>
                            <input type="file" name="images[]" id="imageInput" class="form-control" multiple>
                        </div>

                        <div class="row">
                            <div class="form-group">

                                <div class="row" class="preview-container" id="imagePreview"></div>

                            </div>
                        </div>

                    </div>

                </div> --}}



                <br>
                <h3 class=""style="background-color:"> <i class="fa fa-info-circle"></i> معلومات القطعة المطلوبة</h3>
                <hr>


                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">القطعة المطلوبة <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="part" id="part" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">حالة القطعة المطلوبة</label>
                            <div class="checkbox-group mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="new_part" name="new_part" value="جديد">
                                    <label class="form-check-label" for="status1">جديد</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="used_part" name="used_part" value="مستخدم">
                                    <label class="form-check-label" for="status2">مستخدم</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="renovated_part" name="renovated_part" value="مجدد">
                                    <label class="form-check-label" for="status3">مجدد</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="copying_part" name="copying_part" value="تقليد">
                                    <label class="form-check-label" for="status4">تقليد</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">معلومات إضافية <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="additional_info" id="additional_info" rows="5"></textarea>
                        </div>
                    </div>


                </div>


                <h3 class=""style="background-color:"> <i class="fa fa-bullhorn"></i> معلومات المنطقة</h3>
                <hr>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">المنطقة <span class="text-danger">*</span></label>
                            <select required id="city" name="city" class="form-control select2" style="width: 100%;">
                                @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->city_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">العنوان <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" id="address" rows="5"></textarea>
                        </div>
                    </div>

                </div>

                {{-- <button type="submit" class="btn btn-success">إضافة الإعلان</button> --}}
                <button type="button" onclick="submitForm()" class="btn btn-success"><i class="fa fa-plus"></i> طلب قطعة</button>
            </form>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('script')
<script>
    // var selectedFiles = [];


    //     var form = document.getElementById('car_adv_form');
    //     console.log('hi')
    //     form.submit();
    // }

    // document.getElementById("car_adv_form").addEventListener("submit", (e) => {
    function submitForm(){

        var form = document.getElementById('car_part_form');

        // var dataTransfer = new DataTransfer();

        // // Loop through selected files and append them to the DataTransfer object
        // for (var i = 0; i < selectedFiles.length; i++) {
        //     dataTransfer.items.add(selectedFiles[i]);
        // }

        // // Create a new file input and set its files property using the DataTransfer object
        // var fileInput = document.createElement('input');
        // fileInput.type = 'file';
        // fileInput.name = 'add_images[]'; // Set the name attribute as needed
        // fileInput.id = 'add_images'; // Set the id attribute as needed
        // fileInput.multiple = true; // If you want to allow multiple file selection
        // fileInput.files = dataTransfer.files;
        // fileInput.style.display = 'none';

        // // Append the file input to the form
        // form.appendChild(fileInput);

        // You can add more parameters here if needed
        // console.log(additionalParam)


        // Submit the form
        form.submit();
    }

    // $('#imageInput').on('change', function() {
    //     console.log('hi')
    //     var files = $(this)[0].files;
    //     var previewContainer = $('#imagePreview');

    //     // document.getElementById('loaderContainer').hidden = false;


    //     for (var i = 0; i < files.length; i++) {
    //         var file = files[i];
    //         var reader = new FileReader();
    //         selectedFiles.push(file);

    //         // reader.onloadstart = function () {
    //         //     document.getElementById('loaderContainer').hidden = false;
    //         // };

    //         reader.onload = function(e) {
    //             // document.getElementById('loaderContainer').hidden = true;
    //             var imageSrc = e.target.result;
    //             var previewItem = '<div class="col-2 mb-2"><img src="' + imageSrc + '" class="img-thumbnail" style="width:100%; height:100%" alt="Preview"><span class="delete-btn" onclick="deleteImage(this)">x</span></div>';
    //             previewContainer.append(previewItem);


    //         };

    //         reader.readAsDataURL(file);
    //     }
    // });

    // function deleteImage(deleteBtn) {

    //     var previewItem = $(deleteBtn).parent();
    //     var index = previewItem.index();

    //     selectedFiles.splice(index, 1);
    //     // Remove the corresponding preview item
    //     $(deleteBtn).parent().remove();
    //     // Clear the file input to allow re-selection of the same image
    //     $('#imageInput').val('');
    // }
</script>
@endsection
