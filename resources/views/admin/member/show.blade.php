@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('team.list')}}">Team Members</a></li>
            <li class="active">Member Details</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{$member->first_name}} {{$member->last_name}}</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Designation</label>
                            <div>{{ $member->designation }}</div>
                        </div>
                        <div class="form-group">
                            <label>About Member</label>
                            <div>{!! $member->description !!}</div>
                        </div>
                        <div class="form-group">
                            <label>Image</label><br/>
                            <img src="{{asset('uploads/member')}}/{{$member->image}}" width="100px" height="100px" title="{{$member->title}}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div><!--/.main-->
@section('page-script')
<script>
activeParentMenu('teams');
</script>
@endsection
@endsection
