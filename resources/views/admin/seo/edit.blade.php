@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('admin.seo')}}">SEO</a></li>
            <li class="active">Manage SEO Details</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update SEO Information</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        @include('admin.messages')
                        <form role="form" name="frmProject" id='frmProject' action="{{route('admin.seo.update',array('id' => !empty($seo->id) ? $seo->id : 0 ))}}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input class="form-control" placeholder="Meta Title" name="meta_title" id="meta_title" value="{{ !empty($seo->meta_title) ? $seo->meta_title : "" }}">
                                <span class="alert-danger">{{$errors->first('meta_title')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Meta Keywords</label>
                                <input class="form-control" placeholder="Meta Title" name="meta_keyword" id="meta_keyword" value="{{ !empty($seo->meta_keyword) ? $seo->meta_keyword : "" }}">
                                <span class="alert-danger">{{$errors->first('meta_keyword')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea class="form-control" rows="3" name="meta_description" id="meta_description" placeholder="Meta Description">{{!empty($seo->meta_description) ? $seo->meta_description : ""}}</textarea>
                                <span class="alert-danger">{{$errors->first('meta_description')}}</span>
                            </div>
                            <div class="form-group">
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
@endsection
@endsection