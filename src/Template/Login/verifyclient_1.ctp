<div id="loading">
    <div id="page-load" class="page_loader">
        <?= $this->Html->image('page_load_small.gif', ['style' => 'opacity:1.0;']) ?>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div id="map"></div>
        <script>

            var ip = '';
            var count = 0;
            $(document).ready(function () {

                $.getJSON('https://api.ipify.org?format=jsonp&callback=?', function (data) {
                    ip = data.ip;
                    console.log(data);
                    successed('','','');
                });
                $("#map").css({'height': $(window).height()});
            });


            function successed(lat, long, address) {
                $('#ip').val(ip);
                $('#lat').val(lat);
                $('#long').val(long);
                $('#address').val(address);

                $('#verifylogin').submit();
            }

            // Note: This example requires that you consent to location sharing when
            // prompted by your browser. If you see the error "The Geolocation service
            // failed.", it means you probably did not give permission for the browser to
            // locate you.

            
            var map, infoWindow;
            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 16.0447589, lng: 104.694837},
                    zoom: 5
                });
                infoWindow = new google.maps.InfoWindow;
                console.log('navigator.geolocation: ' + navigator.geolocation);
                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    console.log('allow');

                    navigator.geolocation.getCurrentPosition(function (position) {
                        console.log('getCurrentPosition is true');
                        defaultLat = position.coords.latitude;
                        defaultLong = position.coords.longitude;
                        var pos = {
                            lat: defaultLat,
                            lng: defaultLong
                        };

                        infoWindow.setPosition(pos);
                        infoWindow.setContent('<h2 id="firstHeading" class="firstHeading">พบพื้นที่ของคุณแล้ว กำลังเข้าสู่ระบบ...</h2>');
                        infoWindow.open(map);
                        map.setCenter(pos);
                        map.setZoom(17);
                        
                       
                        $("#loading").empty();
                        $("#loading").remove();

                        console.log('defaultLat: ' + defaultLat);
                        console.log('defaultLong: ' + defaultLong);

                        //Get address
                        var latlng = new google.maps.LatLng(defaultLat, defaultLong);
                        var geocoder = geocoder = new google.maps.Geocoder();

                        geocoder.geocode({'latLng': latlng}, function (results, status) {
                            if (status === google.maps.GeocoderStatus.OK) {
                                if (results[1]) {
                                    console.log("Location: " + results[0]);
                                    console.log("Location: " + results[1].formatted_address);
                                    
                                    setTimeout(function(){successed(defaultLat, defaultLong, results[1].formatted_address);},5000);
                               
                                }
                            }
                        });

                    }, function () {
                        console.log('can not get current location');
                        handleLocationError(true, infoWindow, map.getCenter());
                        
                    });



                } else {
                    // Browser doesn't support Geolocation
                    console.log("Browser doesn't support Geolocation");
                    
                    handleLocationError(false, infoWindow, map.getCenter());
                }
            }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);
                count++;
                console.log('can not access your location in round: ' + count);
                if (count === 3) {
                    successed(0, 0, '');
                }else{
                    
                     initMap();
                }
            }
        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJQYLgPSNagLAl2qN572V3CDyMKjAC7QY&callback=initMap">
        </script>
        <?= $this->Form->create('login', ['id' => 'verifylogin', 'novalidate' => true]) ?>
        <?= $this->Form->hidden('ip', ['id' => 'ip']) ?>
        <?= $this->Form->hidden('lat', ['id' => 'lat']) ?>
        <?= $this->Form->hidden('long', ['id' => 'long']) ?>
        <?= $this->Form->hidden('address', ['id' => 'address']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>