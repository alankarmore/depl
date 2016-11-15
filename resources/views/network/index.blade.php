@extends('layout.main')
@section('content')

    <section id="about">
        <div class="container-fluid no-padding">
            <div class="row">
                <div class="col-md-12">
                    <!-- Start welcome area -->
                    <div class="welcome-area">
                        <div class="title-area">
                            <h2 class="tittle wow fadeInUp">Map</h2>
                        </div>
                    </div>
                    <!-- End welcome area -->
                </div>
            </div>
            <!-- start form section -->
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <div align="center">
                            <form class="form-inline" action="{{route('get-networks')}}" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                <div class="form-group">
                                    <label for="exampleInputName2">State</label>
                                    <select name="state" id="state" class="form-control">
                                        <option value="">State</option>
                                        @foreach($states as $state)
                                            <option value="{{$state->slug}}" @if($state->slug == $defaultState) selected="selected" @endif >{{ucfirst($state->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName2">State</label>
                                    <select name="district" id="district" class="form-control">
                                        <option value="">District</option>
                                        @foreach($districts as $district)
                                            <option value="{{$district->slug}}" @if($district->slug == $defaultDistrict) selected="selected" @endif >{{ucfirst($district->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail2">City</label>
                                    <select name="city" id="city" class="form-control">
                                        <option value="">Select City</option>
                                        @foreach($citiesByDistrict as $city)
                                            <option value="{{$city->slug}}" @if($city->slug == $defaultCity) selected="selected" @endif >{{ucfirst($city->name)}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <button type="submit" class="btn btn-default">Show</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start map section -->

            <div class="row margin-top20">
                <div class="col-md-12">
                    @if($response && $response->count() > 0)
                        <div id="map" style="width:100%;height:500px"></div>
                    @else
                        <div class="col-md-12">
                        <div class="alert alert-warning"><center>Oops!! No records found for <strong>{{ucfirst($defaultState)}}</strong> and <strong>{{ucfirst($defaultCity)}}</strong></center></div>
                        </div>
                    @endif
                </div>
            </div>
            <!-- End map section -->


            @section('page-script')
                <script>
                    $(function(){
                        $.ajaxSetup({
                            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
                        });

                        $(document).on('change','district',function(){
                            var stateId = $(this).val();
                            getCities(stateId);
                        });

                        $(document).on('change','state',function(){
                            var district = $(this).val();
                            getDistricts(district);
                        });
                    });

                    function getCities(districtId) {
                        var route = '{{route('map-getcities')}}';
                        var res = null;
                        $.ajax({
                            url:route,
                            data:{'id': districtId},
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

                    function getDistricts(stateId) {
                        var route = '{{route('map-getdistricts')}}';
                        var res = null;
                        $.ajax({
                            url:route,
                            data:{'id': stateId},
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
                    }

                    @if($response && $response->count() > 0)

                    function myMap() {
                        var locations = [
                             @foreach($response as $res)
                                @if(!empty($res->lat) && !empty($res->long))
                                    ['{{$res->title}}', {{$res->lat}}, {{$res->long}}, '{{$res->address}}'],
                                @endif
                             @endforeach
                        ];

                        var mapCanvas = document.getElementById("map");
                        var mapOptions = {
                            center: new google.maps.LatLng({{$centerPoints[0]}}, {{$centerPoints[1]}}),
                            zoom: 8
                        }

                        var map = new google.maps.Map(document.getElementById("map"),mapOptions);
                        console.log(locations);
                        setMarkers(map,locations)
                    }

                    function setMarkers(map,locations){

                        var marker, i

                        var regex = /&lt;br\s*[\/]?&gt;/gi;
                        for (i = 0; i < locations.length; i++)
                        {
                            var title = '<b>' + locations[i][0] + '</b>'
                            var lat = locations[i][1]
                            var long = locations[i][2]
                            var add =  locations[i][3]
                            add = add.replace(regex,"<br/>");
                            latlngset = new google.maps.LatLng(lat, long);
                            var marker = new google.maps.Marker({
                                map: map, title: title , position: latlngset
                            });
                            map.setCenter(marker.getPosition())
                            var content = title + "<br/>" + add
                            var infowindow = new google.maps.InfoWindow();
                            infowindow.setContent(content);

                            google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
                                return function() {
                                    infowindow.setContent(content);
                                    infowindow.open(map,marker);
                                };
                            })(marker,content,infowindow));
                        }
                    }

                </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRUjHsGvBqOyviDKGicNPcqSd_jn355G4&callback=myMap" async defer></script>
            @endif
                <?php /*
<script>

    var maproute = "{{route('get-map')}}";
    var state = $("#state").val();
    var city = $("#city").val() | '{{$defaultCity}}';
    function getMap(stateId,cityId) {
        $.ajax({
            url:maproute,
            data:{state:state, city:city},
            dataType:"HTML",
            type:"POST",
            success:function(msg) {
                $("#mapDiv").replaceWith(msg);
            }
        });
    }
    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
        });

        getMap();
       $(document).on('click','#show',function(){
           var state = $("#state").val();
           var city = $("#city").val();
           getMap(state,city);
       });
    });
</script>

 */?>
@endsection
@endsection