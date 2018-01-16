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
            <div class="title text-center"><h1>進階搜尋</h1></div>
            <div class="searchArea">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">車廠</label>
                        <div class="col-sm-10">
                            <select class="form-control car-branch">
                                @foreach( $dealerCarBrand as $key => $var)
                                <option value="{{$var->iId}}">{{$var->vCarBrandName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">車款</label>
                        <div class="col-sm-10">
                            <select class="form-control car-model">
                                @foreach( $dealerCarModels as $key => $var)
                                <option value="{{$var->iId}}">{{$var->vCarModelName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">色碼</label>
                        <div class="col-sm-10">
                            <input class="form-control color-code" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-primary btn-search form-control">搜尋</button>
                        </div>
                    </div>
                </form>
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
<script>
    var url_getcarmodels = "{{url('search/getcarmodels')}}";
    var url_dosearch = "{{url('search/dosearch')}}";
    var url_search1 = "{{url('search/carColorSearch1')}}";
    var url_search2 = "{{url('search/carColorSearch2')}}";
    $(document).ready(function() {
        $('.car-branch').on('change', function() {
            var carBrandId = $(this).val();
            var data = {
                "iCarBrandId": carBrandId
            }; 
            $.ajax({
                url: url_getcarmodels,
                data: data,
                type: "GET",
                success: function (rtndata) {
                    console.log(rtndata)
                    if (rtndata.status) {
                        var carModels = rtndata.carModels;
                        $('.car-model option').remove();
                        for ( var key in carModels ) {
                            $('.car-model').append($("<option></option>").attr("value", carModels[key].iId).text(carModels[key].vCarModelName));
                        }
                    } else {
                        swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                    }
                }
            });
        });

        $('.btn-search').on('click', function() {
            var iCarBrandId = $('.car-branch').val();
            var iCarModelId = $('.car-model').val();
            var vCarColorCode = $('.color-code').val();

            var data = {
                "_token": "{{ csrf_token() }}"
            };
            data.iCarBrandId = iCarBrandId;
            data.iCarModelId = iCarModelId;
            data.vCarColorCode = vCarColorCode;
            $.ajax({
                url: url_dosearch,
                data: data,
                type: "POST",
                success: function (rtndata) {
                    console.log(rtndata)
                    if (rtndata.status) {
                        if( vCarColorCode ) {
                            location.href = url_search2;    
                        } else {
                            location.href = url_search1; 
                        }
                    } else {
                        swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                    }
                }
            });  
        });
    });
</script>
@endsection
<!-- ================== /inline-js ================== -->
