@extends('_template_portal._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link type="text/css" rel="stylesheet" href="/portal_assets/css/index.css" />
    <link type="text/css" rel="stylesheet" href="/portal_assets/css/carType.css" />
@endsection
<!-- ================== /page-css ================== -->

@section('title', $sysDealer->vDealerName)

<!-- content -->
@section('content')
	<div class="mainContent">
        <div class="content">
        	<div class="container text-center">
				<div class="titleImg"><h1><img src="/portal_assets/images/car_type.svg" alt="補漆筆-車廠查詢"></h1></div>
			    <div class="desc">此頁操作步驟：選擇車種，再選擇車型，即可找到您愛車所屬顏色</div>
			    <div class="btnGroup">
				    <div class="btn btn-primary"><a href="{{url('description')}}">補漆筆使用步驟請點此</a></div>
				    <div class="btn btn-primary"><a href="{{url('color_card')}}">電子色卡連結</a></div>
			    </div>

			    <div class="logoArea">
			    	@foreach($dealerCarBrand as $key => $var)
			    	<div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			        	<div class="thumbnail"><a href="{{url('dealer/carmodels')}}?iCarBrandId={{$var->iId}}"><img src="{{$var->vCarBrandImg}}" alt="logo toyota"></a></div>
			        </div>
			    	@endforeach
			    </div>
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