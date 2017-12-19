@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link href="/web_assets/AdminLTE/plugins/cropper/dist/cropper.min.css" rel="stylesheet">

    <style type="text/css">
        .cropper_image_2 img {
            min-width: 100px;
            max-width: 300px;
            height: auto;
        }
        .cropper_image_2 {
            cursor: pointer;
        }
    </style>
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
    <!--  -->
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
                                        <div class="col-sm-10 cropper_image_2">
                                            <a class="btn-image-modal" data-modal="picCrop">
                                                <img id="image-id" data-id="{{$image->iId}}" src="{{$image->vFileServer . $image->vFilePath . $image->vFileName}}">
                                            </a>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">圖片主題</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="vProductTitle" placeholder="名稱" type="text" maxlength="50" value="">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">圖片簡介</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="vProductSummary" placeholder="簡介" type="text" value="">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-primary btn-save pull-right" type="button"><i class="fa fa-save"></i> {{trans('web.save')}}
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

    <div class="modal fade" id="picCrop" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">編輯圖片</h4>
                </div>
                <div class="modal-body">
                    <div id="imgArea">
                        <img id="Image" data-id="{{$image->iId}}" src="{{$image->vFileServer . $image->vFilePath . $image->vFileName}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">取消</button>
                    <button class="btn btn-primary btn-confirm" id="btn-confirm">確定</button>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
    <script src="/web_assets/AdminLTE/plugins/cropper/dist/cropper.min.js"></script>
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <!-- Public SummerNote -->
    @include('_template_web._js.summernote')
    <!-- end -->
    <script>
		var url_index = "{{ url('web/material/image')}}";
        var url_docutimage = "{{ url('web/material/image/docutimage')}}";

        var fileType = "{{$image->vFileType}}";
	    $(document).ready(function() {
	    	
            $(".btn-image-modal").click(function () {
                $('#picCrop').modal();
            });
            
            $('#Image').cropper({
                viewMode: 1,
                minContainerWidth: 400,
                minContainerHeight: 300,
                modal: true,
                crop: function (e) {
                    // Output the result data for cropping image.
                }
            });
            

            $(".btn-cancel").click(function () {
                location.href = url_index;
            });

	        $(".btn-confirm").click(function() {
                var imageData = $("#Image").cropper('getData');
                var imageWidht = imageData.width;
                var imageHeight = imageData.height;

	            var data = {"_token":"{{ csrf_token() }}"};
	            data.id = $("#image-id").attr("data-id");
	            data.x = Math.round(imageData.x);
	            data.y = Math.round(imageData.y);
	            data.width = Math.round(imageData.width);
	            data.height = Math.round(imageData.height);
                /*
                var image = $("#Image").cropper('getCroppedCanvas', {
                    fillColor: '#fff',
                    imageSmoothingQuality: 'high',
                }).toDataURL(fileType);
                */
                console.log(data);
                               
	    		$.ajax({
	    			url : url_docutimage,
	    			data : data,
	    			type : "POST",
	    			success : function(rtndata) {
						console.log(rtndata);
	    				if (rtndata.status) {
	    					swal("{{trans('web.notice')}}",  rtndata.message, "success");
		                    setTimeout(function(){
		                        location.reload();
		                    }, 500);
	    				} else {
							swal("{{trans('web.notice')}}",  rtndata.message, "error");
	    				}
	    			}
	    		});
	        });
	    });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
