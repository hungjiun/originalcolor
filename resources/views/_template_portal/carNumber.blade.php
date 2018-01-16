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
	<div class="titleImg"><h1><img src="images/car_number.svg" alt="補漆筆-車廠查詢"></h1></div>
    <div class="desc">此頁操作步驟：選擇車種，再選擇車型，即可找到您愛車所屬顏色</div>

    <div class="logoBlock">
        <div class="col-sm-7 col-xs-12">
            <img src="images/color/audi/a1/a1_01.png">
        </div>
        <div class="col-sm-5 col-xs-12">
            <div class="title"><h2>Madza3<small>玄武灰</small></h2></div>
            <div class="desc">請選05號</div>
        </div>
    </div>
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