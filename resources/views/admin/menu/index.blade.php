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
            <h1 class="page-header">Tables</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Advanced Table</div>
                <div class="panel-body">
                    <table data-toggle="table" data-search="true" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                        <thead>
                            <tr>
                                <th data-field="title" data-checkbox="true" >Title</th>
                                <th data-field="description" data-sortable="true">Description</th>
                                <th data-sortable="false">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu) 
                                <tr>
                                    <td>{{$menu->title}}</td>
                                    <td>{{(strlen($menu->description) > 50)? substr($menu->description,0,150) : $menu->description }}</td>
                                    <td>
                                        <a href="">Edit</a>
                                        <a href="">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
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
        $('#hover, #striped, #condensed').click(function () {
            var classes = 'table';

            if ($('#hover').prop('checked')) {
                classes += ' table-hover';
            }
            if ($('#condensed').prop('checked')) {
                classes += ' table-condensed';
            }
            $('#table-style').bootstrapTable('destroy')
                    .bootstrapTable({
                        classes: classes,
                        striped: $('#striped').prop('checked')
                    });
        });
    });

    function rowStyle(row, index) {
        var classes = ['active', 'success', 'info', 'warning', 'danger'];

        if (index % 2 === 0 && index / 2 < classes.length) {
            return {
                classes: classes[index / 2]
            };
        }
        return {};
    }
</script>
@endsection
@endsection
