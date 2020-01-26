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

                $.getJSON('https://api.ipstack.com/183.88.128.214?access_key=7264a3d6f8944afad02162be0c16860c', function (data) {
                    ip = data.ip;
                    console.log(data);
                    var address = data['city']+' '+data['country_name'];
                    successed(data['latitude'],data['longitude'],address);
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

            
            
        </script>
       
        <?= $this->Form->create('login', ['id' => 'verifylogin', 'novalidate' => true]) ?>
        <?= $this->Form->hidden('ip', ['id' => 'ip']) ?>
        <?= $this->Form->hidden('lat', ['id' => 'lat']) ?>
        <?= $this->Form->hidden('long', ['id' => 'long']) ?>
        <?= $this->Form->hidden('address', ['id' => 'address']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>