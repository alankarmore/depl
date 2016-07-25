@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Icons</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Menus</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Menu List</div>
                <div class="panel-body">
                    <table id="menuTable"> 
                        <thead>
                            <tr>
                                <th data-field="title" data-sortable="true">Title</th>
                                <th data-field="description" data-sortable="true">Description</th>
                                <th data-field="action" data-sortable="false">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div><!--/.row-->	
</div><!--/.main-->
@section('page-script')
<script src="{{asset('admin/js/bootstrap-table.js')}}"></script>
<script>
    $(function(){
        $("#menuTable").bootstrapTable({
            url:"{{route('menu.list')}}",
            contentType: 'application/x-www-form-urlencoded',
            queryParams: function (p) {
                return {
                 limit: p.limit,
                 offset: p.offset,
                 search: (p.search)?p.search:"",
                 sort: p.sort,
                 order: p.order
             };
            },
            method:'post',
            pagination:true,
            sidePagination:'server',
            search:true,
            sortName:'title',
            sortOrder:'ASC',
            cache:false,
            pageSize:10,
        });
    })
</script>
@endsection
@endsection
