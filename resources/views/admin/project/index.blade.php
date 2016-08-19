@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Major Projects</li>
        </ol>
    </div><!--/.row-->
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-lg-12">
            @include('admin.messages')
            <div class="panel panel-default">
                    <div class="col-sm-2 pull-right">
                        <br/>
                        <a href="{{route('project.create')}}" title="Add Project" class="btn btn-primary">Add New Project</a>
                    </div>
                    <div class="clearfix"></div>
                <div class="panel-body">
                    <table id="projectTable"> 
                        <thead>
                            <tr>
                                <th data-field="title" data-sortable="true">Title</th>
                                <th data-field="company" data-sortable="true">Company Name</th>
                                <th data-field="state" data-sortable="true">State</th>
                                <th data-field="project_type" data-sortable="true">Project Type</th>
                                <th data-field="length" data-sortable="true">Length</th>
                                <th data-field="completion_date" data-sortable="fals">Completion Date</th>
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
    var route = "{{route('project.list')}}";
    generateTable("projectTable",route,'title','ASC');
});
</script>
@endsection
@endsection
