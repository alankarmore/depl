@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">States</li>
        </ol>
    </div><!--/.row-->
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-lg-12">
            @include('admin.messages')
            <div class="panel panel-default">
                    <div class="col-sm-2 pull-right">
                        <br/>
                        <a href="{{route('state.create')}}" title="Add Service" class="btn btn-primary">Add New State</a>
                    </div>
                    <div class="clearfix"></div>
                <div class="panel-body">
                    <table id="stateTable">
                        <thead>
                            <tr>
                                <th data-field="name" data-sortable="true">State Name</th>
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
    var route = "{{route('state.list')}}";
    generateTable("stateTable",route,'name','ASC');
});
</script>
@endsection
@endsection
