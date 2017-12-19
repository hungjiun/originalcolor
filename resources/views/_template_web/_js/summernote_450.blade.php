<!-- SUMMERNOTE -->
<script src="/web_assets/v3/js/plugin/summernote/summernote.min.js"></script>
<script>
$(document).ready(function() {
	$('.summernote').summernote({
		  height: 450,
		  callbacks: {
	      onImageUpload: function(files, editor, welEditable) {
	    	  sendFile(files[0],this);
	    	  }
		  }
	  });
});
function sendFile(files,editor) {
    if( files.size > 2*1024*1024 ){
    	swal("{{trans('_web_alert.notice')}}", "{{trans('_web_alert.cropper_image_too_big')}}:2 MB", "error");
    	return;
    }
    data = new FormData();
    data.append("_token", "{{ csrf_token() }}");
    data.append("files", files);
    $.ajax({
        data: data,
        type: "POST",
        url: "{{url('web/upload_image_to_s3')}}",
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
        	$(editor).summernote('editor.insertImage', data.files.url);
        }
    });
}
</script>