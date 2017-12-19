<!-- SUMMERNOTE -->
<script src="/web_assets/AdminLTE/plugins/summernote/dist/summernote.js"></script>
<script>
    $(document).ready(function () {
        $('.summernote').summernote({
            toolbar: [
                ["style", ["style", "undo", "redo"]],
                ["font", ["bold", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ['fontsize', ['fontsize']],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["table", ["table"]],
                ["insert", ["link", "picture", "video"]],
                ["view", ["fullscreen", "codeview", "help"]]
            ],
            height: 350,
            callbacks: {
                onImageUpload: function (files, editor, welEditable) {
                    sendFile(files[0], this);
                }
            }
        });
    });

    function sendFile(files, editor) {
        if (files.size > 2 * 1024 * 1024) {
            swal("{{trans('_web_alert.notice')}}", "{{trans('_web_alert.cropper_image_too_big')}}:2 MB", "error");
            return;
        }
        data = new FormData();
        data.append("_token", "{{ csrf_token() }}");
        data.append("files", files);
        $.ajax({
            data: data,
            type: "POST",
            url: "{{url('web/upload_image')}}",
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(editor).summernote('editor.insertImage', data.files.url);
            }
        });
    }
</script>