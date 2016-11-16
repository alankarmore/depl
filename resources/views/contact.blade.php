@extends('layout.main')
@section('content')
    <!-- Start banner section -->
    <div class="container-fluid no-padding">
        <div class="inner-banner">
            <img src="{{route('getimage',array('width' => 1366, 'height' => 244, 'folder' => 'cms', 'file' => $pageContent->image))}}">
        </div>
    </div>
    <!-- End banner section -->
    <section class="inner-about margin-top134">
        <div class="container wow fadeInUp">
            <div align="center">
                <h2>Contact Us</h2>
                <div class="green-sep"></div>
            </div>
            @if($pageContent->description)
                <p class="margin-top10">{!! $pageContent->description !!}</p>
            @endif
            @if (session('success'))
                <div class="alert alert-success margin-top20">{{ session('success') }}</div>
            @elseif (session('error'))
                <div class="alert alert-danger margin-top20">{{ session('error') }}</div>
            @endif
        </div>

        <div class="col-md-6">
            <!-- Start Google Map -->
            <div class="row margin-top20">
                <div class="col-md-12">
                    <div id="map" style="width:100%;height:570px"></div>
                </div>
            </div>
        </div>
            <!-- End Google Map -->

        <div class="col-md-6">
            <section class="margin-top40 margin-bottom40">
                <ul><h3>Addesses: </h3>
                    @if($offices)
                        @foreach($offices as $office)
                            <li>
                                <h4>{{ucfirst($office->title)}},</h4>
                                <p>{{$office->address}},</p>
                                <p>{{ucfirst($office->city)}},{{ucfirst($office->state)}},{{$office->pincode}}</p>
                                @if($office->phone)
                                    <p class="glyphicon glyphicon-phone-alt">: {{$office->phone}},</p>
                                @endif
                                @if($office->fax)
                                    <p class="glyphicon glyphicon-print">: {{$office->fax}},</p>
                                @endif
                                <div class="clearfix visible-xs-block"></div>
                            </li>
                        @endforeach
                    @endif
                    </ul>
            </section>
        </div>

        @if($officeImages)
            <div class="col-md-4 col-sm-12 col-xs-12 clearfix" style="clear:both;">
                <div class="autoplay">
                    @foreach($officeImages as $officeImage)
                        <div><img src="{{route('getimage',array('width' => 1366, 'height' => 500, 'folder' => 'office', 'file' => $officeImage->image))}}" alt="Office"></div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="wow fadeInRight">
                <h2>Send a message</h2>
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
                        <input type="text" class="form-control" placeholder="Contact Number" required="required" name="contact_number" id="contact_number"  value="{{ old('contact_number')?old('contact_number'):'' }}">
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
                    @if($res->lat && $res->lng)
                ['{{$res->title}}', {{$res->lat}}, {{$res->lng}}, '{{$res->address}}'],
                    @endif
                @endforeach
           ];

            var mapCanvas = document.getElementById("map");
            var mapOptions = {
                center: new google.maps.LatLng(20.5937,78.9629),
                zoom: 6
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