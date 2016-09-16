@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('network.list')}}">Networks</a></li>
            <li class="active">Add New Route</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Route</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        @include('admin.messages')
                        <form role="form" name="frmNetwork" id='frmNetwork' action="{{route('network.save')}}" method="POST">
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" placeholder="Network Title" name="title" id="title" value="{{old('title')?old('title'):''}}">
                                <span class="alert-danger">{{$errors->first('title')}}</span>
                            </div>
                            <div class="form-group">
                                <label>State</label>
                                <select name="state" id="state" class="form-control">
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                    <option value="{{$state->id}}" @if(old('state') && old('state') == $state->id) selected='selected' @endif>{{ucfirst($state->name)}}</option>
                                    @endforeach
                                </select>
                                <span class="alert-danger">{{$errors->first('state')}}</span>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input class="form-control" placeholder="city" name="city" id="company" value="{{old('city')?old('city'):''}}">
                                <span class="alert-danger">{{$errors->first('city')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" placeholder="address" name="address" id="length" value="{{old('address')?old('address'):''}}">
                                <span class="alert-danger">{{$errors->first('address')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Pincode</label>
                                <input class="form-control" placeholder="pincode" name="pincode" id="length" value="{{old('pincode')?old('pincode'):''}}">
                                <span class="alert-danger">{{$errors->first('pincode')}}</span>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <a href="{{route('network.list')}}" class="btn btn-default">Cancel</a>
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
@endsection
