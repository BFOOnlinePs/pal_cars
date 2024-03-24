@extends('layouts.app')
@section('title')
    عروض بواسطتي
@endsection
@section('header_title')
    عروض بواسطتي
@endsection
@section('header_link')
    <a href="{{route('web_app_home')}}">الرئيسية</a>
@endsection
@section('header_title_link')
    عروض بواسطتي
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

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12" id="part_expo_table">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>القطعة المطلوبة</th>
                            <th>تاريخ تقديم العرض</th>
                            <th>سعر العرض للقطعة الجديدة</th>
                            <th>ملاحظات</th>
                            <th>تم مشاهدة العرض المٌقدم</th>
                            <th>تفاصيل العرض المُقدم بواسطتي</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($data->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center"><span>لا توجد بيانات</span></td>
                            </tr>
                        @else
                        @foreach ($data as $key)
                            <tr>
                                <td>
                                    {{-- <button class="btn btn-success">{{$key->request->part_request}}</button> --}}
                                    <a href="{{ route('web_pages.required_parts.requested_part_details', ['id' => $key->request_id]) }}" class="btn btn-success">{{$key->request->part_request}}</a>
                                </td>
                                <td>{{$key->created_at}}</td>
                                <td>{{$key->price_offer}}</td>
                                <td>{{$key->offer_detail}}</td>
                                <td>
                                    @if($key->seen==0)
                                        <small class="badge badge-warning">لم يُشاهد بعد</small>
                                    @else
                                        <small class="badge badge-success"> تمت مشاهدته</small>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('web_pages.required_parts.offer_details', ['id' => $key->id]) }}" class="btn btn-sm btn-success text-white"><i class="fas fa-search"></i></a>
                                </td>

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

@endsection
