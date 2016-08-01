@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('menu.list')}}">CMS Management</a></li>
            <li class="active">Edit Menu Details</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update menu information</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        @include('admin.messages')
                        <form role="form" name="frmMenu" id='frmMenu' action="{{route('menu.update',array('id' => $menu->id))}}" method="POST">
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" placeholder="Menu Title" name="title" id="title" value="{{$menu->title}}">
                                <span class="alert-danger">{{$errors->first('title')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="10" name="description" id="description" placeholder="Menu Description">{{$menu->description}}</textarea>
                                <span class="alert-danger">{{$errors->first('description')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input class="form-control" placeholder="Meta Title" name="meta_title" id="meta_title" value="{{$menu->meta_title}}">
                                <span class="alert-danger">{{$errors->first('meta_title')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Meta Keyword</label>
                                <input class="form-control" placeholder="Menu Keyword" name="meta_keyword" id="meta_keyword" value="{{$menu->meta_keyword}}">
                                <span class="alert-danger">{{$errors->first('meta_keyword')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea class="form-control" rows="3" name="meta_description" id="meta_description" placeholder="Meta Description">{{$menu->meta_description}}</textarea>
                                <span class="alert-danger">{{$errors->first('meta_description')}}</span>
                            </div>                            
                            <div class="form-group">
                                <label>Previous Image</label><br/>
                                <img src="{{asset('uploads/menu/')}}{{$menu->image_name}}" width="100px" height="100px" title="{{$menu->title}}"/>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" id="image" accept="image/*" />
                                <span class="alert-danger">{{$errors->first('image')}}</span>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <a href="{{route('menu.list')}}" class="btn btn-default">Cancel</a>
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
    activeParentMenu('menus'); 
</script>
@endsection
@endsection
