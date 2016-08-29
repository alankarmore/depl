@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('slogan.list')}}">Slogan</a></li>
            <li class="active">Slogan Details</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">&nbsp;</div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Main Phrase</label>
                            <div>{{ ucfirst($slogan->main_phrase)}}</div>
                        </div>
                        <div class="form-group">
                            <label>Sub Phrase</label>
                            <div>{{ $slogan->sub_phrase}}</div>
                        </div>
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
