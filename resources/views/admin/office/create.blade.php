@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('office.list')}}">Our Offices</a></li>
            <li class="active">Add New Office</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Office</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        @include('admin.messages')
                        <form role="form" name="frmOffice" id='frmOffice' action="{{route('office.save')}}" method="POST">
                            <div class="form-group">
                                <label>Title</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="0">Select Option</option>
                                    <option value="1">Head Office</option>
                                    <option value="2" selected="selected">Branch Office</option>
                                </select>
                                <span class="alert-danger">{{$errors->first('type')}}</span>
                            </div>
                            <div class="form-group">
                                <label>State</label>
                                <input class="form-control" placeholder="State Name" name="state" id="state" value="{{old('state')?old('state'):''}}">
                                <span class="alert-danger">{{$errors->first('state')}}</span>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input class="form-control" placeholder="City Name" name="city" id="city" value="{{old('city')?old('city'):''}}">
                                <span class="alert-danger">{{$errors->first('city')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="2" name="address" id="address" placeholder="Address">{{old('address')?old('address'):''}}</textarea>
                                <span class="alert-danger">{{$errors->first('address')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Pincode / Zip Code</label>
                                <input class="form-control" placeholder="Pincode / Zip Code" name="pincode" id="pincode" value="{{old('pincode')?old('pincode'):''}}">
                                <span class="alert-danger">{{$errors->first('pincode')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input class="form-control" placeholder="Phone Number" name="phone" id="phone" value="{{old('phone')?old('phone'):''}}">
                                <span class="alert-danger">{{$errors->first('phone')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Fax</label>
                                <input class="form-control" placeholder="Fax Number Name" name="fax" id="fax" value="{{old('fax')?old('fax'):''}}">
                                <span class="alert-danger">{{$errors->first('fax')}}</span>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <a href="{{route('office.list')}}" class="btn btn-default">Cancel</a>
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
