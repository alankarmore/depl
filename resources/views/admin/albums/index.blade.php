@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Our Offices</li>
        </ol>
    </div><!--/.row-->
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-lg-12">
            @include('admin.messages')
            <div class="panel panel-default">
                    <div class="col-sm-2 pull-right">
                        <br/>
                        <a href="{{route('office.create')}}" title="Add Service" class="btn btn-primary">Add New Office</a>
                    </div>
                    <div class="clearfix"></div>
                <div class="panel-body">
                    <table id="officeTable"> 
                        <thead>
                            <tr>
                                <th data-field="title" data-sortable="true">Title</th>
                                <th data-field="type" data-sortable="true">Type</th>
                                <th data-field="state" data-sortable="true">State</th>
                                <th data-field="city" data-sortable="true">City</th>
                                <th data-field="address" data-sortable="true">Address</th>
                                <th data-field="pincode" data-sortable="true">Pincode</th>
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
    var route = "{{route('office.list')}}";
    generateTable("officeTable",route,'title','ASC');
});
</script>
@endsection
@endsection
