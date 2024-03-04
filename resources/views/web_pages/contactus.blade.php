@extends('layouts.app')
@section('title')
    Pal Cars | اتصل بنا
@endsection
@section('header_title')
    {{-- المستخدمين --}}
@endsection
@section('header_link')
    {{-- الرئيسية --}}
@endsection
@section('header_title_link')
    {{-- المستخدمين --}}
@endsection
@section('content')

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card card-info">
            {{-- <div class="card-header  text-center">
              <h3 class="card-title">اتصل بنا</h3>
            </div> --}}
            <div class="card-body">
                <div class="row">
                    <h4 class="col-md-12 text-center">نسعد بتواصلكم معنا واتصالكم بنا</h4>
                    <br>
                    <h4 class="col-md-12 text-center">يمكنكم ارسال ملاحظتكم واقتراحاتكم من خلال النموذج التالي</h4>
                </div>
                <hr>
                {{-- <br> --}}
                {{-- <br> --}}

                <div class="row" id="contact_form_container">

                    <div class="col-md-4 align-items-center" align="center">


                        <span class="text-info fas fa-envelope" style="font-size:150px;"> </span>

                    </div>

                    <div class="col-md-8">



                        <form id="suggestion_form">
                            <div class="form-group">
                                <label for="exampleInputEmail1">الاسم</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">معلومات التواصل</label>
                                <input type="text" class="form-control" name="contact">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">الرسالة/الاقتراح</label>
                                <textarea class="form-control" rows="3" name="content"></textarea>
                            </div>

                            <button type="submit" class="btn btn-secondary">إرسال الاقتراح</button>

                        </form>




                    </div>





                </div>




            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    document.getElementById('suggestion_form').addEventListener("submit", (e) => {
    e.preventDefault();
    data = $('#suggestion_form').serialize();

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    $.ajax({
        type: 'POST',
        url: "{{ route('web_pages.post_suggestion') }}",
        data: data,
        dataType: 'json',
        success: function(data) {
            if(data.success == 'true'){
                toastr.success(data.message)
            }
            else{
                toastr.error(data.message)
            }

            htmlText = `<div class="container text-center mt-3 mb-5">
                            <div class="display-1 text-success">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="lead text-success">
                                شكراً لك ! تم إرسال اقتراحك بنجاح
                            </div>
                        </div>`
            $('#contact_form_container').html(htmlText);
        },
        error: function(xhr, status, error) {
            console.error("error"+error);
        }
    });

})
</script>
@endsection
