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
                        <h3 class="box-title">編輯車款圖片</h3>

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
                                    <!-- /.form-group -->
                                    @foreach($carModelColors as $key => $var)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{$var->vCarColorName}}</label>
                                        <div class="col-sm-10">
                                            <a class="btn-model-image" id="{{$var->iId}}">
                                                <img class="model-image" id="Image-{{$var->iId}}" data-id="{{$var->iId}}" data-imageId="{{$var->vCarModelImage}}" src="{{$var->vImage}}" style="width: 15%">
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
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
    @include('_template_web._js.image_upload2')
    <!--  -->
    <script>
        var url_doimagesave = "{{ url('web/product/car/models/doimagesave')}}";
        
        $(document).ready(function () {
            //
            $(".btn-save").click(function () {
                var data = {"_token": "{{ csrf_token() }}"};

                var image = [];
                $('.model-image').each(function() {
                    var iImage = $(this).attr('data-imageId');
                    var iId = $(this).attr('data-id');
                    var value = {iId:iId, iImage:iImage};
                    //console.log(value);
                    image.push(value);
                });

                data.image = image;
                
                $.ajax({
                    url: url_doimagesave,
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
