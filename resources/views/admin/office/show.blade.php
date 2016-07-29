@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('office.list')}}">Our Offices</a></li>
            <li class="active">Office Details</li>
        </ol>
    </div><!--/.row-->

    <div class="row">&nbsp;</div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Type</label>
                            <div>@if($office->type == 1) Head Office @else Branch Office @endif</div>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <div>{{$office->address}}</div>
                        </div>                        
                        <div class="form-group">
                            <label>City</label>
                            <div>{{$office->city}}</div>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <div>{{$office->state}}</div>
                        </div>
                        <div class="form-group">
                            <label>Pincode</label>
                            <div>{{$office->pincode}}</div>
                        </div>
                        @if(!empty($office->phone))
                        <div class="form-group">
                            <label>Phone</label>
                            <div>{{$office->phone}}</div>
                        </div>
                        @endif
                        
                        @if(!empty($office->fax))
                        <div class="form-group">
                            <label>Fax</label>
                            <div>{{$office->fax}}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div><!--/.main-->
@endsection
