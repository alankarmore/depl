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
                                    <label>District</label>
                                    <select name="district" id="district" class="form-control">
                                        <option value="">Select District</option>
                                    </select>
                                    <span class="alert-danger">{{$errors->first('district')}}</span>
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
                                    <input class="form-control" placeholder="address" name="address" id="length" value="{{old('address')?old('address'):''}}">
                                    <span class="alert-danger">{{$errors->first('address')}}</span>
                                </div>
                                <div class="form-group">
                                    <label>Pincode</label>
                                    <input class="form-control" placeholder="pincode" name="pincode" id="pincode" value="{{old('pincode')?old('pincode'):''}}">
                                    <span class="alert-danger">{{$errors->first('pincode')}}</span>
                                </div>
                                <div class="form-group">
                                    <label>Kms work done</label>
                                    <input class="form-control" placeholder="Kms" name="kms" id="kms" value="{{old('Kms')?old('Kms'):''}}">
                                    <span class="alert-danger">{{$errors->first('kms')}}</span>
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
@section('page-script')
    <script type="text/javascript">
        $(function(){
            $(document).on('change','#state',function(){
                var route = '{{route("state.districts.list")}}';
                var res = null;
                $.ajax({
                    url:route,
                    data:{'state': $("#state").val()},
                    dataType:"JSON",
                    type:"POST",
                    success:function(msg)  {
                        res = msg;
                    },
                    complete:function() {
                        if(res.string != null || res.string != '' || res.string != 'undefined') {
                            $("#district").html(res.string);
                            $("#district").focus();
                        }
                    }
                });
            });

            $(document).on('change','#district',function(){
                var route = '{{route("getcities")}}';
                var res = null;
                $.ajax({
                    url:route,
                    data:{'id': $("#district").val()},
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
            });
        });

    </script>
@endsection
@endsection
