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
			    	<!--
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			        	<div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_toyota.png" alt="logo toyota"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_mazda.png" alt="logo mazda"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_mitsubishi.png" alt="logo mitsubishi"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_ford.png" alt="logo ford"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_honda.png" alt="logo honda"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_lexus.png" alt="logo lexus"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_vw.png" alt="logo vw"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_hyundai.png" alt="logo hyundai"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_luxgen.png" alt="logo luxgen"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_nissan.png" alt="logo nissan"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_subaru.png" alt="logo subaru"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_skoda.png" alt="logo skoda"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_bmw.png" alt="logo bmw"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_benz.png" alt="logo benz"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_citroen.png" alt="logo citroen"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_kia.png" alt="logo kia"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_audi.png" alt="logo audi"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_volvo.png" alt="logo volvo"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_suzuki.png" alt="logo suzuki"></a></div>
			        </div>
			        <div class="logoBlock col-md-3 col-sm-4 col-xs-6">
			            <div class="thumbnail"><a href="#"><img src="/portal_assets/images/logo/3d_infiniti.png" alt="logo infiniti"></a></div>
			        </div>
			    	-->
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