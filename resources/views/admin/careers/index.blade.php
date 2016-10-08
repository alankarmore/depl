@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Careers</li>
        </ol>
    </div><!--/.row-->
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-lg-12">
            @include('admin.messages')
            <div class="panel panel-default">
                <div class="panel-body">
                    <table id="careerTable">
                        <thead>
                            <tr>
                                <th data-field="first_name" data-sortable="true">First Name</th>
                                <th data-field="last_name" data-sortable="true">Last Name</th>
                                <th data-field="email" data-sortable="true">Email</th>
                                <th data-field="message" data-sortable="true">Message</th>
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
    var route = "{{route('career.list')}}";
    generateTable("careerTable",route,'first_name','ASC');
});
</script>
@endsection
@endsection
