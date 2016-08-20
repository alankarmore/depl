@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('menu.list')}}">CMS Management</a></li>
            <li class="active">Menu Details</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{$menu->title}}</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Included In</label>
                            <div>{{(!empty($menu->includedIn->title))?$menu->includedIn->title:'Nothing'}}</div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <div>{{$menu->description}}</div>
                        </div>
                        <div class="form-group">
                            <label>Image</label><br/>
                            <img src="{{asset('uploads/cms')}}/{{$menu->image}}" width="100px" height="100px" title="{{$menu->title}}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div><!--/.main-->
@section('page-script')
<script>
    activeParentMenu('menus'); 
</script>
@endsection
@endsection
