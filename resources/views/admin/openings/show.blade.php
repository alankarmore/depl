@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('current-opening.list')}}">Current Opening</a></li>
            <li class="active">Menu Details</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{$opening->title}}</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <div>{{ $opening->description }}</div>
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <div>{{ ucwords($opening->location) }}</div>
                        </div>
                        <div class="form-group">
                            <label>Qualification</label>
                            <div>{{ ucwords($opening->qualification) }}</div>
                        </div>
                        <div class="form-group">
                            <label>Skills</label>
                            <div>{{ ucwords($opening->skills) }}</div>
                        </div>
                        <div class="form-group">
                            <label>Experience</label>
                            <div>{{$opening->experience}} Years</div>
                        </div>
                        @if($opening->meta_title)
                        <div class="form-group">
                            <label>Meta Title</label>
                            <div>{{$opening->meta_title}}</div>
                        </div>
                        @endif
                        @if($opening->meta_keywords)
                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <div>{{$opening->meta_keywords}}</div>
                        </div>
                        @endif
                        @if($opening->meta_description)
                        <div class="form-group">
                            <label>Meta Description</label>
                            <div>{{$opening->meta_description}}</div>
                        </div>
                        @endif
                        <div class="form-group">
                            <a href="{{route('current-opening.list')}}" class="btn btn-default">Back</a>
                        </div>
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
