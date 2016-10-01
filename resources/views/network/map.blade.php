<!-- start map section -->
<div class="row margin-top20">
    <div class="col-md-12">
        <div id="map" style="width:100%;height:500px"></div>
    </div>
</div>

<script>
    function myMap() {
        var locations = '{{$response}}';
        console.log(locations);


  var mapCanvas = document.getElementById("map");
        var mapOptions = {
            center: new google.maps.LatLng({{$centerPoints[0]}},{{$centerPoints[1]}}),
            zoom: 10
        }
        //var map = new google.maps.Map(mapCanvas, mapOptions);
        var map = new google.maps.Map(document.getElementById("map"),
                mapOptions);

        setMarkers(map,locations)
    }

    function setMarkers(map,locations){

        var marker, i

        for (i = 0; i < locations.length; i++)
        {

            var title = locations[i][0]
            var lat = parseFloat(locations[i][1])
            var long = parseFloat(locations[i][2])
            var add =  locations[i][3].replace(/<br\s*[\/]?>/gi, "\n")

            latlngset = new google.maps.LatLng(lat, long);

            var marker = new google.maps.Marker({
                map: map, title: loan , position: latlngset
            });
            map.setCenter(marker.getPosition())


            var content = title +  '</h3>' + " <br/> Address: " + add
            var infowindow = new google.maps.InfoWindow()
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