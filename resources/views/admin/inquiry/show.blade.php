@extends('admin.layout.master')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li ><a href="{{route('inquiry.list')}}">Manage Inquiries</a></li>
                <li class="active">Inquiry Details</li>
            </ol>
        </div><!--/.row-->

        <div class="row">&nbsp;</div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <div>{{ucfirst($inquiry->first_name)}}</div>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <div>{{ucfirst($inquiry->last_name)}}</div>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <div>{{ucwords($inquiry->last_name)}}</div>
                            </div>
                            <div class="form-group">
                                <label>Subject</label>
                                <div>{{ucwords($inquiry->subject)}}</div>
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <div>{{$inquiry->message}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->
    </div><!--/.main-->
@endsection
