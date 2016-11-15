@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('city.list')}}">Cities</a></li>
            <li class="active">Edit City Details</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update City Information</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        @include('admin.messages')
                        <form role="form" name="frmState" id='frmState' action="{{route('city.update',array('id' => $city->id))}}" method="POST">
                            <div class="form-group">
                                <label>State Name</label>
                                <select name="states_id" id="states_id" class="form-control">
                                    <option value="0">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}" @if($state->id == $city->states_id) selected="selected" @endif>{{ucfirst($state->name)}}</option>
                                    @endforeach
                                </select>
                                <span class="alert-danger">{{$errors->first('states_id')}}</span>
                            </div>
                            <div class="form-group">
                                <label>District Name</label>
                                <select name="district_id" id="district_id" class="form-control">
                                    <option value="0">Select District</option>
                                    @foreach($districts as $district)
                                        <option value="{{$district->id}}" @if($district->id == $city->district_id) selected="selected" @endif>{{ucfirst($district->name)}}</option>
                                    @endforeach
                                </select>
                                <span class="alert-danger">{{$errors->first('district_id')}}</span>
                            </div>
                            <div class="form-group">
                                <label>City Name</label>
                                <input class="form-control" placeholder="City Name" name="name" id="name" value="{{$city->name}}" maxlength="100">
                                <span class="alert-danger">{{$errors->first('name')}}</span>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <a href="{{route('city.list')}}" class="btn btn-default">Cancel</a>
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
        activeParentMenu('cities');
        $(function(){
            $(document).on('change','#states_id',function(){
                var res = "";
                var route = "{{route('state.districts.list')}}";
                $.ajax({
                    url: route,
                    type: "POST",
                    data: {'state': $(this).val(),'district_id':$("#district_id").val()},
                    dataType: 'JSON',
                    beforeSend: function () {
                    },
                    success: function (response) {
                        res = response;
                    },
                    complete: function () {
                        if(res.valid && res.string) {
                            $("#district_id").html(res.string);
                        } else {
                            $("#district_id").html('<option value="0">Select District</option>');
                        }
                    }
                });
            });
        });
    </script>
@endsection
@endsection
