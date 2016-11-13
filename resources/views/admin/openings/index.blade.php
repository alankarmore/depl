@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Current Opening</li>
        </ol>
    </div><!--/.row-->
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-lg-12">
            @include('admin.messages')
            <div class="panel panel-default">
                    <div class="col-sm-2 pull-right">
                        <br/>
                        <a href="{{route('current-opening.create')}}" title="Add Menu" class="btn btn-primary">Add New Opening</a>
                    </div>
                    <div class="clearfix"></div>
                <div class="panel-body">
                    <table id="openingTable">
                        <thead>
                            <tr>
                                <th data-field="title" data-sortable="true">Title</th>
                                <th data-field="location" data-sortable="true">Location</th>
                                <th data-field="qualification" data-sortable="true">Qualification</th>
                                <th data-field="date" data-sortable="true">Posted On</th>
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
    var route = "{{route('current-opening.list')}}";
    generateTable("openingTable",route,'title','ASC');
});
</script>
@endsection
@endsection
