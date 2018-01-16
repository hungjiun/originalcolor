@extends('_template_portal._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link type="text/css" rel="stylesheet" href="/portal_assets/css/index.css" />
    <link type="text/css" rel="stylesheet" href="/portal_assets/css/carModel.css" />
@endsection
<!-- ================== /page-css ================== -->

@section('title', $sysDealer->vDealerName)

<!-- content -->
@section('content')
<div class="container text-center">
	<div class="titleImg"><h1><img src="/portal_assets/images/car_model.svg" alt="補漆筆-車廠查詢"></h1></div>
    <!-- <div class="desc">此頁操作步驟：選擇車種，再選擇車型，即可找到您愛車所屬顏色</div> -->

    <div class="logoArea">
        @foreach($dealerCarModels as $key => $var)
        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail" data-target="">
                <a href="{{url('dealer/carcolors')}}?iCarBrandId={{$var->iCarBrandId}}&iCarModelId={{$var->iId}}">
                    <img src="{{$var->vCarModelImg}}">
                    <p><h3>{{$var->vCarModelName}}</h3></p>
                </a>
            </div>
        </div>
        @endforeach
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





