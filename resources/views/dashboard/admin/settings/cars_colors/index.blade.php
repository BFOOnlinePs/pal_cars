@extends('dashboard.layouts.app')
@section('title')
    ألوان السيارات
@endsection
@section('header_title')
     ألوان السيارات
@endsection
@section('header_link')
    <a href="{{route('dashboard.settings.index')}}">الإعدادات</a>
@endsection
@section('header_title_link')
     ألوان السيارات
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
</style>
@endsection
@section('content')

<div class="row">

    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-body">

                <h2 class="text-center">إدارة ألوان السيارات</h2>

                <!-- Add Color Form -->
                <form id="add_color_form">
                    <div class="form-group">
                        <label for="colorName">اسم اللون</label>
                        <input type="text" class="form-control" id="colorName" required>
                    </div>
                    <button type="submit" class="btn btn-info">إضافة اللون</button>
                </form>

                <!-- Colors Table -->
                <div class="row">
                    <div class="col-md-12 mt-3" id="car_colors_table">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                {{-- <table class="table mt-3"> --}}
                                <thead>
                                <tr>
                                    <th>اللون</th>
                                    <th>تعديل</th>
                                </tr>
                                </thead>
                                <tbody id="colorsTableBody">
                                    @if ($data->isEmpty())
                                        <tr>
                                            <td colspan="2" class="text-center"><span>لا توجد بيانات</span></td>
                                        </tr>
                                    @else
                                        @foreach ($data as $key)
                                            <tr>
                                                <td>{{$key->color}}</td>
                                                <td><button class="btn btn-sm btn-success text-white" onclick="edit_color({{$key}})"><i class="fas fa-edit"></i></button></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    @include('dashboard.admin.settings.cars_colors.modals.edit_color_modal')
</div>

@endsection

@section('script')
<script>
    document.getElementById("add_color_form").addEventListener("submit", (e) => {

        e.preventDefault();

        color = $('#colorName').val();

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: "{{ route('dashboard.settings.cars_colors.add') }}",
            type: 'POST',
            data: { color: color },
            success: function (response) {
                if(response.success == 'true'){
                    $('#colorName').val("");
                    toastr.success(response.message);
                    $('#car_colors_table').html(response.view);
                }
                else{
                    toastr.error(response.message)
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    })

    function edit_color(data){
        color = data.color;
        id = data.id;
        document.getElementById('edit_color_name').value = color;
        document.getElementById('edit_color_id').value = id;
        $('#edit_color_modal').modal('show');
    }

    document.getElementById("edit_color_form").addEventListener("submit", (e) => {

        e.preventDefault();

        data = $('#edit_color_form').serialize();
        // console.log(data)
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Send an AJAX request with the CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            type: 'POST',
            url: "{{ route('dashboard.settings.cars_colors.update') }}",
            data: data,
            dataType: 'json',
            success: function(response) {
                if(response.success == 'true'){
                    toastr.success(response.message);
                    $('#edit_color_modal').modal('hide');
                    $('#car_colors_table').html(response.view);
                }
                else{
                    toastr.error(response.message)
                }

            },
            error: function(xhr, status, error) {
                console.error("error"+error);
            }
        });
    // }
    });
</script>
@endsection
