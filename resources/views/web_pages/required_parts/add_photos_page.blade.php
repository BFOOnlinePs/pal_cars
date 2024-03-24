@extends('layouts.app')
@section('title')
    إضافة صور للعرض
@endsection
@section('header_title')
    إضافة صور للعرض
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
    إضافة صور للعرض
@endsection
@section('style')
<style>
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-body {
        padding: 30px;
    }
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
</style>
@endsection
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="container text-center mt-3 mb-5">
                    <div class="display-1 text-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="lead text-success">
                       لقد تم إرسال عرض السعر الخاص بك بنجاح !
                        <br>
                        يمكنك أيضاً إضافة صور للعرض المُرسل أو التخطي من خلال الضغط على زر المتابعة والإنهاء
                    </div>
                </div>
            </div>
        </div>
        <form id="offer_photos_form" action="{{ route('web_pages.required_parts.create_offer_photos') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <input hidden name="offer_id" value="{{$id}}">
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
            </div>
        </form>
        <button class="btn btn-success" type="button" onclick="submitForm()">المتابعة والإنهاء</button>
    </div>
</div>

@endsection
@section('script')
<script>
    var selectedFiles = [];

    function submitForm(){

        var form = document.getElementById('offer_photos_form');

        var dataTransfer = new DataTransfer();

        if(selectedFiles.length !=0){
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
        }
        
        form.submit();
    }

    $('#imageInput').on('change', function() {
        var files = $(this)[0].files;
        var previewContainer = $('#imagePreview');

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
            selectedFiles.push(file);

            reader.onload = function(e) {
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
