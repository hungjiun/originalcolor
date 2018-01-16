@extends('_template_portal._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link type="text/css" rel="stylesheet" href="/portal_assets/css/index.css" />
    <style>
		.p1{
			padding: 20px;
		}
		.p1 li{
			margin-top: 10px;
		}
		.p2{
			margin-top: 15px;
			padding: 20px;
			color:red;
		}
		.p2 p{
			margin-top: 5px;
		}
		ul{
			list-style-type: disc;
			list-style-position: inside;
		} 
		@media screen and (min-width: 481px) { 
			.p1 ul img{
				display: block;
				margin: 5px 3%;
				width: 300px;
			}
		}
		@media screen and (max-width: 480px) {
			.p1 ul img{
				display: block;
				margin: 5px auto;
			}
		}
	</style>
@endsection
<!-- ================== /page-css ================== -->
@section('title', '補漆筆-故障問題排除')
<!-- content -->
@section('content')
    <div class="mainContent">
        <div class="content">
            <div class="wrap">
				<div class="p1">
				<!-- 標頭 -->
					<header>
						<h1>故障問題排除</h1>
					</header>
					<!-- 放車種的區塊 -->
				
					<ul>
						<li>問題：</br>　放置時間過久，再次使用時，為什麼筆芯按壓不進去？</li>
						<li>原因：</br>　因前次修補施工後殘餘油漆在筆芯上硬化，導致按壓困難。</li>
						<li>解決辦法：</br>
							　請搖勻筆身至內部油漆充分溶解(內附鋼珠有撞擊聲)，再按壓筆芯到底，時間需長一些，等筆管內油漆充分流出，				待筆芯周圍油漆飽和後過數秒時間，再用面紙擦拭掉筆芯所含油漆(其濃稠度過高)再按壓筆芯，即可修補作業。
						</li>
						<li>請注意，按壓筆芯時請務必將筆頭朝下至低於筆尾，以利筆管內油漆可順利流出。</li>
						<img src="/portal_assets/images/qa.svg">
					</ul>
				</div>

				<div class="p2">
					<header>
						<h1>注意事項</h1>
					</header>
					
					<p>修補作業完畢後，請務必用面紙將筆芯的殘餘油漆吸附乾淨，再將筆蓋蓋緊，以利日後再次使用</p>
						<p class="clearfix"></p>
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