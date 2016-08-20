@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('service.list')}}">Our Services</a></li>
            <li class="active">Service Details</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{$service->title}}</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <div>{{$service->description}}</div>
                        </div>
                        <div class="form-group">
                            <label>Image</label><br/>
                            <img src="{{asset('uploads/service')}}/{{$service->image}}" width="100px" height="100px" title="{{$service->title}}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div><!--/.main-->
@section('page-script')
<script>
activeParentMenu('services');
</script>
@endsection
@endsection
