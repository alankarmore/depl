@extends('admin.layout.master')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li ><a href="{{route('config.list')}}">Configuration Settings</a></li>
                <li class="active">Edit Configuration Details</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Update {{ucwords(str_replace("_",' ',strtolower($config->config_name)))}}</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12">
                            @include('admin.messages')
                            <form role="form" name="frmOffice" id='frmOffice' action="{{route('config.update',array('id' => $config->id))}}" method="POST">
                                @if('SITE_LOGO' == $config->config_name)
                                    <p>Logo image must have width 45 pixels and height 53 pixels</p>
                                    <div class="form-group" id="uploadwrapper">
                                        <label>Previous Logo</label><br/>
                                        <img src="{{asset('uploads')}}/{{$config->config_value}}" width="100px" height="100px"/>
                                    </div>
                                    <div class="form-group">
                                        <label>New Logo</label>
                                        <input type="file" name="image" id="image" accept="image/*" />
                                        <input type="hidden" name="mediatype" id="mediatype" value="image" />
                                        <input type="hidden" name="fileName" id="fileName" value="" />
                                        <span class="alert-danger">{{$errors->first('image')}}</span>
                                    </div>

                                @else
                                    <div class="form-group">
                                        <label>{{ucwords(str_replace("_",' ',strtolower($config->config_name)))}}</label>
                                        <input class="form-control" placeholder="Configuration Value" name="config_value" id="config_value"  value="{{$config->config_value}}" />
                                        <span class="alert-danger">{{$errors->first('config_value')}}</span>
                                    </div>
                                @endif
                                <input type="hidden" name="config_id" value="{{ $config->id }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <a href="{{route('config.list')}}" class="btn btn-default">Cancel</a>
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
        activeParentMenu('config');
    </script>
@endsection
@endsection
