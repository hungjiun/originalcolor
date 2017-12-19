@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
    <section class="content">
        <div class="row flex-center">
            <div class="col-md-8">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">編輯車廠</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">車廠名稱</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="vCarBrandName" placeholder="" value="{{$carBrand->vCarBrandName}}">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">車廠國家</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="vCarBrandCountry" placeholder="" value="{{$carBrand->vCarBrandCountry}}">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">車廠圖片</label>

                                        <div class="col-sm-10">
                                            <a class="btn-image-modal" data-modal="image-form">
                                                <img id="Image" data-id="{{$carBrand->vCarBrandImg}}" src="{{$carBrand->Img}}" style="width: 15%">
                                            </a>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">車廠簡介</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="vSummary" placeholder="" value="{{$carBrand->vSummary}}">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">官網URL</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="vCarBrandUrl" placeholder="" value="{{$carBrand->vCarBrandUrl}}">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-primary pull-right btn-save">確認</button>
                            <button type="button" class="btn btn-default pull-right btn-cancel">取消</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    @include('_template_web._js.image_upload')
    <!--  -->
    <script>
        var url_dosave = "{{ url('web/product/car/brand/dosave')}}";
        
        $(document).ready(function () {
            //
            $(".btn-save").click(function () {
                var data = {"id":"{{$carBrand->iId}}","_token": "{{ csrf_token() }}"};
                data.vCarBrandName = $('#vCarBrandName').val();
                data.vCarBrandCountry = $('#vCarBrandCountry').val();
                data.vCarBrandImg = $('#Image').attr('data-id');
                data.vSummary = $('#vSummary').val();
                data.vCarBrandUrl = $('#vCarBrandUrl').val();
                $.ajax({
                    url: url_dosave,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                            setTimeout(function(){
                                location.href="{{url('web/product/car/brand')}}";
                            }, 500);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });

            $(".btn-cancel").click(function () {
                location.href="{{url('web/product/car/brand')}}";
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
