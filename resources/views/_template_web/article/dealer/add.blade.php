@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
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
                        <h3 class="box-title">{{trans("_menu.article.dealer.add.title")}}</h3>
                        <a href="javascript:void(0);" class="btn btn-primary btn-save">確認</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- select -->
                        <br>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">經銷商選擇</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="DealerSelect">
                                    <option value="0"></option>
                                    @foreach ($dealer as $key => $var)
                                    <option value="{{$var->iId}}">{{$var->vDealerName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br><br>
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
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
<!--  -->
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
<!--  -->
<!-- Page-Level Scripts -->
<script>
var url_index = "{{ url('web/article/dealer')}}";
var table;
$(document).ready(function() {
    var i=0;
    table = $('#dt_basic').DataTable({
        "searching": false,
        "bServerside": true,
		"bStateSave": true,
		"scrollX": true,
        "columnDefs": [
            { "width": "30px","targets": i},        //checkbox
			{ "width": "50px","targets": ++i},		//編號
            { "width": "100px","targets": ++i},		//文章主題
            { "width": "150px","targets": ++i},		//文章簡介
            { "width": "150px","targets": ++i},      //建立時間
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
                        return '<input type="checkbox" name="article" value="'+row.iId+'">';
                    }
                },
			{"sTitle":"編號","mData":"iId", "sName": "iId"},
			{"sTitle":"主題","mData":"vTitle", "sName": "vTitle"},
    		{"sTitle":"簡介","mData":"vSummary", "sName": "vSummary"},
			{"sTitle":"創建日期","mData":"iCreateTime", "sName": "iCreateTime"},
    		{"sTitle":"修改日期","mData":"iUpdateTime", "sName": "iUpdateTime"},
			{
				"sTitle":"Action",
                "bSortable": false,
                "bSearchable": false,
				"mRender":function(data,type,row){
					var btn = '';
					//btn = "<button class=\"btn-edit\" title=\"編輯\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></button>&nbsp;";
					//btn += "<button class=\"btn-del\" title=\"刪除\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button>";
					return btn;
				}
			},
		],
        "sAjaxSource": "{{ url('web/article/content/getlist')}}",
        fnServerParams: function(aoData){
            aoData.push( { "name": "iDealerId", "value": $("#DealerSelect").val() } );
        },
        "ajax": "{{ url('web/article/content/getlist')}}",
        "sDom": "<'dt-toolbar'<'col-sm-6 col-xs-12 hidden-xs'l>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "oLanguage": {
            "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
        },
    });
    
    $('#select_all').on('click', function(){
        // Get all rows with search applied
        var rows = table.rows({ 'search': 'applied' }).nodes();
        // Check/Uncheck checkboxes for all rows in the table
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    $('.btn-save').on('click', function(){
        var iDealerId = $('#DealerSelect').val();
        var valuelist = '';
        var rows = table.rows({ 'search': 'applied' }).nodes();
        $('input:checkbox:checked[name="article"]', rows).each(function(){
            valuelist += $(this).val() + ",";
        });
            
        $.ajax({
            url : "{{ url('web/article/dealer/doadd')}}",
            data : {"iDealerId": iDealerId,"articles":valuelist,"_token":"{{ csrf_token() }}"},
            type : "POST",
            success : function(rtndata) {
                //console.log(rtndata);
                if (rtndata.status) {
                    swal("{{trans('web.notice')}}", rtndata.message, "success");
                    setTimeout(function(){
                        location.href = url_index;
                    }, 500);
                } else {
                    swal("{{trans('web.notice')}}", rtndata.message, "error");
                }
            }
        });
    });
});

</script>
@endsection
<!-- ================== /inline-js ================== -->
