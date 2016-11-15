@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li ><a href="{{route('districts.list')}}">Districts</a></li>
            <li class="active">Edit District Details</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update District Information</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        @include('admin.messages')
                        <form role="form" name="frmDistrict" id='frmDistrict' action="{{route('districts.update',array('id' => $district->id))}}" method="POST">
                            <div class="form-group">
                                <label>State Name</label>
                                <select name="states_id" id="states_id" class="form-control">
                                    <option value="0">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}" @if($state->id == $district->states_id) selected="selected" @endif>{{ucfirst($state->name)}}</option>
                                    @endforeach
                                </select>
                                <span class="alert-danger">{{$errors->first('states_id')}}</span>
                            </div>
                            <div class="form-group">
                                <label>District Name</label>
                                <input class="form-control" placeholder="District Name" name="name" id="name" value="{{$district->name}}" maxlength="100">
                                <span class="alert-danger">{{$errors->first('name')}}</span>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <a href="{{route('districts.list')}}" class="btn btn-default">Cancel</a>
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
        activeParentMenu('districts');
    </script>
@endsection
@endsection
