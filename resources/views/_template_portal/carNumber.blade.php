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

    <div class="logoBlock">
        <div class="col-sm-7 col-xs-12">
            <img src="{{$carModels->vCarModelImg}}">
        </div>
        <div class="col-sm-5 col-xs-12">
            <div class="title"><h2>{{$carModels->vCarModelName}}<small> {{$carColors->vCarColorName}}</small></h2></div>
            <div class="desc">請選{{$carColors->iPenNumber}}號</div>
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
<script src="/js/bigdata.js"></script>
<script>
     //var big = new bigdata("SID","UID","GROUP","MOD","FUNC","ACTION");
     
     var SID = {{$sysDealer->iId}};
     var GROUP = {{$carModels->iCarBrandId}};
     var MOD = {{$carModels->iId}};
     var FUNC = {{$carColors->iId}};
     var big = new bigdata(SID, "guest", GROUP, MOD, FUNC);
     big.senddata();
</script>    
@endsection
<!-- ================== /inline-js ================== -->