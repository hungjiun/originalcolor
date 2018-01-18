@extends('_template_portal._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link type="text/css" rel="stylesheet" href="/portal_assets/css/index.css" />
    <link type="text/css" rel="stylesheet" href="/portal_assets/css/search.css" />
@endsection
<!-- ================== /page-css ================== -->
@section('title', '原色車漆 ORIGINAL COLOR CO.,LTD')
<!-- content -->
@section('content')
    <div class="mainContent">
        <div class="content">
            <div class="container">
                <div class="title text-center"><h1>{{$articleContent->vTitle}}</h1></div>
                <div class="desc">
                    {!!$articleContent->vDetail!!}
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