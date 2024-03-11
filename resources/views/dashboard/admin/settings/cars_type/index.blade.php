@extends('dashboard.layouts.app')
@section('title')
    أنواع السيارات
@endsection
@section('header_title')
    أنواع السيارات
@endsection
@section('header_link')
    <a href="{{route('dashboard.settings.index')}}">الإعدادات</a>
@endsection
@section('header_title_link')
    أنواع السيارات
@endsection
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card card-info">
            <div class="card-header text-center">
              <h3 class="card-title">إضافة نوع سيارة</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="carsTypeForm" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">نوع السيارة</label>
                  <input type="text" class="form-control" id="car_type" name="car_type" placeholder="ادخل نوع السيارة">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">ملاحظات</label>
                    <input type="text" class="form-control" id="note" name="note" placeholder="ملاحظة">
                </div>

                <div class="form-group">
                    <label for="formFile" class="form-label">الشعار</label>
                    <input class="form-control" type="file" id="logo" name="logo">
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
              <table class="table table-striped" id="carsTypeTable">
                    <thead>
                        <tr>
                          <th>نوع السيارة</th>
                          <th>الشعار</th>
                          <th>العمليات</th>
                          <th>إدارة الموديلات</th>
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
                              <td>{{$key->car_type}}</td>
                              <td><img src="{{ asset('storage/uploads/carTypeLogo/' . $key->logo) }}" width="50px" alt=""></td>
                              <td>
                                <button class="btn btn-secondary btn-sm" onclick="editCarType({{$key}})"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" onclick="deleteCarType({{$key}})"><i class="fas fa-trash"></i></button>
                              </td>
                              <td><a class="btn btn-info btn-sm text-center" href="{{route("dashboard.settings.cars_type.car_models",["id"=>$key->id])}}"><i class="fas fa-search"></i></a></td>
                          </tr>
                          @endforeach
                          @endif
                      </tbody>

              </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    @include('dashboard.admin.settings.cars_type.modals.edit_car_type_modal')

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

    document.getElementById("carsTypeForm").addEventListener("submit", function (e){

            e.preventDefault();

            var formData = new FormData();
            var file = document.getElementById('logo').files[0];
            var carType = document.getElementById('car_type').value;
            var note = document.getElementById('note').value;

            formData.append('logo', file);
            formData.append('car_type', carType);
            formData.append('note', note);

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                url: "{{ route('dashboard.settings.cars_type.create') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    var car_type_form = document.getElementById('carsTypeForm');
                    car_type_form.reset();
                    $('#carsTypeTable').html(response.view);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        // });
    });

    function editCarType(data){
        document.getElementById('edit_type_name').value = data.car_type;
        document.getElementById('edit_type_id').value = data.id;
        document.getElementById('edit_note').value = data.note;
        $('#edit_car_type_modal').modal('show');
    }

    document.getElementById("EditCarTypeForm").addEventListener("submit", function (e){

        e.preventDefault();

        var formData = new FormData();
        var file = null

        if(document.getElementById('edit_logo').files.length > 0){
            // console.log("hiiii")
            file = document.getElementById('edit_logo').files[0];
        }
        var carType = document.getElementById('edit_type_name').value;
        var note = document.getElementById('edit_note').value;
        var id = document.getElementById('edit_type_id').value;

        formData.append('logo', file);
        formData.append('car_type', carType);
        formData.append('note', note);
        formData.append('type_id', id);

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: "{{ route('dashboard.settings.cars_type.update') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                //let the table change
                $('#carsTypeTable').html(response.view);
                $('#edit_car_type_modal').modal('hide');
            },
            error: function (error) {
                console.log(error);
            }
        });

    });

    function deleteCarType(data){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: "{{ route('dashboard.settings.cars_type.delete') }}",
            type: 'POST',
            data: { type_id: data.id },
            success: function (response) {
                //let the table change
                // console.log(response)
                $('#carsTypeTable').html(response.view);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

</script>
@endsection
