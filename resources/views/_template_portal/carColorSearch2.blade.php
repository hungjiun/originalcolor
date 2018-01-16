@extends('_template_portal._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link type="text/css" rel="stylesheet" href="/portal_assets/css/index.css" />
    <link type="text/css" rel="stylesheet" href="/portal_assets/css/carNumber.css" />
@endsection
<!-- ================== /page-css ================== -->

@section('title', $sysDealer->vDealerName)

<!-- content -->
@section('content')
<div class="container text-center">
	<div class="titleImg"><h1><img src="/portal_assets/images/car_number.svg" alt="補漆筆-車廠查詢"></h1></div>
    <!--<div class="desc">此頁操作步驟：選擇車種，再選擇車型，即可找到您愛車所屬顏色</div>-->

    @foreach($dealerCarColors as $key => $var)
    <div class="logoBlock">
        <div class="col-sm-5 col-xs-12">
            <div class="title"><h2><small> {{$var->vCarColorName}}</small></h2></div>
            <div class="desc">請選{{$var->iPenNumber}}號</div>
        </div>
    </div>
    @endforeach
</div>
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
@endsection
<!-- ================== /inline-js ================== -->