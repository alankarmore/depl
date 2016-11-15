@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Districts</li>
        </ol>
    </div><!--/.row-->
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-lg-12">
            @include('admin.messages')
            <div class="panel panel-default">
                    <div class="col-sm-2 pull-right">
                        <br/>
                        <a href="{{route('districts.create')}}" title="Add District" class="btn btn-primary">Add New District</a>
                    </div>
                    <div class="clearfix"></div>
                <div class="panel-body">
                    <table id="districtTable">
                        <thead>
                            <tr>
                                <th data-field="name" data-sortable="true">District Name</th>
                                <th data-field="stateName" data-sortable="true">State Name</th>
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
    var route = "{{route('districts.list')}}";
    generateTable("districtTable",route,'name','ASC');
});
</script>
@endsection
@endsection
