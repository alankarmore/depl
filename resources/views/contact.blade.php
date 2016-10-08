@extends('layout.main')
@section('content')
    <!-- Start banner section -->
    <div class="container-fluid no-padding">
        <div class="inner-banner">
            <img src="{{asset('assets/images/banner1.jpg')}}">
        </div>
    </div>
    <!-- End banner section -->
    <section class="inner-about margin-top134">
        <div class="container wow fadeInUp">
            <div align="center">
                <h2>Contact Us</h2>
                <div class="green-sep"></div>
            </div>
            @if (session('success'))
                <div class="alert alert-success margin-top20">{{ session('success') }}</div>
            @elseif (session('error'))
                <div class="alert alert-danger margin-top20">{{ session('error') }}</div>
            @endif
        </div>

        <div class="row margin-top20">
            <div class="col-md-12">
                @foreach($offices as $office)
                    <div class="col-xs-3 col-sm-3">
                        <h3>{{ucfirst($office->title)}},</h3>
                        <p>{{$office->address}},</p>
                        <p>{{ucfirst($office->city)}},{{ucfirst($office->state)}},{{$office->pincode}}</p>
                        @if($office->phone)
                            <p class="glyphicon glyphicon-phone-alt">: {{$office->phone}},</p>
                        @endif
                        @if($office->fax)
                            <p class="glyphicon glyphicon-print">: {{$office->fax}},</p>
                         @endif
                        <div class="clearfix visible-xs-block"></div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row margin-top20">
            <div class="col-md-12">
                <div id="map" style="width:100%;height:300px"></div>
            </div>
        </div>
        <br/>

        @if($officeImages)
        <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="autoplay">
                @foreach($officeImages as $officeImage)
                    <div><img src="{{route('getimage',array('width' => 1366, 'height' => 224, 'folder' => 'office', 'file' => $office->image))}}" alt="Office"></div>
                @endforeach
            </div>
        </div>
        </div>
        @endif

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="contact-right wow fadeInRight">
                <h2 style="margin-bottom:none;">Send a message</h2>
                <form action="{{route('post-contact')}}" class="contact-form" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" maxlength="100" required="required" value="{{ old('first_name')?old('first_name'):'' }}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" maxlength="100" required="required" value="{{ old('last_name')?old('last_name'):'' }}">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" required="required" name="email" id="email"  value="{{ old('email')?old('email'):'' }}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Subject" name="subject" id="subject" maxlength="150" required="required" value="{{ old('subject')?old('subject'):'' }}">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="10" placeholder="Your Message" name="message" id="message" maxlength="300" required="required">{{ old('message')?old('message'):null}}</textarea>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <button type="submit" data-text="SUBMIT" class="button button-default"><span>SUBMIT</span></button>
                </form>
            </div>
        </div>

    </section>

@section('page-script')
    <script type="text/javascript">
        function myMap() {
            var locations = [
                @foreach($officesArray as $res)
                ['{{$res->title}}', {{$res->lat}}, {{$res->lng}}, '{{$res->address}}'],
                @endforeach
           ];

            var mapCanvas = document.getElementById("map");
            var mapOptions = {
                center: new google.maps.LatLng(15.508742,-0.500850),
                zoom: 4
            }

            var map = new google.maps.Map(document.getElementById("map"),mapOptions);
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
                add = add.replace(regex,'<br/>');
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

        $(document).ready(function(){
            $('.autoplay').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false
            });
        });

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRUjHsGvBqOyviDKGicNPcqSd_jn355G4&callback=myMap" async defer></script>
@endsection
@endsection