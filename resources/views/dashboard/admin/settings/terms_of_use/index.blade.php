@extends('dashboard.layouts.app')
@section('title')
    شروط الاستخدام
@endsection
@section('header_title')
    شروط الاستخدام
@endsection
@section('header_link')
    <a href="{{route('dashboard.settings.index')}}">الإعدادات</a>
@endsection
@section('header_title_link')
    شروط الاستخدام
@endsection
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@endsection
@section('content')

<div class="row">

    <div class="col-md-12">
    <div class="callout callout-info">
        <h5><i class="fas fa-info"></i> ملاحظة:</h5>
        في هذا القسم يمكنك التعديل على شروط الاستخدام
    </div>
    </div>

</div>

<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">شروط الاستخدام</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" id="terms_of_use_form">
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">الشروط</label>
          <textarea name="terms_of_use" class="form-control" id="summernote" rows="12" placeholder="">{{$data->terms_of_use}}</textarea>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-secondary">تعديل</button>
      </div>
    </form>
  </div>

@endsection
@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

<script>

$(document).ready(function() {
    $('#summernote').summernote({
        height: 120
    });
});

document.getElementById("terms_of_use_form").addEventListener("submit", (e) => {
    e.preventDefault();
    data = $('#terms_of_use_form').serialize();

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    $.ajax({
        type: 'POST',
        url: "{{ route('dashboard.settings.terms_of_use.update') }}",
        data: data,
        dataType: 'json',
        success: function(data) {
            if(data.success == 'true'){
                toastr.success(data.message)
            }
            else{
                toastr.error(data.message)
            }
        },
        error: function(xhr, status, error) {
            console.error("error"+error);
        }
    });

})

</script>
@endsection
