@extends('layouts.app')
@section('title')
    معرض السيارات
@endsection
@section('header_title')
    معرض السيارات
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
    معرض السيارات
@endsection
@section('style')
<style>
    body {
    /* font-family: 'Montserrat', sans-serif; */

}

/* Category Ads */

#ads {
    margin: 30px 0 0px 0;

}

#ads .card-notify-badge {
        position: absolute;
        left: -10px;
        top: -20px;
        background: #ffc107b0;
        text-align: center;
        border-radius: 30px 30px 30px 30px;
        color: #000;
        padding: 5px 10px;
        font-size: 14px;

    }

#ads .card-notify-year {
        position: absolute;
        right: -10px;
        top: -20px;
        background: #343a4085;
        border-radius: 50%;
        text-align: center;
        color: #fff;
        font-size: 14px;
        width: 50px;
        height: 50px;
        padding: 15px 0 0 0;
}


#ads .card-detail-badge {
        background: #343a4085;
        text-align: center;
        border-radius: 30px 30px 30px 30px;
        /* color: #000; */
        color: white;
        padding: 5px 10px;
        font-size: 14px;
    }



#ads .card-ad:hover {
            background: #fff;
            box-shadow: 12px 15px 20px 0px rgba(46,61,73,0.15);
            border-radius: 4px;
            transition: all 0.3s ease;
        }

#ads .card-image-overlay {
        font-size: 20px;

    }


#ads .card-image-overlay span {
            display: inline-block;
        }


#ads .ad-btn {
        text-transform: uppercase;
        width: 150px;
        height: 40px;
        border-radius: 80px;
        font-size: 16px;
        line-height: 35px;
        text-align: center;
        border: 3px solid #17a2b87a;
        display: block;
        text-decoration: none;
        margin: 20px auto 1px auto;
        color: #000;
        overflow: hidden;
        position: relative;
        background-color: white;
    }

#ads .ad-btn:hover {
            background-color: #ffc1078a;
            color: #1e1717;
            border: 2px solid #17a2b87a;
            background: transparent;
            transition: all 0.3s ease;
            box-shadow: 12px 15px 20px 0px rgba(46,61,73,0.15);
        }

#ads .ad-title h5 {
        text-transform: uppercase;
        font-size: 18px;
    }
</style>
@endsection
@section('content')

    <div class="row">
            <a class="btn btn-warning mb-2 mr-3" href="{{route('web_pages.cars_ads.choose_car_type')}}"><i class="fa fa-plus"></i> الإعلان عن سيارة</a>
    </div>

    <div class="row">
        <form id="searchForm" class="col-md-12" action="">
            <div class="card card-info">
                <div class="card-header">
                <h6 class="text-center">ابحث عن سيارة</h6>
                </div>
                <div class="card-body">
                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group">
                            {{-- <label>Date range:</label> --}}
                            <label for="from_date">من تاريخ</label>
                            <input id="from_date" class="form-control" name="from_date" type="date" />
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            {{-- <label>Date range:</label> --}}
                            <label for="to_date">إلى تاريخ</label>
                            <input id="to_date" class="form-control" name="to_date" type="date" />
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">نوع السيارة</label>
                            <select name="car_type" id="car_type" class="form-control select2" style="width:100%">
                                {{-- <option value="0">جميع السيارات</option> --}}
                                <option value="" selected>--اختيار--</option>
                                @foreach ($cars as $car)
                                <option value="{{$car->id}}">{{$car->car_type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">سنة التصنيع</label>
                            <select required id="production_year" name="production_year" class="form-control select2" style="width: 100%;">
                                <option value="" selected>--موديل سنة--</option>
                                @foreach ($years as $year)
                                <option value="{{$year}}">{{$year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">المنطقة</label>
                            <select name="city" id="city" class="form-control select2" style="width:100%">
                                <option value="" selected>--اختيار--</option>
                                @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->city_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 mt-2 pr-5 pt-4">
                        <div class="form-group">
                            {{-- <label for=""><a onclick="showAdvancedFilterModal()" style="cursor: pointer">البحث المتقدم <i class="fa fa-filter"></i></a> </label> --}}
                            {{-- <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#advanced_filter_modal">البحث المتقدم <i class="fa fa-filter"></i></button> --}}
                            <button type="button" class="btn btn-block btn-outline-secondary btn-flat" data-toggle="modal" data-target="#advanced_filter_modal">البحث المتقدم <i class="fa fa-filter"></i></button>

                        </div>
                    </div>

                </div>
                </div>
                <!-- /.card-body -->
            </div>
        </form>
    </div>



    <div class="row" id="ads">


    <!-- Category Card -->
    @foreach ($cars_ads as $adv)


        <div class="col-md-3 mt-3">
            <div class="card card-ad rounded">
                <div class="card-image">
                    <span class="card-notify-badge">{{$adv->view_for}}</span>
                    <span class="card-notify-year">{{$adv->car_model_year}}</span>
                    @if ($adv->pic_1 && file_exists(public_path('storage/uploads/carExpoPics/' . $adv->pic_1)))
                    <img class="img-fluid" src="{{ asset('storage/uploads/carExpoPics/' . $adv->pic_1) }}" alt="Alternate Text" />
                    @else
                        <img class="img-fluid" src="{{ asset('storage/uploads/systemPics/noImage.png') }}" alt="Photo" />
                    @endif
                </div>
                <div class="card-image-overlay m-auto">
                    <span class="card-detail-badge">{{$adv->diesel}}</span>
                    <span class="card-detail-badge">{{$adv->price}}</span>
                    <span class="card-detail-badge">{{$adv->geer_type}}</span>
                </div>
                <div class="card-body text-center">
                    <div class="ad-title m-auto">
                        <h5>{{$adv->model->model_name}}</h5>
                    </div>
                    <a class="ad-btn" href="{{route('web_pages.cars_ads.details', ['id' => $adv->id])}}">استعراض</a>
                </div>
            </div>
        </div>
    @endforeach




    </div>

    <!--the solution for the modal issue-->
    <div>
        @include('web_pages.cars_ads.modals.advanced_filter_modal')
    </div>

@endsection

@section('script')
<script>

    // function showAdvancedFilterModal(){
    //     $('#advanced_filter_modal').show();
    // }

    document.getElementById("advanced_filter_form").addEventListener("submit", (e) => {
        e.preventDefault();

        data = $('#advanced_filter_form').serialize();

        console.log(data);

        var csrfToken = $('meta[name="csrf-token"]').attr('content');


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            type: 'POST',
            url: "{{ route('web_pages.cars_ads.advanced_search') }}",
            data: data,
            dataType: 'json',
            success: function(response) {
                // $('#advanced_filter_modal').modal('hide');
                $("#advanced_filter_modal").modal("hide");

                // $('.modal-backdrop').remove();
                $('#ads').html(response.view);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

    });

    $('#searchForm').find(':input').each(function () {
        $(this).on('change', function () {

            // console.log($('#searchForm').serialize());

            var csrfToken = $('meta[name="csrf-token"]').attr('content');


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('web_pages.cars_ads.search') }}",
                data: $('#searchForm').serialize(),
                dataType: 'json',
                success: function(response) {
                    $('#ads').html(response.view);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

        });
    });
</script>
@endsection
