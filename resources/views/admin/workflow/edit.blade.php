@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('workflow.list')}}">Work Flows</a></li>
            <li class="active">Edit Work Flow Details</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Work Flow Information</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        @include('admin.messages')
                        <form role="form" name="frmWorkFlow" id='frmWorkFlow' action="{{route('workflow.update',array('id' => $workflow->id))}}" method="POST">
                            <div class="form-group">
                                <label>Service which this work flow belongs to</label>
                                <select name="service" id="service" class="form-control">
                                    <option value="0">Select Service</option>
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}" @if($workflow->services_id == $service->id) selected="selected" @endif>{{ucwords($service->title)}}</option>
                                    @endforeach
                                </select>                                    
                                </select>
                                <span class="alert-danger">{{$errors->first('service')}}</span>
                            </div>                               
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" placeholder="Work Flow Title" name="title" id="title" value="{{$workflow->title}}">
                                <span class="alert-danger">{{$errors->first('title')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="10" name="description" id="description" placeholder="Work Flow Description">{{$workflow->description}}</textarea>
                                <span class="alert-danger">{{$errors->first('description')}}</span>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <a href="{{route('workflow.list')}}" class="btn btn-default">Cancel</a>
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
 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
 <script>tinymce.init({ selector:'#description' });</script>
<script>
    activeParentMenu('workflow'); 
</script>
@endsection
@endsection
