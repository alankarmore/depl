@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('network.list')}}">Network</a></li>
            <li class="active">Edit Route Details</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Route Information</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        @include('admin.messages')
                        <form role="form" name="frmNetwork" id='frmNetwork' action="{{route('network.update',array('id' => $route->id))}}" method="POST">
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" placeholder="Network Title" name="title" id="title" value="{{$route->title}}">
                                <span class="alert-danger">{{$errors->first('title')}}</span>
                            </div>
                            <div class="form-group">
                                <label>State</label>
                                <select name="state" id="state" class="form-control">
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                    <option value="{{$state->id}}" @if($route->state_id == $state->id) selected='selected' @endif>{{ucfirst($state->name)}}</option>
                                    @endforeach
                                </select>
                                <span class="alert-danger">{{$errors->first('state')}}</span>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <select name="city" id="city" class="form-control">
                                    <option value="">Select City</option>
                                </select>
                                <span class="alert-danger">{{$errors->first('city')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" placeholder="address" name="address" id="length" value="{{$route->address}}">
                                <span class="alert-danger">{{$errors->first('address')}}</span>
                            </div>
                            <div class="form-group">
                                <label>Pincode</label>
                                <input class="form-control" placeholder="pincode" name="pincode" id="length" value="{{$route->pincode}}">
                                <span class="alert-danger">{{$errors->first('pincode')}}</span>
                            </div>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <a href="{{route('network.list')}}" class="btn btn-default">Cancel</a>
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
    activeParentMenu('networks');
    function getCities(stateId,city) {
        city = city | null;
        var res = null;
        $.ajax({
            url:route,
            data:{'id': stateId, 'city': city},
            dataType:"JSON",
            type:"POST",
            success:function(msg)  {
                res = msg;
            },
            complete:function() {
                if(res.string != null || res.string != '' || res.string != 'undefined') {
                    $("#city").html(res.string);
                    $("#city").focus();
                }
            }
        });
    }

    var route = '{{route("getcities")}}';
    var stateId = '{{$route->state_id}}';
    var city = '{{$route->city_id}}';
    getCities(stateId,city);
    $(document).on('change','#state',function(){
        getCities($(this).val(),null);
    });
</script>
@endsection
@endsection