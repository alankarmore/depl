@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('network.list')}}">Networks</a></li>
            <li class="active">Route Details</li>
        </ol>
    </div><!--/.row-->

    <div class="row">&nbsp;</div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Title</label>
                            <div>{{$network->title}}</div>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <div>{{$network->state}}</div>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <div>{{$network->city}}</div>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <div>{{$network->address}}</div>
                        </div>
                        <div class="form-group">
                            <label>Pincode</label>
                            <div>{{$network->pincode}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div><!--/.main-->
@section('page-script')
<script>
    activeParentMenu('network');
</script>
@endsection
@endsection
