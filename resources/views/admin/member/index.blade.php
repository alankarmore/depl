@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Our Services</li>
        </ol>
    </div><!--/.row-->
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-lg-12">
            @include('admin.messages')
            <div class="panel panel-default">
                    <div class="col-sm-2 pull-right">
                        <br/>
                        <a href="{{route('team.create')}}" title="Add Service" class="btn btn-primary">Add New Member</a>
                    </div>
                    <div class="clearfix"></div>
                <div class="panel-body">
                    <table id="memberTable">
                        <thead>
                            <tr>
                                <th data-field="first_name" data-sortable="true">First Name</th>
                                <th data-field="last_name" data-sortable="true">Last Name</th>
                                <th data-field="designation" data-sortable="true">Designation</th>
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
    var route = "{{route('team.list')}}";
    generateTable("memberTable",route,'first_name','ASC');
});
</script>
@endsection
@endsection
