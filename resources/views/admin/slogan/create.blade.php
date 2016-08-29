@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('slogan.list')}}">Slogans</a></li>
            <li class="active">Add New Slogan</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Slogan</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        @include('admin.messages')
                        <form role="form" name="frmSlogan" id='frmSlogan' action="{{route('slogan.save')}}" method="POST">
                            <div class="form-group">
                                <label>Main Phrase</label>
                                <input class="form-control" placeholder="Slogan Main Phrase" name="main_phrase" id="main_phrase" value="{{old('main_phrase')?old('main_phrase'):''}}" maxlength="20">
                                <span class="alert-danger">{{$errors->first('main_phrase')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Sub Phrase</label>
                                <input class="form-control" placeholder="Sub Phrase" name="sub_phrase" id="sub_phrase" value="{{old('sub_phrase')?old('sub_phrase'):''}}" maxlength="50">
                                <span class="alert-danger">{{$errors->first('sub_phrase')}}</span>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <a href="{{route('slogan.list')}}" class="btn btn-default">Cancel</a>
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
        activeParentMenu('slogans');
    </script>
@endsection
@endsection
