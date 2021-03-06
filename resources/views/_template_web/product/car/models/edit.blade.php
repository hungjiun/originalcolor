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
                        <h3 class="box-title">編輯車款</h3>

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
                                        <label class="col-sm-2 control-label">車廠選擇</label>

                                        <div class="col-sm-10">
                                            <select class="form-control select2" style="width: 100%;" id="iCarBrandId">
                                                @foreach ($carBrand as $key => $var)
                                                <option value="{{$var->iId}}" @if($carModels->iCarBrandId == $var->iId) selected @endif>{{$var->vCarBrandName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">車款名稱</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="vCarModelName" value="{{$carModels->vCarModelName}}">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">車款型態</label>

                                        <div class="col-sm-10">
                                            <select class="form-control select2" style="width: 100%;" id="iCarModelType">
                                                <option selected="selected" value="0"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">車款圖片</label>

                                        <div class="col-sm-10">
                                            <a class="btn-image-modal" data-modal="image-form">
                                                <img id="Image" data-id="{{$carModels->vCarModelImg}}" src="{{$carModels->Img}}" style="width: 15%">
                                            </a>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">車款年份</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="vCarModelAge" value="{{$carModels->vCarModelAge}}">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">車款簡介</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="vSummary" value="{{$carModels->vSummary}}">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">車款官網URL</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="vCarModelUrl" value="{{$carModels->vCarModelUrl}}">
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
        var url_dosave = "{{ url('web/product/car/models/dosave')}}";
        
        $(document).ready(function () {
            //
            $(".btn-save").click(function () {
                var data = {"id":"{{$carModels->iId}}","_token": "{{ csrf_token() }}"};
                data.iCarBrandId = $('#iCarBrandId').val();
                data.vCarModelName = $('#vCarModelName').val();
                data.iCarModelType = $('#iCarModelType').val();
                data.vCarModelImg = $('#Image').attr('data-id');
                data.vCarModelAge = $('#vCarModelAge').val();
                data.vSummary = $('#vSummary').val();
                data.vCarModelUrl = $('#vCarModelUrl').val();
                $.ajax({
                    url: url_dosave,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                            setTimeout(function(){
                                location.href="{{url('web/product/car/models')}}";
                            }, 500);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });

            $(".btn-cancel").click(function () {
                location.href="{{url('web/product/car/models')}}";
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
