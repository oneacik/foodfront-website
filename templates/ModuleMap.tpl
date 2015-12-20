<div class="element">

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgXz03aW81WzWi_MfY5TGZy033LU4d96Q&callback=initMap">
    </script>
    <div style="width:400px;height: 400px;" id="map"></div>
    <form method="POST" onsubmit="return post(this);">
        address:<input type="text" id="address" name="address" value="{$address}"><br/>
        lat:<input type="text" id="lat" name="lat" value="{$lat}"><br/>
        lng:<input type="text" id="lng" name="lng" value="{$lng}"><br/>
        <input type="submit" name="update_location" value="Zapisz lokację">
    </form>
    <script type="text/javascript">

        var map;
        var geocoder;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: {$lat}, lng: {$lng}},
                zoom: 18,
              styles:  {
        featureType: "poi",
        elementType: "labels",
        stylers: [
              { visibility: "off" }
        ]
    }
            });
            
            var geocoder = new google.maps.Geocoder;
            

            var marker = new google.maps.Marker({
                position: { lat: {$lat}, lng: {$lng}},
                map: map,
                title: 'Hello World!'
            });

            google.maps.event.addListener(map, 'click', function (event) {
                marker.setPosition(new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()));
                document.getElementById("lat").value = event.latLng.lat();
                document.getElementById("lng").value = event.latLng.lng();
var latlng = { lat: event.latLng.lat(), lng: event.latLng.lng() };
            geocoder.geocode({ 'location': latlng }, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        
                        
                        document.getElementById("address").value = results[0].formatted_address.split(",")[0];
                        
                    }
                }
            });


            });


            
            

        }

    </script>    

</div>