@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('project.list')}}">Projects</a></li>
            <li class="active">Edit Project Details</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Project Information</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        @include('admin.messages')
                        <form role="form" name="frmProject" id='frmProject' action="{{route('project.update',array('id' => $project->id))}}" method="POST">
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" placeholder="Project Title" name="title" id="title" value="{{$project->title}}">
                                <span class="alert-danger">{{$errors->first('title')}}</span>
                            </div>
                            <div class="form-group">
                                <label>State</label>
                                <input class="form-control" placeholder="State Name" name="state" id="state" value="{{$project->state}}">
                                <span class="alert-danger">{{$errors->first('state')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Company</label>
                                <input class="form-control" placeholder="company" name="company" id="company" value="{{$project->company}}">
                                <span class="alert-danger">{{$errors->first('company')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Project Type</label>
                                <input class="form-control" placeholder="Project Type" name="project_type" id="project_type" value="{{$project->project_type}}">
                                <span class="alert-danger">{{$errors->first('project_type')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Length</label>
                                <input class="form-control" placeholder="Length" name="length" id="length" value="{{$project->length}}">
                                <span class="alert-danger">{{$errors->first('length')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Completion Date</label>
                                <input class="form-control" placeholder="Complettion Date" name="completion_date" id="completion_date" value="{{$project->completion_date}}">
                                <span class="alert-danger">{{$errors->first('completion_date')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="5" name="description" id="description" placeholder="Description For Project">{{$project->description}}</textarea>
                                <span class="alert-danger">{{$errors->first('description')}}</span>
                            </div>                           
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <a href="{{route('project.list')}}" class="btn btn-default">Cancel</a>
                                <button name="submit" type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div><!--/.main-->
@section('page-script')
<script>
    activeParentMenu('project');
</script>
@endsection
@endsection