

<div class="py-5">
<!--    <img src="/dist/img/map300.png" alt="skyros map" class="img-flex maxwidth">-->

    <div id="map" style="width: 100%; height: 400px;"></div>
</div>

<?php

//echo Config::get("GoogleApiKey");
//exit;
$lat = json_decode($configs->settings->map)->center->lat ;
$long = json_decode($configs->settings->map)->center->lng ;


$lat = (float)$lat;
$long = (float)$long;
//echo $lat;
//echo "<br>";
//echo $long;

?>

<script src="/dist/jquery/jquery-3.4.1.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?= Config::get("GoogleApiKey") ?>"></script>
<script type="text/javascript" src="/dist/js/Tilotiti-jQuery-Google-Map/jquery.googlemap.js"></script>

<script type="text/javascript">
    $(function() {
        $("#map").googleMap({
            zoom: 11, // Initial zoom level (optional)
            coords: [<?= $lat ?>, <?= $long ?>], // GPS coords
            type: "ROADMAP", // Map type (optional)
            name: 'Skyros'
        });
        $("#map").addMarker({
            zoom: 11, // Initial zoom level (optional)
            coords: [<?= $lat ?>, <?= $long ?>], // GPS coords
            title: 'Σκύρος', // Title
            text:  'Η χώρα της Σκύρου' // HTML content
        });
    })
</script>

<?php //var_dump(json_decode($configs->settings->map)); exit;?>