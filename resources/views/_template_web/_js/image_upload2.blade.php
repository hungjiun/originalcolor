
<link href="/web_assets/AdminLTE/plugins/fileinput/css/fileinput.min.css" rel="stylesheet">
<link href="/web_assets/AdminLTE/plugins/cropper/dist/cropper.min.css" rel="stylesheet">
<link href="/web_assets/AdminLTE/plugins/simplePagination/simplePagination.css" rel="stylesheet">

<div id="image-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title">上傳圖片</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="wizard-1" novalidate="novalidate" class="form-horizontal">
                        <div id="bootstrap-wizard-1" class="col-sm-12">
                            <div class="file-loading">
                                <input id="file-input" name="files[]" type="file">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>

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

<script src="/web_assets/AdminLTE/plugins/fileinput/js/plugins/piexif.js"></script>
<script src="/web_assets/AdminLTE/plugins/fileinput/js/plugins/sortable.js"></script>
<script src="/web_assets/AdminLTE/plugins/fileinput/js/plugins/purify.js"></script>
<script src="/web_assets/AdminLTE/plugins/fileinput/js/fileinput.min.js"></script>
<script src="/web_assets/AdminLTE/plugins/fileinput/js/locales/zh-TW.js"></script>
<script src="/web_assets/AdminLTE/plugins/cropper/dist/cropper.min.js"></script>
<script src="/web_assets/AdminLTE/plugins/simplePagination/jquery.simplePagination.js"></script>

<script>
    var url_index = "{{ url('web/material/image')}}";
    var url_doadd = "{{ url('web/material/image/doadd')}}";
    var url_docutimage = "{{ url('web/material/image/docutimage')}}";
    var image_url = "";
    var image_name = "";
    var image_id = "";
   
    $(document).ready(function() {

        $(".btn-model-image").click(function () {
            var id = $(this).attr('id');
            var modal = $("#image-form");
            modal.data('id', id);
            modal.modal();
        });

        $('#file-input').fileinput({
            //theme: "fa",
            uploadUrl: "{{url('web/upload_image2')}}",
            dropZoneEnable: true,
            maxFilePreviewSize: 800,
            uploadAsync: true,
            allowedFileExtensions : ['jpg', 'png','gif','svg'],
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
            //console.log(data.response); 
            image_url = data.response.file;
            image_name = data.response.filename;
            image_id = data.response.imageId;
            //$('#picCrop').modal('show');
            //$('#picCrop').find('#imgArea').attr('data-name', image_name);
            //$('#picCrop').find('#imgArea').attr('data-id', image_id);
            var modal = $("#image-form");
            var id = modal.data('id');
            $('#Image-'+id).attr('src', image_url);
            $('#Image-'+id).attr('data-imageId', image_id);
            modal.modal('toggle');
        });

        $('#image-form').on('show.bs.modal', function(e) {
            $('#file-input').fileinput('enable');
        });

        $('#image-form').on('hide.bs.modal', function(e) {
            $('#file-input').fileinput('clear');
        });

        $('#useOrigPic').click(function(){
            var modal = $("#image-form");
            var id = modal.data('id');

            $('#picCrop').modal('hide');
            $('#image-form').modal('hide');

            $('#Image-'+id).attr('src', image_url);
            $('#Image-'+id).attr('data-imageId', image_id);
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
            
        $('#picCrop').on('hide.bs.modal', function(e) {
            //console.log(e.target);
            $('#imgArea').empty();
        });

        $('#confirmCrop').click(function(){
            var imageData = $("#imgCrop").cropper('getData');
            var imageWidht = imageData.width;
            var imageHeight = imageData.height;

            var data = {"_token":"{{ csrf_token() }}"};
            data.id = $("#image-id").attr("data-imageId");
            data.x = Math.round(imageData.x);
            data.y = Math.round(imageData.y);
            data.width = Math.round(imageData.width);
            data.height = Math.round(imageData.height);

            //console.log(data); 

            $.ajax({
                url : url_docutimage,
                data : data,
                type : "POST",
                success : function(rtndata) {
                    if (rtndata.status) {
                        swal("{{trans('web.notice')}}",  rtndata.message, "success");
                        var modal = $("#image-form");
                        var id = modal.data('id');
                        $('#Image-'+id).attr('src', rtndata.file);
                        $('#Image-'+id).attr('data-imageId', rtndata.imageId);
                        $('#picCrop').modal('hide');
                    } else {
                        swal("{{trans('web.notice')}}",  rtndata.message, "error");
                    }
                }
            });
        });
    });
</script>

