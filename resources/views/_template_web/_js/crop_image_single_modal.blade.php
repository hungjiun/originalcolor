<style>
    /* Image cropper style */
    .img-container, .img-preview {
        overflow: hidden;
        text-align: center;
        width: 100%;
    }

    .img-preview-sm {
        width: 100px;
        height: 100px;
    }
</style>
<!-- Image cropper -->
<link href="/web_assets/v1/css/plugins/cropper/cropper.min.css" rel="stylesheet">
<div id="image-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{trans('_web_alert.cropper_image')}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="image-crop">
                            <img style="width: 100%; height: auto" src="/images/empty.jpg">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h4>{{trans('_web_alert.upload.image_preview')}}</h4>
                        <div class="img-preview img-preview-sm"></div>
                        <div class="btn-group">
                            <label title="Upload image file" for="inputImage" class="btn btn-primary"> <input type="file" accept="image/*" name="file" id="inputImage"
                                                                                                              class="hide"> {{trans('_web_alert.upload.image_new')}}
                            </label>
                            <button class="btn btn-warning" id="setDrag" type="button">{{trans('_web_alert.upload.image_crop')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/web_assets/v1/js/plugins/cropper/cropper.min.js"></script>
<script>
    var current_modal;
    var imagedata = {};
    $(document).ready(function () {
        $(".btn-image-modal").click(function () {
            $('#image-form').modal();
        })
        var $image = $(".image-crop > img")
        $($image).cropper({
            aspectRatio: 1,
            preview: ".img-preview",
            data: {
                width: 500,
                height: 500
            },
            done: function (data) {
                // Output the result data for cropping image.
            }
        });

        var $inputImage = $("#inputImage");
        if (window.FileReader) {
            $inputImage.change(function () {
                var fileReader = new FileReader(),
                    files = this.files,
                    file;
                if (!files.length) {
                    return;
                }

                file = files[0];
                if (file.size > 1 * 1024 * 1024) {
                    swal("{{trans('_web_alert.notice')}}", "{{trans('_web_alert.cropper_image_too_big')}}:1 MB", "error");
                    return;
                }
                if (/^image\/\w+$/.test(file.type)) {
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function () {
                        $inputImage.val("");
                        $image.cropper("reset", true).cropper("replace", this.result);
                    };
                } else {
                    showMessage("Please choose an image file.");
                }
            });
        } else {
            $inputImage.addClass("hide");
        }

        $("#zoomIn").click(function () {
            $image.cropper("zoom", 0.1);
        });

        $("#zoomOut").click(function () {
            $image.cropper("zoom", -0.1);
        });

        $("#rotateLeft").click(function () {
            $image.cropper("rotate", 45);
        });

        $("#rotateRight").click(function () {
            $image.cropper("rotate", -45);
        });

        $("#setDrag").click(function () {
            $('#image-form').modal('hide');
            $image.cropper("setDragMode", "crop");
            swal("{{trans('_web_alert.notice')}}", "{{trans('_web_alert.cropper_success')}}", "success");
            var image = $image.cropper("getDataURL", "image/jpeg");
            sendImage(image);
            current_modal.find('img').attr('src', imagedata.path);
            current_modal.find('img').data('id', imagedata.fileid);
        });
    });

    function sendImage(image) {
        data = new FormData();
        data.append("_token", "{{ csrf_token() }}");
        data.append("image", image);
        $.ajax({
            data: data,
            type: "POST",
            url: "{{url('web/upload_image_base64')}}",
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            success: function (rtndata) {
                imagedata = rtndata.info;
            }
        });
    }
</script>