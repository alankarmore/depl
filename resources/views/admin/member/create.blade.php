@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('team.list')}}">Team Members</a></li>
            <li class="active">Add New Member</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Service</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        @include('admin.messages')
                        <form role="form" name="frmTeamMember" id='frmTeamMember' action="{{route('team.save')}}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>First Name</label>
                                <input class="form-control" placeholder="First Name" name="first_name" id="first_name" value="{{old('first_name')?old('first_name'):''}}" maxlength="150">
                                <span class="alert-danger">{{$errors->first('first_name')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" placeholder="Last Name" name="last_name" id="last_name" value="{{old('last_name')?old('last_name'):''}}" maxlength="150">
                                <span class="alert-danger">{{$errors->first('last_name')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Designation</label>
                                <input class="form-control" placeholder="Designation" name="designation" id="designation" value="{{old('designation')?old('designation'):''}}" maxlength="150">
                                <span class="alert-danger">{{$errors->first('designation')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="8" name="description" id="description" placeholder="About Member">{{old('description')?old('description'):''}}</textarea>
                                <span class="alert-danger">{{$errors->first('description')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" id="image" accept="image/*" />
                                <input type="hidden" name="mediatype" id="mediatype" value="image" />
                                <input type="hidden" name="fileName" id="fileName" value="" />
                                <span class="alert-danger">{{$errors->first('image')}}</span>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div id="uploadwrapper"></div>
                            <br/>
                            <div class="form-group">
                                <a href="{{route('team.list')}}" class="btn btn-default">Cancel</a>
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
@endsection
