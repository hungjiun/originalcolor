<style>
<!--
img {
	width: 100%;
	max-width: 80px;
	height: auto;
}
-->
</style>
<!-- Modal -->
<div class="modal fade" id="include-article" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">{{trans('web.include_article')}}</h4>
			</div>
			<div class="modal-body" style="overflow: hidden; width: 600px;">
				<!-- widget content -->
				<table id="dt_article" class="table table-striped table-bordered table-hover" style="width: 100%;">
				</table>
				<!-- end widget content -->
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="include-images" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">{{trans('web.include_article')}}</h4>
			</div>
			<div class="modal-body" style="overflow: hidden; width: 600px;">
				<!-- widget content -->
				<table id="dt_images" class="table table-striped table-bordered table-hover" style="width: 100%;">
				</table>
				<!-- end widget content -->
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="include-video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">{{trans('web.include_article')}}</h4>
			</div>
			<div class="modal-body" style="overflow: hidden; width: 600px;">
				<!-- widget content -->
				<table id="dt_video" class="table table-striped table-bordered table-hover" style="width: 100%;">
				</table>
				<!-- end widget content -->
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script src="/web_assets/v3/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="/web_assets/v3/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="/web_assets/v3/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="/web_assets/v3/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="/web_assets/v3/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script>
var article_data=[];
var images_data=[];
var video_data=[];
$(document).ready(function() {
	/* BASIC ;*/
	var responsiveHelper_dt_basic = undefined;
	var responsiveHelper_datatable_fixed_column = undefined;
	var responsiveHelper_datatable_col_reorder = undefined;
	var responsiveHelper_datatable_tabletools = undefined;
	
	var breakpointDefinition = {
		tablet : 1024,
		phone : 1024
	};
	var dt_id = "#dt_article";
	var i=0;
	var table = $(dt_id).dataTable({
        "bServerside": true,
		"order": [[ 0, "asc" ]],
        "aoColumns": [
            {"sTitle":"iId","mData":"iId"},
            {"sTitle":"vTitle","mData":"vTitle"},
            {"sTitle":"vSummary","mData":"vSummary"},
            {
                "sTitle":"Action",
            	"mRender":function(data,type,row){
            		article_data[row.iId] = row.vDetail;
                	var btn = "";
                    btn += '<button class="btn btn-xs btn-default btn-include" title="加入">加入</button>';
            		return btn;
            	}
            },
        ],
        "sAjaxSource": "{{ url('web/material/article/getlist')}}",
		"ajax": "{{ url('web/material/article/getlist')}}",
		"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
			"t"+
			"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
		"autoWidth" : true,
        "oLanguage": {
		    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
		},
		"preDrawCallback" : function() {
			// Initialize the responsive datatables helper once.
			if (!responsiveHelper_dt_basic) {
				responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($(dt_id), breakpointDefinition);
			}
		}
	});
	/* END BASIC */
	var dt_id = "#dt_images";
	var i=0;
	var table = $(dt_id).dataTable({
        "bServerside": true,
		"order": [[ 0, "asc" ]],
        "aoColumns": [
            {"sTitle":"iId","mData":"iId"},
            {
                "sTitle":"vImage","mData":"vImage",
                "mRender":function(data,type,row){
            		return '<img src="'+ data + '">';
            	}
            },
            {
                "sTitle":"Action",
            	"mRender":function(data,type,row){
            		images_data[row.iId] = row.vImage;
                	var btn = "";
                    btn += '<button class="btn btn-xs btn-default btn-include" title="加入">加入</button>';
            		return btn;
            	}
            },
        ],
        "sAjaxSource": "{{ url('web/material/images/getlist')}}",
		"ajax": "{{ url('web/material/images/getlist')}}",
		"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
			"t"+
			"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
		"autoWidth" : true,
        "oLanguage": {
		    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
		},
		"preDrawCallback" : function() {
			// Initialize the responsive datatables helper once.
			if (!responsiveHelper_dt_basic) {
				responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($(dt_id), breakpointDefinition);
			}
		}
	});
	/* END BASIC */
	
	/* END BASIC */
	var dt_id = "#dt_video";
	var i=0;
	var table = $(dt_id).dataTable({
        "bServerside": true,
		"order": [[ 0, "asc" ]],
        "aoColumns": [
	        {"sTitle":"iId","mData":"iId"},
	        {"sTitle":"vTitle","mData":"vTitle"},
	        {"sTitle":"vSummary","mData":"vSummary"},
	        {
	            "sTitle":"Action",
	        	"mRender":function(data,type,row){
	        		video_data[row.iId] = row.vDetail;
	            	var btn = "";
	                btn += '<button class="btn btn-xs btn-default btn-include" title="加入">加入</button>';
	        		return btn;
	        	}
	        },
        ],
        "sAjaxSource": "{{ url('web/material/video/getlist')}}",
		"ajax": "{{ url('web/material/video/getlist')}}",
		"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
			"t"+
			"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
		"autoWidth" : true,
        "oLanguage": {
		    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
		},
		"preDrawCallback" : function() {
			// Initialize the responsive datatables helper once.
			if (!responsiveHelper_dt_basic) {
				responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($(dt_id), breakpointDefinition);
			}
		}
	});
	/* END BASIC */
	//
	$("#dt_article").on('click','.btn-include',function(){
		var id = $(this).closest('tr').attr('id');
		$("#vDetail").summernote('pasteHTML', article_data[id]);
	});
	//
	$("#dt_images").on('click','.btn-include',function(){
		var id = $(this).closest('tr').attr('id');
		$("#vDetail").summernote('insertImage', images_data[id]);
	});
	//
	$("#dt_video").on('click','.btn-include',function(){
		var id = $(this).closest('tr').attr('id');
		$("#vDetail").summernote('pasteHTML', video_data[id]);
	});
});
</script>