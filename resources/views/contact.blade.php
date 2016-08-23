@extends('layout.main')
@section('content')
    <!-- Start banner section -->
    <div class="container-fluid no-padding">
        <div class="inner-banner">
            <img src="{{asset('assets/images/banner1.jpg')}}">
        </div>
    </div>
    <!-- End banner section -->
    <!-- Start about section -->
    <section class="inner-about margin-top134">
        <div class="container wow fadeInUp">
            <div align="center">
                <h2>Contact Us</h2>
                <div class="green-sep"></div>
            </div>

        </div>

        <!-- Start Google Map -->
        <section class="google-map-wrap margin-top40 margin-bottom40" itemscope itemprop="hasMap" itemtype="http://schema.org/Map"
            <div id="google-map" class="google-map"></div>
        </section>
        <!-- End Google Map -->

        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="autoplay">
                <div><img src="{{asset('assets/images/office1.jpg')}}" alt="office"></div>
                <div><img src="{{asset('assets/images/office2.jpg')}}" alt="office"></div>
                <div><img src="{{asset('assets/images/office3.jpg')}}" alt="office"></div>
                <div><img src="{{asset('assets/images/office4.jpg')}}" alt="office"></div>
            </div>
        </div>


        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="contact-right wow fadeInRight">
                <h2>Send a message</h2>
                <form action="" class="contact-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control"></textarea>
                    </div>
                    <button type="submit" data-text="SUBMIT" class="button button-default"><span>SUBMIT</span></button>
                </form>
            </div>
        </div>
    </section>
    <!-- End about section -->
@endsection
@section('page-script')
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyC1d20ypwVOzpQEdq99UktbkozxnDYbEo8" type="text/javascript"></script>
    <script type='text/javascript' src='{{asset('assets/js/gmaps.js')}}'></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.autoplay').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false
            });

            /* Do not drag on mobile. */
            var is_touch_device = 'ontouchstart' in document.documentElement;
            @if(isset($officesArray[0]['google_map']['lat']))
                 map_area_lat = {{$officesArray[0]['google_map']['lat']}};
            @endif
            @if(isset($officesArray[0]['google_map']['lng']))
                 map_area_lng = {{$officesArray[0]['google_map']['lng']}};
            @endif

            var map = new GMaps({
                el: '#google-map',
                lat: map_area_lat,
                lng: map_area_lng,
                scrollwheel: false,
                draggable: ! is_touch_device
            });

            /* Map Bound */
            var bounds = [];
                @foreach( $officesArray as $location )
                $name = "{{$location['location_name']}}";
                $addr =  '{{$location["location_address"]}}';
                $info = "{{$location['info']}}";
                $map_lat = {{$location['google_map']['lat']}};
                $map_lng = {{$location['google_map']['lng']}};
                @endforeach
                 /* Set Bound Marker */
                var latlng = new google.maps.LatLng(map_area_lat, map_area_lng);
                bounds.push(latlng);
                /* Add Marker */
                map.addMarker({
                    lat: $map_lat,
                    lng: $map_lng,
                    title: $name,
                    infoWindow: {
                        content: $info
                    }
                });

                /* Fit All Marker to map */
                map.fitLatLngBounds(bounds);

                /* Make Map Responsive */
                var $window = $(window);
                function mapWidth() {
                    var size = $('.google-map-wrap').width();
                    $('.google-map').css({width: size + 'px', height: (size/2) + 'px'});
                }
                mapWidth();
                $(window).resize(mapWidth);
            });

    </script>
@endsection