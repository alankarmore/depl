@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('current-opening.list')}}">Openings</a></li>
            <li class="active">Edit Opening Details</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Opening information</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        @include('admin.messages')
                        <form role="form" name="frmMenu" id='frmMenu' action="{{route('current-opening.update',array('id' => $opening->id))}}" method="POST">
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" placeholder="Menu Title" name="title" id="title" value="{{$opening->title}}">
                                <span class="alert-danger">{{$errors->first('title')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="10" name="description" id="description" placeholder="Menu Description">{{$opening->description}}</textarea>
                                <span class="alert-danger">{{$errors->first('description')}}</span>
                            </div>
                            <div class="form-group meta">
                                <label>Location</label>
                                <input class="form-control" placeholder="Location" name="location" id="location" value="{{$opening->location}}">
                                <span class="alert-danger">{{$errors->first('location')}}</span>
                            </div>
                            <div class="form-group meta">
                                <span class="pull-left"><label>Experience</label></span>
                                <span class="col-md-4">
                                <select name="from_experience" id="from_experience" class="form-control">
                                    @for($index = 0; $index <= 20; $index++)
                                        <option value="{{$index}}" @if($opening->from_experience == $index) selected="selected" @endif>{{$index}}</option>
                                    @endfor
                                </select>
                                </span>
                                <span class="col-xs-1">To</span>
                                <span class="col-md-4">
                                <select name="to_experience" id="to_experience" class="form-control">
                                    @for($index = 0; $index <= 20; $index++)
                                        <option value="{{$index}}" @if($opening->to_experience == $index) selected="selected" @endif>{{$index}}</option>
                                    @endfor
                                    <option value="+" @if($opening->to_experience == '+') selected="selected" @endif>+</option>
                                </select>
                                </span>
                                <span class="col-xs-1">Years</span>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group meta">
                                <label>Qualification</label>
                                <input class="form-control" placeholder="Qualification" name="qualification" id="qualification" value="{{$opening->qualification}}">
                                <span class="alert-danger">{{$errors->first('qualification')}}</span>
                            </div>
                            <div class="form-group meta">
                                <label>Skills</label>
                                <input class="form-control" placeholder="Skills" name="skills" id="skills" value="{{$opening->skills}}">
                                <span class="alert-danger">{{$errors->first('skills')}}</span>
                            </div>
                            <div class="form-group meta">
                                <label>Meta Title</label>
                                <input class="form-control" placeholder="Meta Title" name="meta_title" id="meta_title" value="{{$opening->meta_title}}">
                                <span class="alert-danger">{{$errors->first('meta_title')}}</span>
                            </div>
                            <div class="form-group meta">
                                <label>Meta Keyword</label>
                                <input class="form-control" placeholder="Meta Keyword" name="meta_keyword" id="meta_keyword" value="{{$opening->meta_keyword}}">
                                <span class="alert-danger">{{$errors->first('meta_keyword')}}</span>
                            </div>
                            <div class="form-group meta">
                                <label>Meta Description</label>
                                <textarea class="form-control" rows="3" name="meta_description" id="meta_description" placeholder="Meta Description">{{$opening->meta_description}}</textarea>
                                <span class="alert-danger">{{$errors->first('meta_description')}}</span>
                            </div>                            
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <a href="{{route('current-opening.list')}}" class="btn btn-default">Cancel</a>
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
    activeParentMenu('openings');
</script>
@endsection
@endsection
