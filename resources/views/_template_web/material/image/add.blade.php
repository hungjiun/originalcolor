@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link href="/web_assets/AdminLTE/plugins/fileinput/css/fileinput.min.css" rel="stylesheet">
    <link href="/web_assets/AdminLTE/plugins/cropper/dist/cropper.min.css" rel="stylesheet">
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
    <section class="content">
        <div class="row flex-center">
            <div class="col-md-8">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">新增圖片</h3>

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
                                    <div class="file-loading">
                                        <input id="file-input" name="files[]" type="file">
                                    </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-default btn-cancel pull-right" type="button">{{trans('web.cancel')}}</button>
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

    <div class="modal fade picCrop" id="picCrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">裁切圖片</h4>
                </div>
                <div class="modal-body">
                    <div id="imgArea">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="useOrigPic">使用原圖</button>
                    <button class="btn btn-primary" id="confirmCrop">確定裁切</button>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
    <script src="/web_assets/AdminLTE/plugins/fileinput/js/plugins/piexif.js"></script>
    <script src="/web_assets/AdminLTE/plugins/fileinput/js/plugins/sortable.js"></script>
    <script src="/web_assets/AdminLTE/plugins/fileinput/js/plugins/purify.js"></script>
    <script src="/web_assets/AdminLTE/plugins/fileinput/js/fileinput.min.js"></script>
    <script src="/web_assets/AdminLTE/plugins/fileinput/js/locales/zh-TW.js"></script>
    <script src="/web_assets/AdminLTE/plugins/cropper/dist/cropper.min.js"></script>
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        var url_index = "{{ url('web/material/image')}}";
        var url_doadd = "{{ url('web/material/image/doadd')}}";
        var image_url
        $(document).ready(function() {

            $(".btn-cancel").click(function () {
                location.href = url_index;
            });
            
            $('#file-input').fileinput({
                //theme: "fa",
                uploadUrl: "{{url('web/upload_image2')}}",
                dropZoneEnable: true,
                maxFilePreviewSize: 800,
                uploadAsync: true,
                allowedFileExtensions : ['jpg', 'png','gif'],
                overwriteInitial: false,
                language: 'zh-TW',
                maxFileSize: 2048,
                maxFileCount: 1,
                uploadExtraData: {'_token': "{{ csrf_token() }}"}
            }).on('fileuploaded', function(event, data, previewId, index) {
                /*
                var form = data.form, files = data.files, extra = data.extra,
                    response = data.response, reader = data.reader;
                    */
                console.log(data.response); 
                image_url = data.response.file;
                $('#picCrop').modal('show');
            });

            $('#picCrop').on('shown.bs.modal', function(e) {
                var data_width = $('#picCrop').attr("data-width");
                var data_height = $('#picCrop').attr("data-height");
                var aspectRatio = data_width / data_height;
                $('#imgArea').append('<img src="'+image_url+'" id="imgCrop">');

                $('#imgCrop').cropper({
                    aspectRatio: data_width / data_height,
                    data: {
                        width: data_width,
                        height: data_height
                    },
                    viewMode: 1,
                    minContainerWidth: 400,
                    minContainerHeight: 300,
                    modal: true,
                    crop: function (e) {
                        // Output the result data for cropping image.
                    }
                });
            });
            /*
            $('#picCrop').on('shown.bs.modal', function(e) {
                var data_width = $('#picCrop').attr("data-width");
                var data_height = $('#picCrop').attr("data-height");
                var aspectRatio = data_width / data_height;
                $('#imgArea').append('<img src="'+image_url+'" id="imgCrop">');
                $('#imgCrop').Jcrop({  
                    boxWidth : 400,
                    boxHeight : 400,
                    onChange : showCoords,  
                    onSelect : showSelectCoords,
                    onRelease: releaseCoords,
                    aspectRatio: aspectRatio
                }, function(){  
                    var ow = $('#imgCrop').width();
                    var oh = $('#imgCrop').height();
                    
                    var select_width = Math.min(ow, data_width);
                    var select_height = Math.min(oh, data_height);
                    
                    //x = ((ow - select_width) / 2);
                    //y = ((oh - select_height) / 4);
                    x = 50;
                    y = 50;
                    
                    jcrop_api = this;
                    //console.log(jcrop_api);
                    
                    jcrop_api.animateTo([ x, y, x+data_width, y+data_height ]);
                });
            });
            */
            
            $('#picCrop').on('hide.bs.modal', function(e) {
                //console.log(e.target);
                $('#imgArea').empty();
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
