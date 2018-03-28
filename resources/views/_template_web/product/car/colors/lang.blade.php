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
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">編輯車色語言</h3>

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
                                    
                                    @foreach($carColorsLang as $key => $var)
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{$var->vAreaLangName}}</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control vCarColorName" id="vCarColorName" data-id="{{$var->iId}}" value="{{$var->vCarColorName}}">
                                        </div>
                                    </div>
                                    @endforeach
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
        var url_dosave = "{{ url('web/product/car/colors/dolangsave')}}";
        
        $(document).ready(function () {
            //
            $(".btn-save").click(function () {
                var data = {"id":"{{$carColors->iId}}","_token": "{{ csrf_token() }}"};
                var carColorName = [];
                $('.vCarColorName').each(function() {
                    var vCarColorName = $(this).val();
                    var iId = $(this).attr('data-id');
                    var value = {iId:iId, vCarColorName:vCarColorName};
                    //console.log(value);
                    carColorName.push(value);
                });

                data.carColorName = carColorName;

                $.ajax({
                    url: url_dosave,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                            setTimeout(function(){
                                location.href="{{url('web/product/car/colors')}}";
                            }, 500);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });

            $(".btn-cancel").click(function () {
                location.href="{{url('web/product/car/colors')}}";
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
