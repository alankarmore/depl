@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('menu.list')}}">CMS Management</a></li>
            <li class="active">Add New Menu</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Menu</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    @foreach($errors->all() as $error)
                        {{dd($error)}}
                    @endforeach
                    <div class="col-md-12">
                        <form role="form" name="frmMenu" id='frmMenu' action="{{route('menu.save')}}" method="POST">
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" placeholder="Menu Title" name="title" id="title">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" name="description" id="description" placeholder="Menu Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" id="image" accept="image/*" />
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <a href="{{route('menu.list')}}" class="btn btn-default">Cancel</a>
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
