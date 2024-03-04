@extends('dashboard.layouts.app')
@section('title')
    الموديلات
@endsection
@section('header_title')
    الموديلات
@endsection
@section('header_link')
    <a href="{{route('dashboard.settings.cars_type.index')}}">أنواع السيارات</a>
@endsection
@section('header_title_link')
    الموديلات - {{$car_type}}
@endsection
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card card-info">
            <div class="card-header text-center">
              <h3 class="card-title">إضافة موديل سيارة لنوع سيارة {{$car_type}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="carsModelForm" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">موديل السيارة</label>
                  <input type="text" class="form-control" id="car_model" name="car_model" placeholder="ادخل موديل السيارة">
                </div>

                <input type="text" id="car_id" name="car_id" hidden value="{{$car_id}}">

                <div class="form-group">
                    <label for="formFile" class="form-label">صورة الموديل</label>
                    <input class="form-control" type="file" id="model_pic" name="model_pic">
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-info">إضافة</button>
              </div>
            </form>
          </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body p-0">
              <table class="table table-striped" id="carsModelsTable">
                    <thead>
                        <tr>
                          <th>موديل السيارة</th>
                          <th>استعراض صورة الموديل</th>
                          <th>حالة الموديل</th>
                          <th>العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                          @if ($data->isEmpty())
                          <tr>
                              <td colspan="3" class="text-center"><span>لا توجد بيانات</span></td>
                          </tr>
                          @else
                          @foreach ($data as $key)
                          <tr>
                              <td>{{$key->car_model}}</td>
                              <td>
                                @if ($key->car_model_pic && file_exists(public_path('storage/uploads/carModelsPics/' . $key->car_model_pic)))
                                    <img src="{{ asset('storage/uploads/carModelsPics/' . $key->car_model_pic) }}" style="cursor: pointer;" width="50px"  alt="" onclick="openPic({{$key}})">
                                @else
                                    <img src="{{ asset('storage/uploads/systemPics/noImage.png') }}" width="50px" alt="Photo">
                                @endif

                              </td>
                              <td>
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    {{-- <input onchange="change_status({{$key->id}},(this.checked) ?1:0)" @if($key->status == 1) checked @endif type="checkbox" class="custom-control-input" id="customSwitch3"> --}}
                                    <input onchange="change_status({{$key->id}},(this.checked) ?1:0)" @if($key->status == 1) checked @endif type="checkbox" class="custom-control-input" id="customSwitch{{$key->id}}">

                                    <label class="custom-control-label" for="customSwitch{{$key->id}}"></label>
                                </div>
                              </td>
                              <td>
                                {{-- <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                </div> --}}
                                <button class="btn btn-secondary" onclick="editCarModel({{$key}})"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger" onclick="deleteCarModel({{$key}})"><i class="fas fa-trash"></i></button>
                              </td>
                          </tr>
                          @endforeach
                          @endif
                      </tbody>
              </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>


    @include('dashboard.admin.settings.cars_models.modals.edit_car_model_modal')
    @include('dashboard.admin.settings.cars_models.modals.pic_modal')

</div>


@endsection
@section('script')
  <!-- jQuery -->
  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

  <!-- Bootstrap 4 -->
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
<script>
    // window.addEventListener('load',
    // function() {


    //     // $(document).ready(function(){
    //         var csrfToken = $('meta[name="csrf-token"]').attr('content');

    //         // Send an AJAX request with the CSRF token
    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': csrfToken
    //             }
    //         })
    //         $.ajax({
    //             type: 'POST',
    //             url: "{{ route('dashboard.settings.cities.get') }}",
    //             dataType: 'json',
    //             success: function(response) {
    //                 $('#citiesTable').html(response.view);
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error("error"+error);
    //             }
    //         });
    //     // });
    // }, false);

    function change_status(id,value){
        // console.log("hi")
        // console.log(id)
        // console.log(value)
        // id =
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: "{{ route('dashboard.settings.cars_type.change_status') }}",
            type: 'POST',
            data: {'id':id,'status':value},
            // contentType: false,
            // processData: false,
            success: function (response) {
                if(response.success == 'true'){
                    toastr.success(response.message)
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


    function openPic(data){
        var pic = data.car_model_pic;
        link= "storage/uploads/carModelsPics/"
        var assetPath = '{{ asset('') }}'+link+pic;
        // var x = '<img width="100%" height="100%" src="' + assetPath + pic + '" alt="Car Model">';
        var x = `<img width="100%" height="100%" src="${assetPath}" alt="Car Model">`;
        $('#modal_body').html(x);
        $('#pic_modal').modal('show');
    }


    document.getElementById("carsModelForm").addEventListener("submit", function (e){
        $(document).on('submit',function(e){

        })

            e.preventDefault();

            var formData = new FormData();
            var file = document.getElementById('model_pic').files[0];
            var carID = document.getElementById('car_id').value;
            var carModel = document.getElementById('car_model').value;

            formData.append('model_pic', file);
            formData.append('model', carModel);
            formData.append('car_id', carID);

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                url: "{{ route('dashboard.settings.cars_type.createCarModel') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    //let the table change
                    $('#carsModelsTable').html(response.view);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        // });
    });

    function editCarModel(data){
        document.getElementById('edit_model_name').value = data.car_model;
        document.getElementById('edit_model_id').value = data.id;
        $('#edit_car_model_modal').modal('show');
    }

    document.getElementById("EditCarModelForm").addEventListener("submit", function (e){

        e.preventDefault();

        var formData = new FormData();
        var file = null

        if(document.getElementById('edit_pic').files.length > 0){
            file = document.getElementById('edit_pic').files[0];
        }
        var carModel = document.getElementById('edit_model_name').value;
        var id = document.getElementById('edit_model_id').value;

        formData.append('model_pic', file);
        formData.append('car_model', carModel);
        formData.append('model_id', id);

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: "{{ route('dashboard.settings.cars_type.updateCarModel') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                //let the table change
                $('#carsModelsTable').html(response.view);
                $('#edit_car_model_modal').modal('hide');
            },
            error: function (error) {
                console.log(error);
            }
        });

    });

    function deleteCarModel(data){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: "{{ route('dashboard.settings.cars_type.deleteCarModel') }}",
            type: 'POST',
            data: { model_id: data.id },
            success: function (response) {
                //let the table change
                // console.log(response)
                $('#carsModelsTable').html(response.view);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

</script>
@endsection
