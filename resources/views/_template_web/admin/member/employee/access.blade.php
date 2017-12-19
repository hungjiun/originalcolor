@extends('_template_web._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <style>
        <!--
        -->
    </style>
@endsection
<!-- ================== /page-css ================== -->

<!-- content -->
@section('content')
    <!--  -->
    <div id="content">
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <!-- row -->
            <div class="row">
                <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-editbutton="false"
                         data-widget-fullscreenbutton="false">
                        <!-- widget div-->
                        <header>
                            <span class="widget-icon"> <i class="fa fa-table"></i></span>
                            <h2>{{trans("_menu.admin.member.access.title")}}</h2>
                        </header>
                        <div>
                            <!-- widget content -->
                            <div class="widget-body no-padding">
                                <table id="dt_basic" class="table table-striped table-bordered table-hover" style="width: 100%;">
                                    @foreach($access as $item)
                                        @if($item->iParentId == 0)
                                            @if($item->bSubMenu)
                                                <tr id="{{$item->iId}}">
                                                    <td style="width:10%;color: red">{{trans( '_menu.' . $item->vName . '.title' ) }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td style="width:10%">
                                                        @if($item->bOpen)
                                                            <button class="btn btn-xs btn-danger btn-open">停權</button>
                                                        @else
                                                            <button class="btn btn-xs btn-primary btn-open">啟用</button>
                                                        @endif
                                                    </td>

                                                    <td>{{($item->bSet)?'set':'default'}}</td>
                                                </tr>
                                                @foreach($access as $item2)
                                                    @if($item2->iParentId == $item->iMenuId)
                                                        <tr id="{{$item2->iId}}">
                                                            <td></td>
                                                            <td style="width:10%;">{{trans( '_menu.' . $item2->vName . '.title' ) }}</td>
                                                            <td></td>
                                                            <td style="width:10%">
                                                                @if($item2->bOpen)
                                                                    <button class="btn btn-xs btn-danger btn-open">停權</button>
                                                                @else
                                                                    <button class="btn btn-xs btn-primary btn-open">啟用</button>
                                                                @endif
                                                            </td>
                                                            <td>{{($item2->bSet)?'set':'default'}}</td>
                                                        </tr>
                                                        @if($item2->bSubMenu)
                                                            @foreach($access as $item3)
                                                                @if($item3->iParentId == $item2->iMenuId)
                                                                    <tr id="{{$item3->iId}}">
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="width:10%;">{{trans( '_menu.' . $item3->vName . '.title' ) }}</td>
                                                                        <td style="width:10%">
                                                                            @if($item3->bOpen)
                                                                                <button class="btn btn-xs btn-danger btn-open">停權</button>
                                                                            @else
                                                                                <button class="btn btn-xs btn-primary btn-open">啟用</button>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{($item3->bSet)?'set':'default'}}</td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @else
                                                <tr id="{{$item->iId}}">
                                                    <td style="width:30%;">{{trans( '_menu.' . $item->vName . '.title' ) }}</td>
                                                    <td style="width:10%">
                                                        @if($item->bOpen)
                                                            <button class="btn btn-xs btn-danger btn-open">停權</button>
                                                        @else
                                                            <button class="btn btn-xs btn-primary btn-open">啟用</button>
                                                        @endif
                                                    </td>
                                                    <td>{{($item->bSet)?'set':'default'}}</td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                            <!-- end widget content -->
                        </div>
                        <!-- end widget div -->
                    </div>
                </article>
                <!-- WIDGET END -->
            </div>
            <!-- end row -->
        </section>
        <!-- end widget grid -->
    </div>
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="/web_assets/v3/js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="/web_assets/v3/js/plugin/datatables/dataTables.colVis.min.js"></script>
    <script src="/web_assets/v3/js/plugin/datatables/dataTables.tableTools.min.js"></script>
    <script src="/web_assets/v3/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="/web_assets/v3/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
    <script>
        var url_dosave = "{{ url('web/admin/member/employee/dosaveaccess')}}";
        $(document).ready(function () {
            //
            $("#dt_basic").on('click', '.btn-open', function () {
                var id = $(this).closest('tr').attr('id');
                var data = {
                    "_token": "{{ csrf_token() }}"
                };
                data.iId = id;
                data.bOpen = "change";
                $.ajax({
                    url: url_dosave,
                    data: data,
                    type: "POST",
                    //async: false,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}")
                            setTimeout(function () {
                                location.reload();
                            }, 100);
                        } else {
                            swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                        }
                    }
                });
            })
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
