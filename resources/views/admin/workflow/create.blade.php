@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('workflow.list')}}">Our Work Flow</a></li>
            <li class="active">Add New Work Flow</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Work Flow</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        @include('admin.messages')
                        <form role="form" name="frmWorkFlow" id='frmWorkFlow' action="{{route('workflow.save')}}" method="POST">
                            <div class="form-group">
                                <label>Service which this work flow belongs to</label>
                                <select name="service" id="service" class="form-control">
                                    <option value="0">Select Service</option>
                                </select>
                                <span class="alert-danger">{{$errors->first('service')}}</span>
                            </div>                            
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" placeholder="Work Flow Title" name="title" id="title" value="{{old('title')?old('title'):''}}">
                                <span class="alert-danger">{{$errors->first('title')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" name="description" id="description" placeholder="Work Flow Description">{{old('description')?old('description'):''}}</textarea>
                                <span class="alert-danger">{{$errors->first('description')}}</span>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <a href="{{route('workflow.list')}}" class="btn btn-default">Cancel</a>
                                <button name="submit" type="reset" class="btn btn-info">Reset</button>
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
</script>
@endsection
@endsection
