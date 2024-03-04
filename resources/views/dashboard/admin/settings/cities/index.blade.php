@extends('dashboard.layouts.app')
@section('title')
    المدن
@endsection
@section('header_title')
    المدن
@endsection
@section('header_link')
    <a href="{{route('dashboard.settings.index')}}">الإعدادات</a>
@endsection
@section('header_title_link')
    المدن
@endsection
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card card-info">
            <div class="card-header text-center">
              <h3 class="card-title">إضافة مدينة</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="cityForm" method="POST" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">المدينة</label>
                  <input type="text" class="form-control" id="city" name="city" placeholder="ادخل اسم المدينة">
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
            {{-- <div class="card-header">
              <h3 class="card-title">Striped Full Width Table</h3>
            </div> --}}
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-striped" id="citiesTable">

              </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>


    @include('dashboard.admin.settings.cities.modals.edit_city_modal')

</div>


@endsection
@section('script')
<script>

window.addEventListener('load',
  function() {


    // $(document).ready(function(){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Send an AJAX request with the CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
        $.ajax({
            type: 'POST',
            url: "{{ route('dashboard.settings.cities.get') }}",
            dataType: 'json',
            success: function(response) {
                $('#citiesTable').html(response.view);
            },
            error: function(xhr, status, error) {
                console.error("error"+error);
            }
        });
    // });
}, false);

document.getElementById("cityForm").addEventListener("submit", (e) => {
           e.preventDefault();

           if(document.getElementById("city").value != ""){

            }else{

                $('#city').removeClass('input-is-invalid');
                data = $('#cityForm').serialize();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Send an AJAX request with the CSRF token
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ route('dashboard.settings.cities.create') }}",
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response.success)
                        $('#citiesTable').html(response.view);
                        document.getElementById('city').value="";
                    },
                    error: function(xhr, status, error) {
                        console.error("error"+error);
                    }
                });
            }
});

function editCity(city){
    document.getElementById('edit_city_name').value = city.city_name;
    document.getElementById('edit_city_id').value = city.id;
    $('#edit_city_modal').modal('show');
}

document.getElementById("EditCityForm").addEventListener("submit", (e) => {
    e.preventDefault();

    //    if(document.getElementById("edit_cc_name").value == ""){
    //         $('#edit_cc_name').addClass('input-error');
    //     }else{

        data = $('#EditCityForm').serialize();
        console.log(data)
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Send an AJAX request with the CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            type: 'POST',
            url: "{{ route('dashboard.settings.cities.update') }}",
            data: data,
            dataType: 'json',
            success: function(response) {
                $('#edit_city_modal').modal('hide');
                $('#citiesTable').html(response.view);
            },
            error: function(xhr, status, error) {
                console.error("error"+error);
            }
        });
    // }
});

</script>
@endsection
