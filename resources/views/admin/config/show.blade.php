@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('project.list')}}">Projects</a></li>
            <li class="active">Project Details</li>
        </ol>
    </div><!--/.row-->

    <div class="row">&nbsp;</div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Title</label>
                            <div>{{ucwords($project->title)}}</div>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <div>{{ucwords($project->state)}}</div>
                        </div>                        
                        <div class="form-group">
                            <label>Project Type</label>
                            <div>{{($project->project_type)?ucwords($project->project_type):"NA"}}</div>
                        </div>
                        <div class="form-group">
                            <label>Company Name</label>
                            <div>{{ucwords($project->company)}}</div>
                        </div>
                        <div class="form-group">
                            <label>Length</label>
                            <div>{{($project->length)?$project->length:"NA"}}</div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <div>{{$project->description}}</div>
                        </div>
                        <div class="form-group">
                            <label>Image</label><br/>
                            <img src="{{asset('uploads/project')}}/{{$project->image}}" width="100px" height="100px" title="{{$project->title}}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div><!--/.main-->
@section('page-script')
<script>
    activeParentMenu('config');
</script>
@endsection
@endsection
