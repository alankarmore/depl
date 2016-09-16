@extends('layout.main')
@section('content')
<!-- Start banner section -->
<div class="container-fluid no-padding">
    <div class="inner-banner">
        <img src="{{asset('assets/images/banner1.jpg')}}">
    </div>
</div>
<!-- End banner section -->

<!-- Start services section -->
<section class="inner-content margin-top134">
    <div class="container wow fadeInUp">
        <div align="center">
            <h2>Network</h2>
            <div class="green-sep"></div>
        </div>
    </div>

    <div class="col-md-4 margin-top20">
        <div class="form-group">
            <label>State</label>
            <select name="state" id="state" class="form-control">
                <option value="">Select State</option>
                @foreach($states as $state)
                <option value="{{$state->id}}">{{ucfirst($state->name)}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button name='show' id="show" type="button" >Show Map </button>
        </div>
        <div id="mapDiv"></div>
</section>
<!-- End services section -->
@section('page-script')
<script>
    var maproute = "{{route('get-map')}}";
    $(function(){
       $(document).on('click','#show',function(){
          $.ajax({
             url:maproute,
             data:{state:$("#state").val()},
             dataType:"HTML",
             success:function(msg) {
                 $("#mapDiv").html(msg);
             }
          });
       });
    });
</script>
@endsection
@endsection