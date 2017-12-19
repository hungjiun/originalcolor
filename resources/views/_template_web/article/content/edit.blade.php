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
                        <h3 class="box-title">編輯文章</h3>

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
                                        <label class="col-sm-2 control-label">文章主題</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="vTitle" value="{{$articleContent->vTitle}}">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <!--
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">圖片</label>

                                        <div class="col-sm-10">
                                            <a class="btn-image-modal" data-modal="image-form">
                                                <img id="Image" data-id="" src="/img/empty-type.jpg" style="width: 15%">
                                            </a>
                                        </div>
                                    </div>
                                    -->
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">文章簡介</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="vSummary" value="{{$articleContent->vSummary}}">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">備註</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="vMeta" value="{{$articleContent->vMeta}}">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label></label>

                                        <div class="col-sm-12">
                                            <div id="vDetail" class="summernote" data-id="{{$articleContent->iId}}">{!!$articleContent->vDetail!!}</div>
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
                            <button type="button" class="btn btn-primary pull-right btn-cancel">取消</button>
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
    @include('_template_web._js.summernote')
    <!--  -->
    <script>
        var url_dosave = "{{ url('web/article/content/dosave')}}";
        
        $(document).ready(function () {
            //
            $(".btn-save").click(function () {
                var data = {"id":"{{$articleContent->iId}}","_token": "{{ csrf_token() }}"};
                data.vTitle = $('#vTitle').val();
                //data.vImage = $('#Image').attr('data-id');
                data.vSummary = $('#vSummary').val();
                data.vMeta = $('#vMeta').val();
                data.vDetail = $('#vDetail').summernote('code');
                $.ajax({
                    url: url_dosave,
                    type: "POST",
                    data: data,
                    resetForm: true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                            setTimeout(function(){
                                location.href="{{url('web/article/content')}}";
                            }, 500);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });

            $(".btn-cancel").click(function () {
                location.href="{{url('web/article/content')}}";
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
