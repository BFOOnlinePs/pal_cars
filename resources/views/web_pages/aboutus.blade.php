@extends('layouts.app')
@section('title')
    Pal Cars | من نحن
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
        <div class="callout">
            <div class="container about-section">
                <div class="row">
                  <div class="col-md-4">
                    <img src="{{ asset('storage/uploads/systemPics/palcars.jpg') }}" width="300" alt="About Us Image" class="about-image">
                  </div>
                  <div class="col-md-8">
                    <br>
                    <h2>من نحن</h2>
                    <hr>
                    <p>بال كارز هو موقع الكتروني طورته شركة بال بورتال للتسويق الإلكتروني. يهدف الموقع لتقديم خدمات لأصحاب الكراجات ومحلات وشركات قطع السيارات وشركات التأمين وشركات السيارات. حيث يمكن للأصحاب الكراجات طلب القطع المختلفة للسيارات من خلال الموقع والحصول على عروض أسعار مباشرة وخلال وقت قصير من محلات قطع السيارات وينطبق ذلك على شركات التأمين وشركات السيارات. كل ذلك سيؤدي الى تقليل التكلفة على المواطن الذي يحتاج لصيانة مركبته وذلك من خلال الحصول على أقل الأسعار للقطع المطلوبة. كما يقدم الموقع العديد من الخدمات المتعلقة بالسيارات.
                    </p>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
