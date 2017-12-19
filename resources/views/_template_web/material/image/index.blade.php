@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link rel="stylesheet" href="/web_assets/AdminLTE/plugins/blueimp/css/blueimp-gallery.css" >
    <style>
    table img {
        width: 40px;
        height: auto;
    }
    </style>
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
<!--  -->
<div id="content">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{trans("_menu.material.image.title")}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="">
                            <a href="javascript:void(0);" class="btn btn-primary btn-add">新增</a>
                        </div>
                        <br>
                        <table id="dt_basic" class="table table-bordered table-hover">
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a> <a class="next">›</a> <a class="close">×</a> <a
        class="play-pause"></a>
    <ol class="indicator"></ol>
</div>    
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
<!--  -->
<!-- blueimp gallery -->
<script src="/web_assets/AdminLTE/plugins/blueimp/js/jquery.blueimp-gallery.min.js"></script>
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')

@include('_template_web._js.image_upload')
<!--  -->
<!-- Page-Level Scripts -->
<script>
$(document).ready(function() {
    var i=0;
    var table = $('#dt_basic').DataTable({
        "searching": false,
        "bServerSide": true,
		"bStateSave": true,
		"scrollX": true,
        "columnDefs": [
            { "width": "30px","targets": i},        //checkbox
			{ "width": "50px","targets": ++i},		//編號
            { "width": "40px","targets": ++i},      //圖片
			{ "width": "100px","targets": ++i},		//檔案類型
            { "width": "150px","targets": ++i},		//檔案位置
			{ "width": "300px","targets": ++i},		//檔案路徑
            { "width": "250px","targets": ++i},		//檔案名稱
            { "width": "70px","targets": ++i},		//檔案大小
            { "width": "60px","targets": ++i},		//圖片寬度
            { "width": "60px","targets": ++i},		//圖片高度
            { "width": "150px","targets": ++i},      //上傳時間
            { "width": "150px","targets": ++i},      //更新時間
            { "width": "100px","targets": ++i}
        ],
        "aoColumns": [
            {
                    "sTitle":'<input type="checkbox" name="checkbox" id="select_all" value="0">',
                    "sName": "iId",
                    "bSortable": false,
                    "bSearchable": false,
                    "mRender":function(data,type,row){
                        return '<input type="checkbox" name="image" value="'+row.id+'">';
                    }
                },
			{"sTitle":"{{trans('web.material.id')}}","mData":"iId", "sName": "iId"},
            {
                "sTitle":"{{trans('web.material.images')}}",
                "mData":"vFile",
                "sName": "vFile",
                "bSortable": false,
                "bSearchable": false,
                "mRender":function(data,type,row){
                    return " <div class=\"lightBoxGallery\"><a href='"+ data +"' data-gallery=\"\"><img src='"+ data +"'></a></div>";
                }
            },
			{"sTitle":"{{trans('web.material.fileType')}}","mData":"vFileType", "sName": "vFileType"},
    		{"sTitle":"{{trans('web.material.fileServer')}}","mData":"vFileServer", "sName": "vFileServer"},
			{"sTitle":"{{trans('web.material.filePath')}}","mData":"vFilePath", "sName": "vFilePath"},
    		{"sTitle":"{{trans('web.material.fileName')}}","mData":"vFileName", "sName": "vFileName"},
    		{"sTitle":"{{trans('web.material.fileSize')}}","mData":"iFileSize", "sName": "iFileSize"},
            {"sTitle":"{{trans('web.material.imageWidth')}}","mData":"iImageWidth", "sName": "iImageWidth"},
            {"sTitle":"{{trans('web.material.imageHeight')}}","mData":"iImageHeight", "sName": "iImageHeight"},
            {"sTitle":"{{trans('web.material.createTime')}}","mData":"iCreateTime", "sName": "iCreateTime"},
            {"sTitle":"{{trans('web.material.updateTime')}}","mData":"iUpdateTime", "sName": "iUpdateTime"},
			{
				"sTitle":"{{trans('web.material.action')}}",
                "bSortable": false,
                "bSearchable": false,
				"mRender":function(data,type,row){
					var btn;
					btn = "<button class=\"btn-edit\" title=\"編輯\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></button>&nbsp;";
					btn += "<button class=\"pull-right btn-del\" title=\"刪除\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button>";
					return btn;
				}
			},
		],
        "sAjaxSource": "{{ url('web/material/image/getlist')}}",
        "ajax": "{{ url('web/material/image/getlist')}}",
        "sDom": "<'dt-toolbar'<'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "oLanguage": {
            "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
        },
    });
    /*
    $(".btn-add").click(function () {
        var width = $(this).attr('data-width');
        var height = $(this).attr('data-height');
        height = height ? height : 0;
        width = width ? width : 0;

        $('#picCrop').attr("data-width", width);
        $('#picCrop').attr("data-height", height);

        var modal = $("#image-form");
        modal.modal();
    });
    */
    $('#select_all').on('click', function(){
        // Get all rows with search applied
        var rows = table.rows({ 'search': 'applied' }).nodes();
        // Check/Uncheck checkboxes for all rows in the table
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });
    
    $('.btn-add').on('click', function () {
        location.href = "{{ url('web/material/image/add')}}";
    });
    

    $('#dt_basic').on('click', '.btn-edit', function () {
        var tr = $(this).closest('tr');
        var idx = tr.attr('id');
        location.href = "{{ url('web/material/image/edit')}}?id="+idx;
    });

    $('.btn-delselected').on('click', function(){
        var valuelist = '';
        var rows = table.rows({ 'search': 'applied' }).nodes();
        $('input:checkbox:checked[name="image"]', rows).each(function(){
            valuelist += $(this).val() + ",";
        });
            
        swal({
            title: "{{trans('web.material.del.title')}}",
            text: "{{trans('web.material.del.note')}}",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "{{trans('web.cancel')}}",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "{{trans('web.ok')}}",
            closeOnConfirm: false
            }, function () {
                $.ajax({
                url : "{{ url('web/material/dodelmultiimage')}}",
                data : {"images":valuelist,"_token":"{{ csrf_token() }}"},
                    type : "POST",
                    success : function(rtndata) {
                        console.log(rtndata);
                        if (rtndata.status) {
                            swal("{{trans('web.notice')}}", rtndata.message, "success");
                            setTimeout(function(){
                                table.ajax.reload(null, false);
                            }, 1000);
                        } else {
                            swal("{{trans('web.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });
    });
       
    $('#dt_basic').on('click', '.btn-del', function () {
        var tr = $(this).closest('tr');
        var idx = tr.attr('id');
        swal({
            title: "{{trans('web.material.del.title')}}",
            text: "{{trans('web.material.del.note')}}",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "{{trans('web.cancel')}}",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "{{trans('web.ok')}}",
            closeOnConfirm: false
        }, function () {
            $.ajax({
				url : "{{ url('web/material/image/dodel')}}",
   				data : {"id":idx,"_token":"{{ csrf_token() }}"},
   				type : "POST",
       			success : function(rtndata) {
       				if (rtndata.status) {
       					swal("{{trans('web.notice')}}", rtndata.message, "success");
   	                    setTimeout(function(){
   	                        table.ajax.reload(null, false);
   	                    }, 500);
       				} else {
       					swal("{{trans('web.notice')}}", rtndata.message, "error");
       				}
       			}
            })
        });
    });
});

</script>
@endsection
<!-- ================== /inline-js ================== -->
