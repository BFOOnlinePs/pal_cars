@foreach ($cars_ads as $adv)


    <div class="col-md-3 mt-3">
            <div class="card rounded">
                <div class="card-image">
                    {{-- @if($adv->view_for)
                    @endif --}}
                    <span class="card-notify-badge">{{$adv->view_for}}</span>
                    <span class="card-notify-year">{{$adv->car_model_year}}</span>
                    {{-- <img class="img-fluid" src="https://imageonthefly.autodatadirect.com/images/?USER=eDealer&PW=edealer872&IMG=USC80HOC011A021001.jpg&width=440&height=262" alt="Alternate Text" /> --}}
                    @if ($adv->pic_1 && file_exists(public_path('storage/uploads/carExpoPics/' . $adv->pic_1)))
                    <img class="img-fluid" src="{{ asset('storage/uploads/carExpoPics/' . $adv->pic_1) }}" alt="Alternate Text" />
                                        {{-- <div class="row">
                                            <div class="col-4 mb-2">
                                                <img id="main_pic" src="{{ asset('storage/uploads/partExpoPics/' . $data->part_main_pic) }}" alt="Image" style="cursor: pointer;" onclick="openPic('{{$data->part_main_pic}}')" class="img-thumbnail">
                                            </div> --}}
                                            {{-- @if(!$images->isEmpty())
                                            @foreach ($images as $image)
                                            <div class="col-4 mb-2">
                                                <img src="{{ asset('storage/uploads/partExpoPics/' . $image->image_path) }}" alt="Image" style="cursor: pointer;" onclick="openPic('{{$image->image_path}}')" class="img-thumbnail">
                                            </div>
                                            @endforeach
                                            @endif --}}
                                        {{-- </div> --}}
                    @else
                        {{-- <img src="{{ asset('storage/uploads/systemPics/noImage.png') }}" width="100%" height="100%" alt="Photo"> --}}
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
                        {{-- <h5>Honda Accord LX</h5> --}}
                        <h5>{{$adv->model->model_name}}</h5>
                    </div>
                    <a class="ad-btn" href="{{route('web_pages.cars_ads.details', ['id' => $adv->id])}}">استعراض</a>
                </div>
            </div>
    </div>
@endforeach
