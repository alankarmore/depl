@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Slogans</li>
        </ol>
    </div><!--/.row-->
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-lg-12">
            @include('admin.messages')
            <div class="panel panel-default">
                    <div class="col-sm-2 pull-right">
                        <br/>
                        <a href="{{route('slogan.create')}}" title="Add Service" class="btn btn-primary">Add New Slogan</a>
                    </div>
                    <div class="clearfix"></div>
                <div class="panel-body">
                    <table id="sloganTable">
                        <thead>
                            <tr>
                                <th data-field="main_phrase" data-sortable="true">Main Phrase</th>
                                <th data-field="sub_phrase" data-sortable="true">Sub Phrase</th>
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
    var route = "{{route('slogan.list')}}";
    generateTable("sloganTable",route,'main_phrase','ASC');
});
</script>
@endsection
@endsection
