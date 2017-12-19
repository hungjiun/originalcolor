@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
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
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{trans("_menu.product.car.dealer.manage.brand.title")}}</h3>
                        <a href="javascript:void(0);" class="btn btn-primary btn-add">新增</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- select -->
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">經銷商選擇</label>
                            <div class="col-sm-4">
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
    <script>
        var current_data = [];
        var ajax_source = "{{ url('web/product/car/dealer/manage/getlist')}}";
        var ajax_Table = "{{ url('web/product/car/dealer/manage/getlist')}}";
        var url_dosave = "{{ url('web/product/car/dealer/manage/dobrandsave')}}";
        var url_brandadd = "{{ url('web/product/car/dealer/manage/brandadd')}}";
        var url_models = "{{ url('web/product/car/dealer/manage/models')}}";
        var url_colors = "{{ url('web/product/car/dealer/manage/colors')}}";
        var table;
        $(document).ready(function () {
            /* BASIC ;*/
            var i = 0;
            table = $('#dt_basic').dataTable({
                "searching": false,
                "bServerside": true,
                "bStateSave": true,
                "scrollX": true,
                "autoWidth": true,
                "columnDefs": [
                    { "width": "50px","targets": i},        //ID
                    { "width": "150px","targets": ++i},     //經銷商名稱
                    { "width": "150px","targets": ++i},     //車廠名稱
                    //{ "width": "60px","targets": ++i},      //排序
                    { "width": "60px","targets": ++i},      //狀態
                    { "width": "100px","targets": ++i}
                ],
                "aoColumns": [
                    {"sTitle": "ID", "mData": "iId"},
                    {"sTitle": "經銷商名稱", "mData": "vDealerName"},
                    {"sTitle": "車廠名稱", "mData": "vCarBrandName"},
                    /*
                    {
                        "sTitle":"排序","mData":"iRank",
                        "mData": "iRank",
                        "mRender": function(data, type, row) {
                            return "<input type=\"number\"  min=\"1\" class=\"form-control set-rank\" value=\""+ data +"\">";
                        }
                    },
                    */
                    {
                        "sTitle": "狀態", "mData": "iStatus",
                        "mRender": function (data, type, row) {
                            var btn = "無狀態";
                            switch (data) {
                                case 1:
                                    btn = '<button class="btn btn-xs btn-danger btn-status">啟用</button>';
                                    break;
                                default:
                                    btn = '<button class="btn btn-xs btn-primary btn-status">停用</button>';
                                    break;
                            }
                            return btn;
                        }
                    },
                    {
                        "sTitle": "Action",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            current_data[row.iId] = row;
                            var btn = "";
                            btn = '<button class="btn btn-xs btn-default btn-car" title="車款設定"><i class="fa fa-car" aria-hidden="true"></i></button>&nbsp;';
                            btn += '<button class="btn btn-xs btn-default btn-pencil" title="車色設定"><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;';
                            btn += "<button class=\"pull-right btn-del\" title=\"刪除\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button>";
                            return btn;
                        }
                    },
                ],
                "sAjaxSource": ajax_source,
                fnServerParams: function(aoData){
                    aoData.push( { "name": "iDealerId", "value": $("#DealerSelect").val() } );
                },
                "ajax": ajax_Table,
                "sDom": "<'dt-toolbar'<'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
            });
            /* END BASIC */

            $('#DealerSelect').change(function() {
                table.api().ajax.reload(null, false);
            });

            //
            $(".btn-add").click(function () {
                location.href = url_brandadd;
            });

            //
            $("#dt_basic").on('click', '.btn-car', function () {
                var id = $(this).closest('tr').attr('id');
                var iDealerId = current_data[id].iDealerId;
                var iCarBrandId = current_data[id].iCarBrandId;
                //console.log(iCarBrandId);
                location.href = url_models + '?iDealerId=' + iDealerId + '&iCarBrandId=' + iCarBrandId;
            });
            //
            $("#dt_basic").on('click', '.btn-pencil', function () {
                var id = $(this).closest('tr').attr('id');
                var iDealerId = current_data[id].iDealerId;
                var iCarBrandId = current_data[id].iCarBrandId;
                location.href = url_colors + '?iDealerId=' + iDealerId + '&iCarBrandId=' + iCarBrandId;
            });

            //
            $("#dt_basic").on('click', '.btn-status', function () {
                var id = $(this).closest('tr').attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.id = id;
                data.iStatus = "change";
                $.ajax({
                    url: url_dosave,
                    data: data,
                    type: "POST",
                    success: function (rtndata) {
                        if (rtndata.status) {
                            swal("{{trans('web.notice')}}", rtndata.message, "success");
                            setTimeout(function () {
                                table.api().ajax.reload(null, false);
                            }, 100);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });

            $('#dt_basic').on('blur', '.set-rank', function(e) {
                var tr = $(this).closest('tr');
                var idx = tr.attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.id = idx;
                data.iRank = $(this).val();
                $.ajax({
                    url: url_dosave,
                    data: data,
                    type: "POST",
                    success: function(rtndata) {
                        if (rtndata.status) {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "success");
                            setTimeout(function() {
                                table.api().ajax.reload(null, false);
                            }, 100);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
