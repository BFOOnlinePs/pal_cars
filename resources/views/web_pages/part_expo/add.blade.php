@extends('layouts.app')
@section('title')
    الإعلان عن قطعة
@endsection
@section('header_title')
    الإعلان عن قطعة متوفرة
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
<a href="{{route('web_pages.part_expo.index')}}">معرض القطع</a>
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
</style>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> ملاحظة : </h5>
            يمكنك من خلال النموذج التالي إضافة قطع سيارات متوفرة لديك إلى معرض القطع
        </div>
    </div>
</div>

<div class="row">
<div class="col-md-12">
    <div class="card card-info">

        <form role="form" id="add_part_form">
          <div class="card-body" id="contact_form_container">
            <div class="loader-container" id="loaderContainer" hidden>
                <div class="spinner-border">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            {{-- <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
              </div> --}}


            <h5 class=""><i class="fas fa-info-circle"></i> معلومات القطعة</h5>
            <hr>
            <div class="row">


                <div class="col-md-6">

                    <div class="form-group">
                        <label for="exampleInputEmail1">اسم القطعة</label>
                        <input type="text" class="form-control" id="part_name" name="part_name" required>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword1">الحالة</label>
                        <div class="checkbox-group">
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="status" value="1" required>
                                  <label class="form-check-label" for="checkbox1">جديد</label>
                              </div>

                              <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="status" value="2" required>
                                  <label class="form-check-label" for="checkbox2">مستخدم</label>
                              </div>

                              <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="status" value="3" required>
                                  <label class="form-check-label" for="checkbox3">مجدد</label>
                              </div>

                              <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="status" value="4" required>
                                  <label class="form-check-label" for="checkbox4">تقليد</label>
                              </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">السعر</label>
                        <input type="number" class="form-control" id="part_price" name="part_price" required>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword1">معلومات القطعة</label>
                        <textarea class="form-control" name="part_desc" id="part_desc" rows="5" required></textarea>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword1">صورة أساسية</label>
                        <input type="file" name="primary_image" id="primary_image" class="form-control">
                    </div>


                    <h5 class="alert alert-info row">
                        <span class="col-md-4 mt-2"><i class="fa fa-plus"></i> صور إضافية للقطعة</span>
                        <input type="file" class="form-control col-md-2" id="imageInput" style="background-color: transparent;
                        border: transparent;" name="images[]" multiple>
                    </h5>


                    <div class="form-group">
                        {{-- <label for="exampleInputPassword1">اختيار الصور</label> --}}

                        <div class="row" class="preview-container" id="imagePreview">

                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card" style="height: ;">
                        <div class="card-header  bg-gradient-warning">
                            <h5 class=""><i class="fa fa-car"></i> معلومات السيارة الخاصة بالقطعة</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">نوع السيارة</label>
                                <select required id="car_type" name="car_type" class="form-control select2" onchange="updateModels()" style="width: 100%;">
                                    <option value="" disabled selected>--اختيار--</option>
                                    @foreach ($cars as $car)
                                    <option value="{{$car->id}}">{{$car->car_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">الموديلات المتوافقة - <a id="add_model_area" class="text-info" style="cursor: pointer" onclick="$('#add_car_model_modal').modal('show');" hidden>(في حال لا يوجد الموديل الذي تريده، اضغط هنا لإضافته)</a></label>
                                <select class="form-control select2bs4" multiple="multiple"  id="car_models" name="car_models" style="width: 100%;" onchange="updateYears()">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">سنوات الموديلات</label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="selectedPairsTable">
                                        <thead>
                                            <tr>
                                                <th style="display:none;"></th>
                                                <th>اسم الموديل</th>
                                                <th>السنوات</th>
                                                <th>إضافة سنوات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                {{-- <td>test model</td>
                                                <td>2015,2016,2017</td>
                                                <td><button class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button><td> --}}
                                                <td colspan="3" class="text-center" style="background-color: rgba(222, 220,220, 0.304)">لم يتم اختيار موديلات بعد</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <input hidden id="years_models_part" name="years_models_part">
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6" style="text-align: left;">
                    <button type="submit" class="btn btn-success mx-auto"> <i class="fa fa-plus"></i> إضافة القطعة</button>
                </div>
            </div>

          </div>
          <!-- /.card-body -->

        </form>




    </div>
</div>

@include('web_pages.part_expo.modals.set_years_modal')
@include('web_pages.part_expo.modals.add_car_model_modal')

</div>


@endsection

@section('script')
<script>

    var models_years_array = [];
    var selectedFiles = [];
    models_array =[];

    @auth
        var userId = {{ auth()->user()->id }};
    @else
        var userId = null; // or any default value you want to assign when the user is not authenticated
    @endauth

    // Now you can use the userId variable in your JavaScript code
    // console.log('User ID:', userId);

    $('#add_model_button').on('click', function() {
        model_name = $('#new_model_name').val();
        car_type = $('#car_type').val();


        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: "{{ route('web_pages.part_expo.add_temp_car_model') }}",
            type: 'POST',
            data: {'model_name':model_name,'car_type':car_type},
            // contentType: false,
            // processData: false,
            success: function (response) {
                if(response.success=="true"){
                    $("#car_models").append("<option value='" + response.model.id + "'>" + response.model.car_model + "</option>");
                    $('#add_car_model_modal').modal('hide');
                }
            },
            error: function (error) {
                console.log(error);
            }
        });


    });

    document.getElementById("add_part_form").addEventListener("submit", (e) => {
        e.preventDefault();

        console.log(models_array);

        var formData = new FormData();

        primary_image = document.getElementById('primary_image').files[0];

        console.log(primary_image);
        console.log(selectedFiles);

        formData.append('primary_image', primary_image);
        selectedFiles.forEach(function (file) {
            formData.append('other_images[]', file);
        });

        formData.append('status', $('input[name="status"]:checked').val());
        formData.append('price', $('#part_price').val());
        formData.append('name', $('#part_name').val());
        formData.append('description', $('#part_desc').val());
        formData.append('car_type', $('#car_type').val());
        formData.append('years_models_part', $('#years_models_part').val());
        formData.append('user_id', userId);
        formData.append('car_models', JSON.stringify(models_array));

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: "{{ route('web_pages.part_expo.add_part') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if(response.success=="true"){
                    htmlText = `<div class="container text-center mt-3 mb-5">
                            <div class="display-1 text-success">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="lead text-success">
                                لقد تم إضافة القطعة بنجاح
                            </div>
                        </div>`
                    $('#contact_form_container').html(htmlText);
                }
            },
            error: function (error) {
                console.log(error);
            }
        });

    })

    document.getElementById("set_years_form").addEventListener("submit", (e) => {
        e.preventDefault();

        id = document.getElementById('model_year_id').value;;
        years=$('#years').val();
        text="";

        //to check if the user rechoose the years for a model return true if duplicate, false if not
        duplicate_years = models_years_array.some(entry => entry.model === id)

        if(!duplicate_years){
            var pair = {
                    model: id,
                    years: years
                };
            models_years_array.push(pair);
        }else{//if the user rechoose another years for a model
            const duplicateIndex = models_years_array.findIndex(entry => entry.model === id);
            models_years_array.splice(duplicateIndex, 1, { model: id, years: years });
        }

        document.getElementById('years_models_part').value = JSON.stringify(models_years_array);

        years.forEach(function(year, index) {
            text=text + year
            if (index < years.length - 1) {
                text = text + ", ";
            }
        })

        var model_id = `#years_${id}`;

        //to set the selectes years text in the <td></td>
        $(model_id).text(text);

        $('#set_years_modal').modal('hide');
    });

    function select_years(id){
        document.getElementById('model_year_id').value = id;
        var yearsDropdown = $("#years");

        // Clear existing options
        yearsDropdown.empty();

        var currentYear = new Date().getFullYear();
        var startYear = 1990;

        for (var year = currentYear; year >= startYear; year--) {
            yearsDropdown.append("<option value='" + year + "'>" + year + "</option>");
        }

        $('#set_years_modal').modal('show');
    }

    function updateYears(){
        var selectedPairs = [];


        models_array = $('#car_models').val();

        //IMPORTANT
        //هون فيه عندي حالة انه لما يحذف موديل ويكون مختار السنوات اله ويعاود يرجعه بجيب السنوات اللي تم اختيارها
        // بال: models_years_array

        $('#car_models option:selected').each(function() {
            var pair = {
                value: $(this).val(),
                text: $(this).text()
            };
            selectedPairs.push(pair);
        });

        $('#selectedPairsTable tbody').empty();

        selectedPairs.forEach(function(pair) {
            var years_text = '-';

            // console.log(pair.value);
            // console.log(models_years_array.some(entry => entry.model === pair.value));

            if(models_years_array.some(entry => entry.model === pair.value)){
                years= models_years_array
                .filter(entry => entry.model === pair.value)
                .flatMap(entry => entry.years);

                text = "";

                years.forEach(function(year, index) {
                    text=text + year
                    if (index < years.length - 1) {
                        text = text + ", ";
                    }
                })
                years_text = text;
            }
            var x = `<tr>
                <td hidden>${pair.value}</td>
                <td>${pair.text}</td>
                <td id="years_${pair.value}">${years_text}</td>
                <td><button type="button" class="btn btn-sm btn-success" onclick="select_years(${pair.value})"><i class="fa fa-plus"></i></button></td>
            </tr>`;

            $('#selectedPairsTable tbody').append(x);
        });

        // Log the selected pairs to the console (you can handle them as needed)
        // console.log('Selected Pairs:', selectedPairs);
    }

    function updateModels() {

        document.getElementById('add_model_area').hidden = false;

        var id = $('#car_type').val();

        // console.log(id)

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: '{{ url('web_pages/part_expo/get_models') }}' + '/' + id,
            type: 'GET',
            // data: { id: id },
            success: function (response) {
                console.log(response.models)
                updateModelsDropdown(response.models);
            },
            error: function (error) {
                console.log(error);
            }
        });


    }

    function updateModelsDropdown(models) {
            var carModelsDropdown = $("#car_models");

            // Clear existing options
            carModelsDropdown.empty();

            // Add new options based on the fetched models
            models.forEach(function(model) {
                carModelsDropdown.append("<option value='" + model.id + "'>" + model.car_model + "</option>");
            });
    }

    // function uploadImages() {
    //     var formData = new FormData($('#imageForm')[0]);

    //     $.ajax({
    //         url: 'your_upload_endpoint.php', // Replace with your server-side upload endpoint
    //         type: 'POST',
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         success: function(response) {
    //             // Handle success, e.g., display a success message
    //             alert('Images uploaded successfully!');
    //             // Clear the file input
    //             $('#imageInput').val('');
    //         },
    //         error: function(error) {
    //             // Handle errors, e.g., display an error message
    //             console.error('Error uploading images:', error);
    //         }
    //     });
    // }

    $('#imageInput').on('change', function() {
        var files = $(this)[0].files;
        var previewContainer = $('#imagePreview');

        document.getElementById('loaderContainer').hidden = false;


        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
            selectedFiles.push(file);

            // reader.onloadstart = function () {
            //     document.getElementById('loaderContainer').hidden = false;
            // };

            reader.onload = function(e) {
                document.getElementById('loaderContainer').hidden = true;
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
