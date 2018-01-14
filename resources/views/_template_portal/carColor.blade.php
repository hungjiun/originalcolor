@extends('_template_portal._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link type="text/css" rel="stylesheet" href="/portal_assets/css/index.css" />
    <link type="text/css" rel="stylesheet" href="/portal_assets/css/carColor.css" />
@endsection
<!-- ================== /page-css ================== -->

@section('title', $sysDealer->vDealerName)

<!-- content -->
@section('content')
<div class="container text-center">
	<div class="titleImg"><h1><img src="images/car_color.svg" alt="補漆筆-車廠查詢"></h1></div>
    <div class="desc">此頁操作步驟：選擇車種，再選擇車型，即可找到您愛車所屬顏色</div>

    <div class="logoArea">
        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail">
                <img src="images/color/audi/a1/a1_01.png">
                <p><h3>CIVIC<small>雲朵白</small></h3></p>
            </div>
        </div>
        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail">
                <img src="images/color/audi/a1/a1_02.png">
                <p><h3>CIVIC<small>雲朵白</small></h3></p>
            </div>
        </div>
        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail">
                <img src="images/color/audi/a1/a1_03.png">
                <p><h3>CIVIC<small>雲朵白</small></h3></p>
            </div>
        </div>
        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail">
                <img src="images/color/audi/a1/a1_04.png">
                <p><h3>CIVIC<small>雲朵白</small></h3></p>
            </div>
        </div>
        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail">
                <img src="images/color/audi/a1/a1_04.png">
                <p><h3>CIVIC<small>雲朵白</small></h3></p>
            </div>
        </div>
        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail">
                <img src="images/color/audi/a1/a1_04.png">
                <p><h3>Fit<small>雲朵白</small></h3></p>
            </div>
        </div>
        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail">
                <img src="images/color/audi/a1/a1_04.png">
                <p><h3>ODYSSEY<small>雲朵白</small></h3></p>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
    <script type="text/javascript" src="/portal_assets/js/index.js"></script>
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
@endsection
<!-- ================== /inline-js ================== -->