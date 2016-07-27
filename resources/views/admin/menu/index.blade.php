@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">CMS Management</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            @include('admin.messages')
            <div class="panel panel-default">
                    <div class="col-sm-2 pull-right">
                        <br/>
                        <a href="{{route('menu.create')}}" title="Add Menu" class="btn btn-primary">Add New Menu</a>
                    </div>
                    <div class="clearfix"></div>
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
$(function () {
    var route = "{{route('menu.list')}}";
    generateTable("menuTable",route,'title','ASC');
});
$(document).on('click','#menuTable .change-status',function(e) {     
  var route = '{{route("change.status")}}';
  var data = [{'id':$(this).attr('data-id'),'object':$(this).attr('data-object')}];
  sendAjaxRequest($(this),route,data,'POST','JSON','handelStatusResponse',1); 
});    
</script>
@endsection
@endsection
